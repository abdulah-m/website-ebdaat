<?php
ob_start();
session_start();
if($_SESSION['user_info']['level'] == 1 and isset($_SESSION['user_info'])){
        //start edit
        if(isset($_POST['update'])){
            
            $name	            = strip_tags($_POST['name']);
            $url	            = strip_tags($_POST['url']);
            $email  	        = strip_tags($_POST['email']);
            $desc	            = strip_tags($_POST['desc']);
            $key                = strip_tags($_POST['key']);
            $copy               = strip_tags($_POST['copy']);
            $mob                = strip_tags($_POST['mob']);
            $tel                = strip_tags($_POST['tel']);
            $address            = strip_tags($_POST['address']);
            
            if(!empty($_POST['name'])){
                $query = " UPDATE config SET 
                            s_name='$name',
                            s_url='$url',
                            s_email='$email',
                            s_desc='$desc',
                            s_key='$key',
                            s_copy='$copy',
                            s_mob='$mob',
                            s_tel='$tel',
                            s_address='$address' WHERE 1";
                
                $up = mysql_query ($query, $connection ) or die ('request "Could not execute SQL query" '.$query);
                    
                if($up){
                    header("location: ./index.php?p=".$_GET["p"]."&msg=1");
                }else{
                    header("location: ./index.php?p=".$_GET["p"]."&msg=2");
                    die();
                }

            }
        }
?>
<table class="ads">  
  <tbody>
      <form method="POST" action="">
        <?php 
        $select = "SELECT * FROM config WHERE 1";
        $query  = mysql_query($select)or die (mysql_error());

        while($row=mysql_fetch_array($query)){
    
            $name     =   htmlspecialchars($row['s_name']);
            $url      =   htmlspecialchars($row['s_url']);
            $email    =   htmlspecialchars($row['s_email']);
            $desc     =   htmlspecialchars($row['s_desc']);
            $key      =   htmlspecialchars($row['s_key']);
            $copy     =   htmlspecialchars($row['s_copy']);
            $mob      =   htmlspecialchars($row['s_mob']);
            $tel      =   htmlspecialchars($row['s_tel']);
            $address  =   htmlspecialchars($row['s_address']);
        } ?>

        <tr>
            <th style="width:20%;">اسم الموقع </th>
            <td><input class="form-control required" type="text" name="name" value="<?php echo $name; ?>" required/></td>
        </tr>
        <tr>
            <th style="width:20%;">رابط الموقع </th>
            <td><input class="form-control required" type="text" name="url" value="<?php echo $url; ?>" required /></td>
        </tr>
        <tr>
            <th style="width:20%;">البريد الإلكتروني </th>
            <td><input class="form-control required" type="email" name="email" value="<?php echo $email; ?>" required /></td>
        </tr>
        <tr>
            <th style="width:20%;">وصف الموقع </th>
            <td><textarea class="form-control required" name="desc"  ><?php echo $desc; ?></textarea></td>
        </tr>
        <tr>
            <th style="width:20%;">كلمات مفتاحية </th>
            <td><textarea class="form-control required" name="key"  ><?php echo $key; ?></textarea></td>
        </tr>
        <tr>
            <th style="width:20%;">نص الحقوق </th>
            <td><input class="form-control required" type="text" name="copy" value="<?php echo $copy; ?>" required /></td>
        </tr>
        <tr>
            <th style="width:20%;">موبايل </th>
            <td><input class="form-control required" type="text" name="mob" value="<?php echo $mob; ?>" required /></td>
        </tr>
        <tr>
            <th style="width:20%;">هاتف </th>
            <td><input class="form-control required" type="text" name="tel" value="<?php echo $tel; ?>" required /></td>
        </tr>
        <tr>
            <th style="width:20%;">العنوان </th>
            <td><input class="form-control required" type="text" name="address" value="<?php echo $address; ?>" required /></td>
        </tr>
        <tr>

            <td colspan="2">
                <input name="update" type="submit" value="حفظ"/>
            </td>
        </tr>
    </form>
  </tbody>
</table>
<?php }else{
    echo "<center>You do not have authority to access this page</center>";
    echo '<center><img src="img/err.png" /></center>';
}?>