<?php
include"../../config.php"; 
include"./function.php"; 
header('content-type: multipart/form-data');
if(!empty($_POST['name']) && !empty($_POST['tel']) && !empty($_POST['email'])){
    // get data from post
    $name       = @trim(stripslashes($_POST['name']));
    $co_name    = @trim(stripslashes($_POST['co_name']));
    $tel        = @trim(stripslashes($_POST['tel']));
    $email      = @trim(stripslashes($_POST['email']));
    $pagenum    = @trim(stripslashes($_POST['pagenum']));
    $txt        = @trim(stripslashes($_POST['txt']));
    // get page data
    $query_page = mysql_query("SELECT * FROM pages WHERE id=$pagenum")or die (mysql_error());
    $row        =  mysql_fetch_row($query_page);
    $title      =  htmlspecialchars($row[2]);
    $box_price  =  htmlspecialchars($row[3]);
    $boxes_num  =  htmlspecialchars($row[4]);
    //get date today
    $Version    = date("W", strtotime(date("Y-m-d h:i:s", strtotime("today"))));
    $Version    = $Version/2;
    //get count ads
    $query_count  = mysql_query("SELECT * FROM ads_newspaper")or die (mysql_error());
    $count=0;
    while($row = mysql_fetch_row($query_count)){
        $count = $row[0];
    }
    //upload file
    $target_path = upload_file("uploadedfile",$count+1,"../uploads/");
    // insert ads
    $addAdInsert = "INSERT INTO ads_newspaper (name,co_name,tel,email,page,dat,Version,file,txt,status) VALUES ('$name','$co_name','$tel','$email','$pagenum',now(),'$Version','$target_path','$txt','hanging')";
    $addAdQuery = mysql_query($addAdInsert);
    if($addAdQuery){
        // add boxes in page
        $q       = mysql_query("SELECT * FROM ads_newspaper")or die (mysql_error());
        $id_ads  = 0;
        while($row = mysql_fetch_row($q)){
            $id_ads = $row[0];
        }
        $i = 0;
        foreach($_POST['boxe'] as $check) {
            $addbox = "INSERT INTO ads_boxes (id_ads, val, id_page, version) VALUES ('$id_ads','$check','$pagenum','$Version')";
            $addboxQuery = mysql_query($addbox);
            $i++;
        }
        $price = Calculate_Price($i,$pagenum);
        echo ' <center><div class="success">
                <table style="text-align: center;">
                    <tr>
                        <th colspan="2" style="text-align: center;">تم حجز اعلانكم بنجاح شكرا لكم سيصلكم مندوبنا باسرع وقت ممكن</th>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-align: center;"><img src="img/btm_col.png" /></th>
                    </tr>
                    <tr>
                        <th>الأسم :</th>
                        <td>'.$name.'</td>
                    </tr>
                    <tr>
                        <th>الشركة:</th>
                        <td>'.$co_name.'</td>
                    </tr>
                    <tr>
                        <th>الهاتف:</th>
                        <td>'.$tel.'</td>
                    </tr>
                    <tr>
                        <th>البريد:</th>
                        <td>'.$email.'</td>
                    </tr>
                    <tr>
                        <th>الصفحة: </th>
                        <td>'.$title.'</td>
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
        echo ' <center><div class="err"> يوجد مشكلة  يرجى إعادة المحاولة</div></center>';
    }
    
}else{
    echo ' <center><div class="err"> يرجى ملئ الخانات المطلوبة</div></center>';
}








?>