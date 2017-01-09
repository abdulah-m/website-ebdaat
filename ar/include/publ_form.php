<?php
include"../../config.php"; 
include"./function.php"; 
header('content-type: multipart/form-data');
if(!empty($_POST['type']) && !empty($_POST['size']) && !empty($_POST['number']) && !empty($_POST['thick']) && !empty($_POST['faces'])){
    
    $is_found  = false;
    $is_type   = false;
    $is_size   = false;
    $is_number = false;
    $is_thick  = false;
    $is_faces  = false;
    
    $price = 0;
    
    // get data from post
    $type   = @trim(stripslashes($_POST['type']));
    $size   = @trim(stripslashes($_POST['size']));
    $number = @trim(stripslashes($_POST['number']));
    $thick  = @trim(stripslashes($_POST['thick']));
    $faces  = @trim(stripslashes($_POST['faces']));
    
    $q  = mysql_query("SELECT * FROM pub_spec")or die (mysql_error());
    while($r = mysql_fetch_row($q)){
        if($type == $r[1] && $size == $r[2] && $number == $r[3] && $thick == $r[4] && $faces == $r[5]){
            $price = $r[6];
            $is_found = true;
            break;
        }else{
            if($type == $r[1]){
                $is_type   = true;
            }
            if($size == $r[2]){
                $is_size   = true;
            }
            if($number == $r[3]){
                $is_number = true;
            }
            if($thick == $r[4]){
                $is_thick  = true;
            }
            if($faces == $r[5]){
                $is_faces  = true;
            }
        }
    }
    if($is_found){
        echo ' <center><div class="success">
                    <table style="text-align: center;">
                        <tr>
                            <th>النوع :</th>
                            <td>'.$type.'</td>
                        </tr>
                        <tr>
                            <th>القياس :</th>
                            <td>'.$size.'</td>
                        </tr>
                        <tr>
                            <th>العدد :</th>
                            <td>'.$number.'</td>
                        </tr>
                        <tr>
                            <th>السماكة :</th>
                            <td>'.$thick.'</td>
                        </tr>
                        <tr>
                            <th>نوع الطباعة : </th>
                            <td>';
                            $f = array("وجه واحد","وجهين","وجه واحد ملون","وجهين ملونين");
                            $i = 0;
                            while($i < count($f)){
                                if($i==$faces-1){
                                    echo $f[$i];
                                    break;
                                }
                                $i++;
                            }
                   echo    '</td>
                        </tr>
                        <tr>
                            <th>السعر:</th>
                            <td>'.$price.' ليرة تركية</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td></td>
                        </tr>
                    </table></div></center>';
    }else{
        if(!$is_type){
            echo ' <center><div class="err">النوع غير موجود</div></center>';
        }elseif(!$is_size){
            echo ' <center><div class="err">القياس غير موجود</div></center>';
        }elseif(!$is_number){
            echo ' <center><div class="err">العدد غير موجود</div></center>';
        }elseif(!$is_thick){
            echo ' <center><div class="err">السماكة غير موجود</div></center>';
        }elseif(!$is_faces){
            echo ' <center><div class="err">نوع الطباعة غير موجود</div></center>';
        }elseif(!$is_found && $is_type && $is_size && $is_number && $is_thick && $is_faces){
            echo ' <center><div class="err">طلبكم غير متوفر يرجى مراسلتنا لمعرفة التفاصيل</div></center>';
        }
    }
}else{
    echo ' <center><div class="err">يرجى تحديد جميع المواصفات</div></center>';
}
?>