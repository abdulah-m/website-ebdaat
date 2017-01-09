<?php 
include('./inc/function.php');
if(isset($_GET["q"])){
    if($_GET["q"] == "show" and isset($_GET["id"])){ 
        $id_show= mysql_real_escape_string($_GET["id"]); ?>
    <table class="ads">  
      <tbody>
            <?php
            $select = "SELECT * FROM pub_spec WHERE id=$id_show";
            $query  = mysql_query($select)or die (mysql_error());
            $row    = mysql_fetch_array($query);
            $id         = htmlspecialchars($row['id']);
            $id_type    = htmlspecialchars($row['id_type']);
            $name_ar    = htmlspecialchars($row['name_ar']);
            $name_en    = htmlspecialchars($row['name_en']);
            $name_tr    = htmlspecialchars($row['name_tr']);
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
            
            $select = "SELECT * FROM publications_type WHERE id=$id_type";
            $query  = mysql_query($select)or die (mysql_error());
            $Type   = mysql_fetch_array($query);
        
            echo '  <tr>
                        <th>الاسم عربي</th>
                        <th>الاسم انكليزي</th>
                        <th>الاسم تركي</th>
                        <th>القياس</th>
                        <th>مطبوع خلف</th>
                        <th>عدد الصفحات</th>
                        <th>سماكة الورق</th>
                        <th>نوع الورق</th>
                        <th>سماكة الغلاف</th>
                        <th>سلفان</th>
                        <th>العدد</th>
                        <th>السعر</th>
                    </tr>
                    <tr>
                        <td>'.$name_ar.'</td>
                        <td>'.$name_en.'</td>
                        <td>'.$name_tr.'</td>
                        <td>'.$size.'</td>
                        <td>';
                        if($faces == 1){
                            echo 'وجه واحد';
                        }elseif($faces == 2){
                            echo 'وجهين';
                        }else{
                            echo 'غير محدد';
                        }
            echo       '</td>
                        <td>'.$num_page.'</td>
                        <td>'.$thick.'</td>
                        <td>'.$paper_type.'</td>
                        <td>'.$cover_thick.'</td>
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
            echo       '</td>
                        <td>'.$number.'</td>
                        <td>'.$price.'</td>
                    </tr>
                    
                    <tr >
                        <td colspan="12"><img src="../images/publications/full/'.$image.'"/></td>
                    </tr>
                    <tr>
                        <td colspan="12">
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
            $type	            = strip_tags($_POST['type']);
            $name_ar            = strip_tags($_POST['name_ar']);
            $name_en            = strip_tags($_POST['name_en']);
            $name_tr            = strip_tags($_POST['name_tr']);
            $size               = strip_tags($_POST['size']);
            $faces              = strip_tags($_POST['faces']);
            $num_page           = strip_tags($_POST['num_page']);
            $paper_type         = strip_tags($_POST['paper_type']);
            $thick              = strip_tags($_POST['thick']);
            $cover_thick        = strip_tags($_POST['cover_thick']);
            $slovan             = strip_tags($_POST['slovan']);
            $number 	        = strip_tags($_POST['number']);
            $price	            = strip_tags($_POST['price']);
    
            $query = "UPDATE pub_spec SET id_type='$type',name_ar='$name_ar',name_en='$name_en',name_tr='$name_tr',size='$size',faces='$faces',num_page='$num_page',thick='$thick',paper_type='$paper_type',cover_thick='$cover_thick',slovan='$slovan',number='$number',price='$price' WHERE id=$id_edit";
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
            $select = "SELECT * FROM pub_spec WHERE id=$id_edit";
            $query  = mysql_query($select)or die (mysql_error());
            $row    = mysql_fetch_array($query);
            $id         = htmlspecialchars($row['id']);
            $id_type    = htmlspecialchars($row['id_type']);
            $name_ar    = htmlspecialchars($row['name_ar']);
            $name_en    = htmlspecialchars($row['name_en']);
            $name_tr    = htmlspecialchars($row['name_tr']);
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
            
            echo '  <tr>
                        <th style="width:20%;">النوع</th>
                        <td><select class="form-control" name="type" >';
                        $q  = mysql_query("SELECT * FROM publications_type")or die (mysql_error());
                        while($row = mysql_fetch_array($q)){
                            $idtype   =  htmlspecialchars($row[0]);
                            $type     =  htmlspecialchars($row[1]);
                            if($id_type == $idtype){
                                echo '<option selected="selected" value="'.$idtype.'">'.$type.'</option>';
                            }else{
                                echo '<option value="'.$idtype.'">'.$type.'</option>';
                            }
                        }                  
                       echo'</select>
                       </td>
                    </tr>
                    <tr>
                        <th style="width:20%;">الاسم عربي</th>
                        <td>
                            <input class="form-control" type="text" name="name_ar" value="'.$name_ar.'" />
                        </td>
                    </tr>
                    <tr>
                        <th style="width:20%;">الاسم انكليزي</th>
                        <td>
                            <input class="form-control" type="text" name="name_en" value="'.$name_en.'" />
                        </td>
                    </tr>
                    <tr>
                        <th style="width:20%;">الاسم تركي</th>
                        <td>
                            <input class="form-control" type="text" name="name_tr" value="'.$name_tr.'" />
                        </td>
                    </tr>
                    <tr>
                        <th style="width:20%;">القياس</th>
                        <td>
                            <input class="form-control" type="text" name="size" value="'.$size.'" />
                        </td>
                    </tr>
                    <tr>
                        <th style="width:20%;">مطبوع خلف</th>
                        <td>
                            <select class="form-control" name="faces">';
                            $f = array("وجه واحد","وجهين");
                            if($faces == 1){
                                echo '<option selected="selected" value="1">'.$f[0].'</option>
                                      <option value="2">'.$f[1].'</option>';
                            }elseif($faces == 2){
                                echo '<option value="1">'.$f[0].'</option>
                                      <option selected="selected" value="2">'.$f[1].'</option>';
                            }else{
                                echo '<option value="0">حدد وجوه الطباعة</option>
                                      <option value="1">'.$f[0].'</option>
                                      <option value="2">'.$f[1].'</option>';
                            }
            echo       '</td>
                    </tr>
                    <tr>
                        <th style="width:20%;">عدد الصفحات</th>
                        <td>
                            <input class="form-control" type="text" name="num_page" value="'.$num_page.'" />
                        </td>
                    </tr>
                    <tr>
                        <th style="width:20%;">نوع الورق</th>
                        <td>
                            <input class="form-control" type="text" name="paper_type" value="'.$paper_type.'" />
                        </td>
                    </tr>
                    <tr>
                        <th style="width:20%;">سماكة الورق</th>
                        <td>
                            <input class="form-control" type="text" name="thick" value="'.$thick.'" />
                        </td>
                    </tr>
                    <tr>
                        <th style="width:20%;">سماكة الغلاف</th>
                        <td>
                            <input class="form-control" type="text" name="cover_thick" value="'.$cover_thick.'" />
                        </td>
                    </tr>
                    <tr>
                        <th style="width:20%;">سلفان</th>
                        <td>
                        <select class="form-control" name="slovan" id="type">';
                             $s = array("بدون سلفان","سلفان لامع","سلفان مت","سلفان مت + تلميع");
                             $is = 0;
                             while($is < count($s)){
                                 $is++;
                                if($slovan == $is){
                                    echo '<option selected="selected" value="'.$is.'">'.$s[$is-1].'</option>';
                                }else{
                                    echo '<option value="'.$is.'">'.$s[$is-1].'</option>';
                                }
                                
                             }
           echo'         </select>
                        </td>
                    </tr>
                    <tr>
                        <th style="width:20%;">العدد</th>
                        <td><input class="form-control" type="text" name="number" value="'.$number.'" /></td>
                    </tr>
                    <tr>
                        <th style="width:20%;">السعر</th>
                        <td><input class="form-control" type="text" name="price" value="'.$price.'" /></td>
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
        
        $r = mysql_fetch_row(mysql_query("SELECT * FROM pub_spec WHERE id=$id_del")) or die (mysql_error());
        $pathName = htmlspecialchars($r[5]);
        
        $sql = "DELETE FROM pub_spec WHERE id=$id_del";
        $retval = mysql_query( $sql);
        if(! $retval )
        {
            header("location: ./index.php?p=".$_GET["p"]."&q=edit&id=".$id_edit."&msg=2");
            die();
        }else{
            if(!$pathName = "no-image.jpg"){
                if(file_exists($pathF)){
                    unlink("../images/publications/full/".$pathName);
                    unlink("../images/publications/recent/".$pathName);

                }elseif(!@unlink($pathF)){
                    unlink("../images/publications/full/".$pathName);
                    unlink("../images/publications/recent/".$pathName);
                }
            }
            header("location: ./index.php?p=".$_GET["p"]."&msg=1");
        }
        
    }elseif($_GET["q"] == "ins"){
        if(isset($_POST['submit'])){
            $type       = strip_tags($_POST['type']);
            $name_ar    = strip_tags($_POST['name_ar']);
            $name_en    = strip_tags($_POST['name_en']);
            $name_tr    = strip_tags($_POST['name_tr']);
            $size       = strip_tags($_POST['size']);
            $faces      = strip_tags($_POST['faces']);
            $num_page   = strip_tags($_POST['num_page']);
            $thick      = strip_tags($_POST['thick']);
            $paper_type = strip_tags($_POST['paper_type']);
            $cover_thick= strip_tags($_POST['cover_thick']);
            $slovan     = strip_tags($_POST['slovan']);
            $number     = strip_tags($_POST['number']);
            $price      = strip_tags($_POST['price']);
            
            if(!empty($type) && !empty($title) && !empty($number) && !empty($price)){
                $target_path = "no-image.jpg";
                if(!empty($_FILES["file"])){
                    $sel = "SELECT * FROM pub_spec";
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
                
                $sql ="INSERT INTO pub_spec (`id_type`, `name_ar`, `name_en`, `name_tr`, `image`, `size`, `faces`, `num_page`, `thick`, `paper_type`, `cover_thick`, `slovan`, `number`, `price`)
                                    VALUES ('$type','$name_ar','$name_en','$name_tr','$target_path','$size','$faces','$num_page','$thick','$paper_type','$cover_thick','$slovan','$number','$price')";
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
            <select class="form-control" name="type" required>
                <option value="" selected>حدد النوع</option>
                <?php
                $q  = mysql_query("SELECT * FROM publications_type")or die (mysql_error());
                while($row = mysql_fetch_array($q)){
                    $id    =  htmlspecialchars($row['id']);
                    $title   =  htmlspecialchars($row['title']);
                    echo '<option value="'.$id.'">'.$title.'</option>';
                } ?>
            </select><br />
            <input class="form-control" type="text" name="name_ar" placeholder="الاسم العربي"><br />
            <input class="form-control" type="text" name="name_en" placeholder="الاسم الانكليزي"><br />
            <input class="form-control" type="text" name="name_tr" placeholder="الاسم التركي"><br />
            <input class="form-control" type="text" name="size" placeholder="القياس"><br />
            <select class="form-control" name="faces">
                <option selected="selected" value="0">حدد اوجه الطباعة</option>
                <option value="1">وجه واحد</option>
                <option value="2">وجهين</option>
            </select><br />
            <input class="form-control" type="text" name="num_page" placeholder="عدد الصفحات"><br />
            <input class="form-control" type="text" name="thick" placeholder="سماكة الورق"><br />
            <input class="form-control" type="text" name="paper_type" placeholder="نوع الورق"><br />
            <input class="form-control" type="text" name="cover_thick" placeholder="سماكة الغلاف"><br />
            <select class="form-control" name="slovan">
                <option selected="selected" value="0">حدد السلفان</option>
                <option value="1">بدون سلفان</option>
                <option value="2">سلفان لامع</option>
                <option value="3">سلفان مت</option>
                <option value="4">سلفان مت + تلميع</option>
            </select><br />
            <input class="form-control" type="text" name="number" placeholder="العدد"><br />
            <input class="form-control" type="text" name="price" placeholder="السعر"><br />
            <input class="form-control" type="file" name="file" placeholder="صورة"><br />
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
            <th>معاينة</th>
            <th>الاسم</th>
            <th>القياس</th>
            <th>مطبوع خلف</th>
            <th>عدد الصفحات</th>
            <th>سماكة الورق</th>
            <th>نوع الورق</th>
            <th>سماكة الغلاف</th>
            <th>سلفان</th>
            <th>العدد</th>
            <th>السعر</th>
            <th></th>
      </tr>
  </thead>   
  <tbody>
      <?php
        $select = "SELECT * FROM pub_spec ORDER BY id DESC";
        $query  = mysql_query($select)or die (mysql_error());
        while($row=mysql_fetch_array($query)){
            $id         = htmlspecialchars($row['id']);
            $id_type    = htmlspecialchars($row['id_type']);
            $name       = htmlspecialchars($row['name_ar']);
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

            echo '
                    <tr>
                        <td><img width="75px" src="../images/publications/recent/'.$image.'"/></td>
                        <td>'.$name.'</td>
                        <td>'.$size.'</td>
                        <td>';
                        if($faces == 1){
                            echo 'وجه واحد';
                        }elseif($faces == 2){
                            echo 'وجهين';
                        }else{
                            echo 'غير محدد';
                        }
            echo       '</td>
                        <td>'.$num_page.'</td>
                        <td>'.$thick.'g</td>
                        <td>'.$paper_type.'</td>
                        <td>'.$cover_thick.'</td>
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
            echo       '</td>
                        <td>'.$number.'</td>
                        <td>'.$price.'TL</td>
                        <td>
                            <a href="index.php?p='.$_GET["p"].'&q=edit&id='.$id.'"><i class="fa icon-wrench icon-large"></i></a> 
                            <a href="index.php?p='.$_GET["p"].'&q=show&id='.$id.'"><i class="fa icon-eye-open icon-large"></i></a>
                            <a href="index.php?p='.$_GET["p"].'&q=del&id='.$id.'"><i class="icon-trash icon-large"></i></a>
                        </td>
                    </tr>
            ';
        }
        echo '
                </table>
            ';    
        ?>
  </tbody>
</table>
<?php } ?>