<?php
/**
 * Created by PhpStorm.
 * User: abdullah
 * Date: 16/04/2015
 * Time: 03:12 ص
 */
function Calculate_Price($Num_boxes,$Page_num){
    $select_price = "SELECT * FROM pages WHERE id=$Page_num";
    $query_price  = mysql_query($select_price)or die (mysql_error());
    $row_price    = mysql_fetch_row($query_price);
    $discount     = (($row_price[3]*$Num_boxes)*(0.5*$Num_boxes))/100;
    $price        = ($row_price[3]*$Num_boxes)-$discount;
    
    return $price;
}

function upload_file($n,$c,$location){
    //get extension
    $temp = explode(".", $_FILES[$n]["name"]);
    $extension = end($temp);
    
    if (!empty($_FILES[$n])){
        
        if ($_FILES[$n]["error"] > 0)
            {
                echo "Return Code: " . $_FILES[$n]["error"] . "<br>";
                return 0;
            }else
            {
                if(move_uploaded_file($_FILES[$n]["tmp_name"],"../".$location."file-0".$c.".".$extension)){
                    return "file-0".$c.".".$extension;
                }
            }
    }else{
            return "no file";
    }
}

function mail_attachment($mailto, $from_mail, $from_name, $replyto, $subject, $message) {
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--\r\n";
    $header .= "Content-type:text/plain; charset=utf-8\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= "--\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"\"\r\n\r\n";
    $header .= "----";
    if (mail($mailto, $subject, $message, $header)) {
        return true;
    } else {
        return false;
    }
}

function Cut_Text($text, $limit = 25, $ending = '...'){ 
    if (strlen(trim($text)) > $limit) { 
        $text = substr($text, 0, $limit); 
        $text = substr($text, 0, -(strlen(strrchr($text,' ')))); 
        $text = $text . $ending; 
    } 
    return $text; 
}  

?>