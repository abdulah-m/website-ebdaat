<?php
include('./inc/function.php');
if(isset($_GET["q"])){
    //start show
    if($_GET["q"] == "show" and isset($_GET["id"])){ 
        
        $id_show= mysql_real_escape_string($_GET["id"]); ?>
    <table class="ads">  
      <tbody>
            <?php
            $select_ads = "SELECT * FROM ads_newspaper WHERE id=$id_show";
            $query_ads  = mysql_query($select_ads)or die (mysql_error());
            while($row=mysql_fetch_array($query_ads)){
                
                $id       =   htmlspecialchars($row['id']);
                $name     =   htmlspecialchars($row['name']);
                $co_name  =   htmlspecialchars($row['co_name']);
                $tel      =   htmlspecialchars($row['tel']);
                $email    =   htmlspecialchars($row['email']);
                $page_id  =   htmlspecialchars($row['page']);
                $dat      =   htmlspecialchars($row['dat']);
                $Version  =   htmlspecialchars($row['Version']);
                $file     =   htmlspecialchars($row['file']);
                $txt      =   htmlspecialchars($row['txt']);
                $status   =   htmlspecialchars($row['status']);
                
                $select_page = "SELECT * FROM pages WHERE id=$page_id";
                $query_page  = mysql_query($select_page)or die (mysql_error());
                $row         = mysql_fetch_row($query_page);
                $page        =  htmlspecialchars($row[1]);
                
                $select_box = "SELECT * FROM ads_boxes WHERE id_page=$page_id AND id_ads=$id";
                $query_box  = mysql_query($select_box)or die (mysql_error());
                $c          = mysql_num_rows($query_box);

                $price = Calculate_Price($c,$page_id);
                
                echo '  <tr>
                            <th style="width:20%;">الاسم </th>
                            <td>'.$name.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">اسم الشركة </th>
                            <td>'.$co_name.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">الهاتف</th>
                            <td>'.$tel.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">البريد الالكتروني</th>
                            <td>'.$email.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">الصفحة </th>
                            <td>'.$page.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">القياس</th>
                            <td>';
                                $q    = mysql_query("SELECT * FROM ads_boxes WHERE id_ads=$id")or die (mysql_error());
                                while($size = mysql_fetch_array($q)){
                                    echo '| '.$size[0].' |';
                                }
                   echo '   </td>
                        </tr>
                        <tr>
                            <th style="width:20%;">السعر</th>
                            <td>'.$price.' TL</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">التاريخ</th>
                            <td>'.$dat.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">الإصدار</th>
                            <td>'.$Version.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">ملف</th>
                            <td><a href="download.php?filename='.$file.'">
                            <i class="fa icon-download"></i> '.$file.'</a></td>
                        </tr>
                        <tr>
                            <th style="width:20%;">الوصف</th>
                            <td>'.$txt.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">الحالة</th>
                            <td>'.$status.'</td>
                        </tr>
                        <tr>
                            <td  colspan="2">
                                <a href="index.php?p=3&q=edit&id='.$id.'"><i class="fa icon-wrench"></i></a> 
                            </td>
                        </tr>';
            }
            //end show         
            ?>
      </tbody>
    </table>
<?php 
    }elseif($_GET["q"] == "edit" and isset($_GET["id"])){
        //start edit
        $id_edit= mysql_real_escape_string($_GET["id"]);
        if(isset($_POST['update'])){
            
            $num	            = strip_tags($_POST['num']);
            $name	            = strip_tags($_POST['name']);
            $co_name	        = strip_tags($_POST['co_name']);
            $tel	            = strip_tags($_POST['tel']);
            $em                	= strip_tags($_POST['em']);
            $pag                = strip_tags($_POST['pag']);
            $ver                = strip_tags($_POST['ver']);
            $txt                = strip_tags($_POST['txt']);
            $st                 = strip_tags($_POST['status']);
            
            if(!empty($_POST['name'])){
                $query = " UPDATE ads_newspaper SET name='$name',co_name='$co_name',tel='$tel',email='$em',page='$pag',version='$ver',txt='$txt',status='$st' WHERE id=".$num;
                $up = mysql_query ($query, $connection ) or die ('request "Could not execute SQL query" '.$query);
                    
                if($up){
                    $upbox =  mysql_query ("UPDATE ads_boxes SET id_page='$pag' WHERE id_ads=".$num)or die();
                    if($upbox){
                        header("location: ./index.php?p=".$_GET["p"]."&q=show&id=".$num."&msg=1");
                    }else{
                        header("location: ./index.php?p=".$_GET["p"]."&q=edit&id=".$num."&msg=2");
                        echo '<center><img src="img/err.png" /></center>';
                        die();
                    }
                }else{
                    header("location: ./index.php?p=".$_GET["p"]."&q=edit&id=".$num."&msg=2");
                    echo '<center><img src="img/err.png" /></center>';
                    die();
                }

            }
        }
?>
        <table class="ads">  
          <tbody>
              <form method="POST" action="">
                <?php
                $select_ads = "SELECT * FROM ads_newspaper WHERE id=$id_edit";
                $query_ads  = mysql_query($select_ads)or die (mysql_error());
                while($row=mysql_fetch_array($query_ads)){

                    $id       =   htmlspecialchars($row['id']);
                    $name     =   htmlspecialchars($row['name']);
                    $co_name  =   htmlspecialchars($row['co_name']);
                    $tel      =   htmlspecialchars($row['tel']);
                    $email    =   htmlspecialchars($row['email']);
                    $page_id  =   htmlspecialchars($row['page']);
                    $dat      =   htmlspecialchars($row['dat']);
                    $Version  =   htmlspecialchars($row['Version']);
                    $file     =   htmlspecialchars($row['file']);
                    $txt      =   htmlspecialchars($row['txt']);
                    $status   =   htmlspecialchars($row['status']);
                    
                    $select_page = "SELECT * FROM pages WHERE id=$page_id";
                    $query_page  = mysql_query($select_page)or die (mysql_error());

                    $row        = mysql_fetch_row($query_page);
                    $page       = htmlspecialchars($row[1]);
                    $pr_page    = htmlspecialchars($row[3]);
                    
                    $select_box = "SELECT * FROM ads_boxes WHERE id_page=$page_id AND id_ads=$id";
                    $query_box  = mysql_query($select_box)or die (mysql_error());
                    $c          = mysql_num_rows($query_box);
                    
                    $price = Calculate_Price($c,$page_id);
                    
                    echo '  <tr>
                                <th style="width:20%;">الاسم</th>
                                <td><input class="form-control required" type="text" name="name" value="'.$name.'" required/></td>
                            </tr>
                            <tr>
                                <th style="width:20%;">اسم الشركة </th>
                                <td><input class="form-control required" type="text" name="co_name" value="'.$co_name.'" required /></td>
                            </tr>
                            <tr>
                                <th style="width:20%;">الهاتف</th>
                                <td><input class="form-control required" type="text" name="tel" value="'.$tel.'" required /></td>
                            </tr>
                            <tr>
                                <th style="width:20%;">البريد الالكتروني</th>
                                <td><input class="form-control required" type="email" name="em" value="'.$email.'" required /></td>
                            </tr>
                            <tr>
                                <th style="width:20%;">الصفحة</th>
                                <td><select class="form-control required" name="pag" required>';
                                    $q  = mysql_query("SELECT * FROM pages")or die (mysql_error());
                                    while($row = mysql_fetch_array($q)){
                                        $idp   =  htmlspecialchars($row[0]);
                                        $pag   =  htmlspecialchars($row[1]);
                                        if($page_id == $idp){
                                            echo '<option selected="selected" value="'.$idp.'">'.$pag.'</option>';
                                        }else{
                                            echo '<option value="'.$idp.'">'.$pag.'</option>';
                                        }
                                    }
                                            
                       echo'        </select>
                                </td>
                            </tr>
                            <tr>
                                <th style="width:20%;">السعر</th>
                                <td>'.$price.' TL</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">التاريخ</th>
                                <td>'.$dat.'</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">الاصدار</th>
                                <td><input class="form-control required" type="text" name="ver" value="'.$Version.'" required /></td>
                            </tr>
                            <tr>
                                <th style="width:20%;">ملف</th>
                                <td><a href="download.php?filename='.$file.'">
                                <i class="fa icon-download"></i> '.$file.'</a></td>
                            </tr>
                            <tr>
                                <th style="width:20%;">الوصف</th>
                                <td><textarea class="form-control required" id="txt" name="txt"  cols="50" rows="10" >'.$txt.'</textarea></td>
                            </tr>
                            <tr>
                                <th style="width:20%;">الحالة</th>
                                <td>
                                    <select class="form-control required" name="status" id="type">';
                                     $s = array("active","inactive","hanging","finished");
                                     $is = 0;
                                     while($is < count($s)){
                                        if($status == $s[$is]){
                                            echo '<option selected="selected" value="'.$s[$is].'">'.$s[$is].'</option>';
                                        }else{
                                            echo '<option value="'.$s[$is].'">'.$s[$is].'</option>';
                                        }
                                        $is++;
                                     }
                                            
                       echo'         </select>
                                </td>
                            </tr>
                            <tr>
                                <td  colspan="2">
                                    <input name="update" type="submit" value="Save"/>
                                </td>
                            </tr>';
                }          
                ?>
            </form>
          </tbody>
        </table>
    <?php
    //end edit 
    }else{
        header("Location: index.php&p=".$_GET["p"]);
    }
}else{ ?>
<table class="ads">
  <thead>
      <tr>
          <th>الاسم</th>
          <th>اسم الشركة</th>
          <th>الهاتف</th>
          <th>البريد</th>
          <th>ملف</th>
          <th>الحالة</th>
          <th>خيارات</th>
      </tr>
  </thead>   
  <tbody>
        <?php
        $select_ads = "SELECT * FROM ads_newspaper ORDER BY id DESC";
        $query_ads  = mysql_query($select_ads)or die (mysql_error());
        while($row=mysql_fetch_array($query_ads)){
            $id             =   htmlspecialchars($row['id']);
            $name_ads       =   htmlspecialchars($row['name']);
            $company_ads    =   htmlspecialchars($row['co_name']);
            $tele_ads       =   htmlspecialchars($row['tel']);
            $email_ads      =   htmlspecialchars($row['email']);
            $file           =   htmlspecialchars($row['file']);
            $status         =   htmlspecialchars($row['status']);
            
            echo '  <tr>
                    <td>'.$name_ads.'</td>
                    <td>'.$company_ads.'</td>
                    <td>'.$tele_ads.'</td>
                    <td>'.$email_ads.'</td>
                    <td><a href="download.php?filename='.$file.'"><i class="fa icon-download"></i> '.$file.'</a></td>
                    <td>'.$status.'</td>
                    <td>
                        <a href="index.php?p=3&q=edit&id='.$id.'"><i class="fa icon-wrench"></i></a> 
                        <a href="index.php?p=3&q=show&id='.$id.'"><i class="fa icon-eye-open"></i></a>
                    </td>
                 </tr>';
        }          
        ?>
</div>
  </tbody>
</table>
<?php } ?>