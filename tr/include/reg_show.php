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
                <div class="success">Sizin talebiniz bizim ajan olarak yakında ziyaret edecek başarıyla tescil edilmiştir
                    <table>
                        <tr>
                            <th>isim</th>
                            <td>'.$name.'</td>
                        </tr>
                        <tr>
                            <th>telefon</th>
                            <td>'.$tele.'</td>
                        </tr>
                        <tr>
                            <th>E-posta</th>
                            <td>'.$email.'</td>
                        </tr>
                    </table><hr>';

            $s = "SELECT * FROM pub_spec WHERE id=$data_id";
            $q = mysql_query($s)or die (mysql_error());
            while($row = mysql_fetch_array($q)){
                $name_r     = htmlspecialchars($row['name_tr']);
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
                            <th>Talep Adı</th>
                            <td>'.$name_r.'</td>
                        </tr>
                        <tr>
                            <th>ölçüm</th>
                            <td>'.$size.'</td>
                        </tr>
                        <tr>
                            <th>sayfa sayısı</th>
                            <td>'.$num_page.'</td>
                        </tr>
                        <tr>
                            <th>yön baskı</th>
                            <td>';
                            if($faces == 1){
                                echo 'tek yön';
                            }else{
                                echo 'çift yön';
                            }
                echo   '</td>
                        </tr>
                        <tr>
                            <th>Kağıt kalınlığı</th>
                            <td>'.$thick.'</td>
                        </tr>
                        <tr>
                            <th>kağıt türü</th>
                            <td>'.$paper_type.'</td>
                        </tr>
                        <tr>
                            <th>Kapak kalınlığı</th>
                            <td>'.$cover_thick.'</td>
                        </tr>
                        <tr>
                            <th>Selofan</th>
                            <td>';
                            $s = array("Selofan olmadan", "selofan parlak", "selofan polisaj + oldu", "selofan ÖLDÜ");
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
                            <th>numara</th>
                            <td>'.$number.'</td>
                        </tr>
                        <tr>
                            <th>fiyat</th>
                            <td>'.$price.'TL</td>
                        </tr>

                    </table><hr>';
            }
        echo '</div>
        </center>';
    }
    else
    {
        echo '<center><div class="err"> Bir hata lütfen tekrar deneyin vardır</div></center>';
    }
}else{
    echo '<center><div class="err"> Gerekli alanları doldurunuz</div></center>';
}
?>