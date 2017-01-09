<?php
include('../../config.php');
include('function.php');
if (isset($_POST['classified_btn']))
{
    if(!empty($_POST['tel']) and !empty($_POST['region']) and !empty($_POST['type']) and !empty($_POST['textad'])){
        $tel	            = strip_tags($_POST['tel']);
        $email	            = strip_tags($_POST['email']);
        $region	            = strip_tags($_POST['region']);
        $type           	= strip_tags($_POST['type']);
        $textad             = strip_tags($_POST['textad']);

        //تاريخ اليوم و الوقت لغضافة الاعلان المبوب
        $d                  = strtotime("today");
        $dat                = date("Y-m-d h:i:s", $d);
        $date_string        = $dat;
        $Version            = date("W", strtotime($date_string));
        $Version            = $Version/2;

        $addAdInsert = "INSERT INTO classified_ads (id_type, tel  , email  , region  , textad  , dat  , Version)
                                            VALUES ('$type','$tel','$email','$region','$textad',now(),'$Version')";
        $addAdQuery = mysql_query($addAdInsert);

        if(isset($addAdQuery))
        {
            echo '<meta http-equiv="refresh" content="0;URL=../newspaper.php?msg=1" />';
        }
        else
        {
            echo '<meta http-equiv="refresh" content="0;URL=../newspaper.php?msg=2" />';
        }
    }else{
        echo '<meta http-equiv="refresh" content="0;URL=../newspaper.php?msg=2" />';
    }
}
?>