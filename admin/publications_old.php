<?php 
include('./inc/function.php');
if(isset($_GET["q"])){
    if($_GET["q"] == "show" and isset($_GET["id"])){ 
        $id_show= mysql_real_escape_string($_GET["id"]); ?>
    <table class="ads">  
      <tbody>
            <?php
            $select = "SELECT * FROM publications WHERE id=$id_show";
            $query  = mysql_query($select)or die (mysql_error());
            $row    = mysql_fetch_array($query);
            $id             =   htmlspecialchars($row['id']);
            $title          =   htmlspecialchars($row['title']);
            $id_type        =   htmlspecialchars($row['id_type']);
            $number         =   htmlspecialchars($row['number']);
            $price          =   htmlspecialchars($row['price']);
            $description    =   htmlspecialchars($row['description']);
            $image          =   htmlspecialchars($row['image']);
            
            $select = "SELECT * FROM publications_type WHERE id=$id_type";
            $query  = mysql_query($select)or die (mysql_error());
            $Type   = mysql_fetch_array($query);
        
            echo '  <tr>
                        <th>العنوان</th>
                        <td>'.$title.'</td>
                    </tr>
                    <tr>
                        <th>النوع</th>
                        <td>'.$Type['filter'].'</td>
                    </tr>
                    <tr>
                        <th>العدد</th>
                        <td>'.$number.'</td>
                    </tr>
                    <tr>
                        <th>السعر</th>
                        <td>'.$price.'</td>
                    </tr>
                    <tr>
                        <th>الوصف</th>
                        <td>'.$description.'</td>
                    </tr>
                    <tr>
                        <th>معاينة</th>
                        <td><img width="100%" src="../images/publications/full/'.$image.'"/></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="index.php?p='.$_GET["p"].'&q=edit&id='.$id.'"><i class="fa icon-wrench"></i></a>
                            <a href="index.php?p='.$_GET["p"].'&q=del&id='.$id.'"><i class="icon-trash"></i></a>
                        </td>
                    </tr>';     
            ?>
      </tbody>
    </table>
<?php 
    }elseif($_GET["q"] == "edit" and isset($_GET["id"])){
        $id_edit= mysql_real_escape_string($_GET["id"]); 
        if(isset($_POST['update'])){
            $title	            = strip_tags($_POST['title']);
            $type	            = strip_tags($_POST['type']);
            $number 	        = strip_tags($_POST['number']);
            $price	            = strip_tags($_POST['price']);
            $description       	= strip_tags($_POST['txt']);
            $title_en           = strip_tags($_POST['title_en']);
            $description_en    	= strip_tags($_POST['txt_en']);
            $title_tr           = strip_tags($_POST['title_tr']);
            $description_tr    	= strip_tags($_POST['txt_tr']);
            
            $query = "UPDATE publications SET id_type='$type',title='$title',description='$description',number='$number',price='$price',title_en='$title_en',description_en='$description_en',title_tr='$title_tr',description_tr='$description_tr' WHERE id=$id_edit";
            $up    = mysql_query ($query) or die ('request "Could not execute SQL query" '.$query);

            if($up){
                header("location: ./index.php?p=".$_GET["p"]."&q=show&id=".$id_edit."&msg=1");
            }else{
                header("location: ./index.php?p=".$_GET["p"]."&q=edit&id=".$id_edit."&msg=2");
                die();
            }
        }
?>
    <table class="ads">  
      <tbody>
          <form method="POST" action="">
            <?php
            $select = "SELECT * FROM publications WHERE id=$id_edit";
            $query  = mysql_query($select)or die (mysql_error());
            $row    = mysql_fetch_array($query);
            $id             =   htmlspecialchars($row['id']);
            $title          =   htmlspecialchars($row['title']);
            $id_type        =   htmlspecialchars($row['id_type']);
            $number         =   htmlspecialchars($row['number']);
            $price          =   htmlspecialchars($row['price']);
            $description    =   htmlspecialchars($row['description']);
            $image          =   htmlspecialchars($row['image']);
            $title_en       =   htmlspecialchars($row['title_en']);
            $description_en =   htmlspecialchars($row['description_en']);
            $title_tr       =   htmlspecialchars($row['title_tr']);
            $description_tr =   htmlspecialchars($row['description_tr']);
            
            echo '  <tr>
                        <th style="width:20%;">العنوان</th>
                        <td>
                            <input class="form-control required" type="text" name="title" value="'.$title.'" required />
                            <input class="form-control required" type="text" name="title_en" value="'.$title_en.'" required />
                            <input class="form-control required" type="text" name="title_tr" value="'.$title_tr.'" required />
                        </td>
                    </tr>
                    <tr>
                        <th style="width:20%;">النوع</th>
                        <td><select class="form-control required" name="type" required>';
                        $q  = mysql_query("SELECT * FROM publications_type")or die (mysql_error());
                        while($row = mysql_fetch_array($q)){
                            $idtype   =  htmlspecialchars($row[0]);
                            $type     =  htmlspecialchars($row[1]);
                            if($page_id == $idp){
                                echo '<option selected="selected" value="'.$idtype.'">'.$type.'</option>';
                            }else{
                                echo '<option value="'.$idtype.'">'.$type.'</option>';
                            }
                        }                  
                       echo'</select>
                       </td>
                    </tr>
                    <tr>
                        <th style="width:20%;">العدد</th>
                        <td><input class="form-control required" type="text" name="number" value="'.$number.'" required /></td>
                    </tr>
                    <tr>
                        <th style="width:20%;">السعر</th>
                        <td><input class="form-control required" type="text" name="price" value="'.$price.'" required /></td>
                    </tr>
                    <tr>
                        <th style="width:20%;">الوصف</th>
                        <td>
                            <textarea class="form-control required" id="txt" name="txt">'.$description.'</textarea>
                            <textarea class="form-control required" id="txt" name="txt_en">'.$description_en.'</textarea>
                            <textarea class="form-control required" id="txt" name="txt_tr">'.$description_tr.'</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>معاينة</th>
                        <td><img width="100%" src="../images/publications/full/'.$image.'"/></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input name="update" type="submit" value="حفظ"/>
                        </td>
                    </tr>';     
            ?>
          </form>
      </tbody>
    </table>
<?php
    }elseif($_GET["q"] == "del" and isset($_GET["id"])){
        $id_del= mysql_real_escape_string($_GET["id"]);
        
        $r = mysql_fetch_row(mysql_query("SELECT * FROM publications WHERE id=$id_del")) or die (mysql_error());
        $pathName = htmlspecialchars($r[5]);
        
        $sql = "DELETE FROM publications WHERE id=$id_del";
        $retval = mysql_query( $sql);
        if(! $retval )
        {
            header("location: ./index.php?p=".$_GET["p"]."&q=edit&id=".$id_edit."&msg=2");
            die();
        }else{
            if(file_exists($pathF)){
                unlink("../images/publications/full/".$pathName);
                unlink("../images/publications/recent/".$pathName);
                
            }elseif(!@unlink($pathF)){
                unlink("../images/publications/full/".$pathName);
                unlink("../images/publications/recent/".$pathName);
            }
            header("location: ./index.php?p=".$_GET["p"]."&msg=1");
        }
        
    }elseif($_GET["q"] == "ins"){
        if(isset($_POST['submit'])){
            $type        = strip_tags($_POST['type']);
            $title_ar    = strip_tags($_POST['title_ar']);
            $title_en    = strip_tags($_POST['title_en']);
            $title_tr    = strip_tags($_POST['title_tr']);
            $description_ar = strip_tags($_POST['description_ar']);
            $description_en = strip_tags($_POST['description_en']);
            $description_tr = strip_tags($_POST['description_tr']);
            $number = strip_tags($_POST['number']);
            $price  = strip_tags($_POST['price']);
            
            
            
            if(!empty($type) && !empty($title) && !empty($number) && !empty($price)){
                $target_path = "no-image.jpg";
                if(!empty($_FILES["file"])){
                    $sel = "SELECT * FROM publications";
                    $q   = mysql_query($sel) or die (mysql_error());
                    $c   = mysql_num_rows($q)+1;
                    
                    $temp = explode(".", $_FILES["file"]["name"]);
                    $extension = end($temp);
                    if (move_uploaded_file($_FILES["file"]["tmp_name"],"../images/publications/full/item0".$c.".".$extension)) {
                        $target_path = "item0".$c.".".$extension;
                        smart_resize_image("../images/publications/full/".$target_path,null,600,455);
                        
                        copy("../images/publications/full/".$target_path,"../images/publications/recent/".$target_path);
                        smart_resize_image("../images/publications/recent/".$target_path,null,290,220);
                    
                    }
                    else {
                        $target_path = "no-image.jpg";
                    }
                    
                }
                
                $sql ="INSERT INTO publications (`id_type`, `thumb`, `title`,`description`, `image`, `number`, `price`, `title_en`, `description_en`, `title_tr`, `description_tr`) VALUES ('$type','$target_path','$title_ar','$description_ar','$target_path','$number','$price','$title_en','$description_en','$title_tr','$description_tr')";
                $retval = mysql_query($sql);
                if(! $retval ){
                    header("location: ./index.php?p=".$_GET["p"]."&q=ins&msg=2");
                    die();
                }else{
                    header("location: ./index.php?p=".$_GET["p"]."&msg=1");
                } 
            }else{
                header("location: ./index.php?p=".$_GET["p"]."&q=ins&msg=2");
            }
    }else{ ?>
            <form method="post" action="" enctype="multipart/form-data">
            <select class="form-control required" name="type" required>
                <option value="" selected>حدد النوع</option>
                <?php
                $q  = mysql_query("SELECT * FROM publications_type")or die (mysql_error());
                while($row = mysql_fetch_array($q)){
                    $id    =  htmlspecialchars($row['id']);
                    $title   =  htmlspecialchars($row['title']);
                    echo '<option value="'.$id.'">'.$title.'</option>';
                } ?>
            </select><br />
            <input class="form-control required" type="text" name="title_ar" placeholder="العنوان العربي" required>
            <input class="form-control required" type="text" name="title_en" placeholder="العنوان الانكليزي" required>
            <input class="form-control required" type="text" name="title_tr" placeholder="العنوان التركي" required><br />
            <input class="form-control required" type="text" name="number" placeholder="العدد" required><br />
            <input class="form-control required" type="text" name="price" placeholder="السعر" required><br />
            <input class="form-control required" type="file" name="file" placeholder="صورة" required><br />
            <textarea class="form-control required" name="description_ar" placeholder="الوصف العربي"></textarea>
            <textarea class="form-control required" name="description_en" placeholder="الوصف الانكليزي"></textarea>
            <textarea class="form-control required" name="description_tr" placeholder="الوصف التركي"></textarea><br />
            <input type="submit" name="submit" value="ادخال">
        </form>
<?php  }
    }
}else{
echo '<a href="index.php?p='.$_GET["p"].'&q=ins"><i class="icon-plus-sign-alt icon-2x"></i></a>';
?>
<table class="ads">
  <thead>
      <tr>
          <th>العنوان</th>
          <th>النوع</th>
          <th>الوصف</th>
          <th>العدد</th>
          <th>السعر</th>
          <th>معاينة</th>
      </tr>
  </thead>   
  <tbody>
      <?php
        $select = "SELECT * FROM publications ORDER BY id DESC";
        $query  = mysql_query($select)or die (mysql_error());
        while($row=mysql_fetch_array($query)){
            $id             =   htmlspecialchars($row['id']);
            $title          =   htmlspecialchars($row['title']);
            $id_type        =   htmlspecialchars($row['id_type']);
            $number         =   htmlspecialchars($row['number']);
            $price          =   htmlspecialchars($row['price']);
            $description    =   htmlspecialchars($row['description']);
            $thumb          =   htmlspecialchars($row['thumb']);
            
            echo '<tr>
                    <td>'.$title.'</td>
                    <td>'.$id_type.'</td>
                    <td>'.$d = Cut_Text($description, $limit = 100, "....").'</td>
                    <td>'.$number.'</td>
                    <td>'.$price.'</td>
                    <td><img width="100px" src="../images/publications/recent/'.$thumb.'" /></td>
                    <td colspan="2">
                        <a href="index.php?p='.$_GET["p"].'&q=edit&id='.$id.'"><i class="fa icon-wrench icon-large"></i></a> 
                        <a href="index.php?p='.$_GET["p"].'&q=show&id='.$id.'"><i class="fa icon-eye-open icon-large"></i></a>
                        <a href="index.php?p='.$_GET["p"].'&q=del&id='.$id.'"><i class="icon-trash icon-large"></i></a>
                    </td>
                 </tr>';      
        }?>
  </tbody>
</table>
<?php } ?>