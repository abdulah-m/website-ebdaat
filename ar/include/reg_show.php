<?php
include('../../config.php');

if(!empty($_POST['name']) and !empty($_POST['tele']) and !empty($_POST['email']) and !empty($_POST['data_id'])){
    $name       =   strip_tags($_POST['name']);
    $tele       =   strip_tags($_POST['tele']);
    $email      =   strip_tags($_POST['email']);
    $data_id    =   strip_tags($_POST['data_id']);


    $insert = "INSERT INTO print_requests ( name, tele, email, id_request, date_request)
                                 VALUES ('$name','$tele','$email','$data_id',now())";
    $query = mysql_query($insert);

    if(isset($query))
    {
        echo '<center>
                <div class="success">تم تسجيل طلبكم بنجاح 
                    <table>
                        <tr>
                            <th>الأسم</th>
                            <td>'.$name.'</td>
                        </tr>
                        <tr>
                            <th>الهاتف</th>
                            <td>'.$tele.'</td>
                        </tr>
                        <tr>
                            <th>البريد الإلكتروني</th>
                            <td>'.$email.'</td>
                        </tr>
                    </table><hr>';

            $s = "SELECT * FROM pub_spec WHERE id=$data_id";
            $q = mysql_query($s)or die (mysql_error());
            while($row = mysql_fetch_array($q)){
                $name_r     = htmlspecialchars($row['name_ar']);
                $image      = htmlspecialchars($row['image']);
                $size       = htmlspecialchars($row['size']);
                $faces      = htmlspecialchars($row['faces']);
                $num_page   = htmlspecialchars($row['num_page']);
                $thick      = htmlspecialchars($row['thick']);
                $paper_type = htmlspecialchars($row['paper_type']);
                $cover_thick= htmlspecialchars($row['cover_thick']);
                $slovan     = htmlspecialchars($row['slovan']);
                $number     = htmlspecialchars($row['number']);
                $price      = htmlspecialchars($row['price']);

                echo '<table>
                        <tr>
                            <th>اسم الطلب</th>
                            <td>'.$name_r.'</td>
                        </tr>
                        <tr>
                            <th>القياس</th>
                            <td>'.$size.'</td>
                        </tr>
                        <tr>
                            <th>عدد الصفحات</th>
                            <td>'.$num_page.'</td>
                        </tr>
                        <tr>
                            <th>مطبوع خلف</th>
                            <td>';
                            if($faces == 1){
                                echo 'وجه واحد';
                            }else{
                                echo 'وجهين';
                            }
                echo   '</td>
                        </tr>
                        <tr>
                            <th>سماكة الورق</th>
                            <td>'.$thick.'</td>
                        </tr>
                        <tr>
                            <th>نوع الورق</th>
                            <td>'.$paper_type.'</td>
                        </tr>
                        <tr>
                            <th>سماكة الغلاف</th>
                            <td>'.$cover_thick.'</td>
                        </tr>
                        <tr>
                            <th>سلفان</th>
                            <td>';
                            $s = array("بدون سلفان","سلفان لامع","سلفان مت","سلفان مت + تلميع");
                            $i = 0;
                            while($i < count($s)){
                                if($i==$slovan-1){
                                    echo $s[$i];
                                    break;
                                }
                                $i++;
                            }
                echo        '</td>
                        </tr>
                        <tr>
                            <th>العدد</th>
                            <td>'.$number.'</td>
                        </tr>
                        <tr>
                            <th>السعر</th>
                            <td>'.$price.'TL</td>
                        </tr>

                    </table><hr>';
            }
        echo '</div>
        </center>';
    }
    else
    {
        echo '<center><div class="err"> يوجد خطأ يرجى المحاولة مرة اخرى</div></center>';
    }
}else{
    echo '<center><div class="err"> يرجى ملئ الخانات المطلوبة</div></center>';
}
?>