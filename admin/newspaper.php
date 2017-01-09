<?php
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
                
                
                
                echo '  <tr>
                            <th style="width:20%;">Num</th>
                            <td>'.$id.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">Name</th>
                            <td>'.$name.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">Company Name</th>
                            <td>'.$co_name.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">Tele</th>
                            <td>'.$tel.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">E-mail</th>
                            <td>'.$email.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">Page</th>
                            <td>'.$page.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">Size</th>
                            <td>';
                                $q    = mysql_query("SELECT * FROM ads_boxes WHERE id_ads=$id")or die (mysql_error());
                                while($size = mysql_fetch_array($q)){
                                    echo '| '.$size[0].' |';
                                }
                   echo '   </td>
                        </tr>
                        <tr>
                            <th style="width:20%;">Date</th>
                            <td>'.$dat.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">Version</th>
                            <td>'.$Version.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">Files</th>
                            <td><a href="../uploads/'.$file.'">
                            <i class="fa icon-download icon-large"></i> '.$file.'</a></td>
                        </tr>
                        <tr>
                            <th style="width:20%;">Description</th>
                            <td>'.$txt.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">status</th>
                            <td>'.$status.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">Options Edite</th>
                            <td>
                                <a href="index.php?p='.$_GET["p"].'&q=edit&id='.$id.'"><i class="fa icon-wrench icon-large"></i></a> 
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
        $id_edit= mysql_real_escape_string($_GET["id"]); ?>
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
                    $page       =  htmlspecialchars($row[1]);
                    
                    echo '  <tr>
                                <th style="width:20%;">Num</th>
                                <td><input type="text" name="num" value="'.$id.'" placeholder="'.$id.'" required /></td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Name</th>
                                <td><input type="text" name="name" value="'.$name.'" placeholder="'.$name.'"  /></td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Company Name</th>
                                <td><input type="text" name="co_name" value="'.$co_name.'" placeholder="'.$co_name.'" required /></td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Tele</th>
                                <td><input type="text" name="tel" value="'.$tel.'" placeholder="'.$tel.'" required /></td>
                            </tr>
                            <tr>
                                <th style="width:20%;">E-mail</th>
                                <td><input type="email" name="email" value="'.$email.'" placeholder="'.$email.'" required /></td>
                            </tr>
                            <tr>
                                <th style="width:20%;">page</th>
                                <td><select name="page" required>';
                                    $q  = mysql_query("SELECT * FROM pages")or die (mysql_error());
                                    while($row = mysql_fetch_array($q)){
                                        $id    =  htmlspecialchars($row[0]);
                                        $pag   =  htmlspecialchars($row[1]);
                                        if($page_id == $id){
                                            echo '<option selected="selected" value="'.$id.'">'.$pag.'</option>';
                                        }else{
                                            echo '<option value="'.$id.'">'.$pag.'</option>';
                                        }
                                    }
                                            
                       echo'        </select>
                                </td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Date</th>
                                <td>'.$dat.'</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Version</th>
                                <td><input type="text" name="dat" value="'.$Version.'" placeholder="'.$Version.'" required /></td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Files</th>
                                <td><a href="../uploads/'.$file.'">
                                <i class="fa icon-download icon-large"></i> '.$file.'</a></td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Description</th>
                                <td><textarea id="txt" name="txt"  cols="100" rows="10" placeholder="'.$txt.'">'.$txt.'</textarea></td>
                            </tr>
                            <tr>
                                <th style="width:20%;">status</th>
                                <td>
                                    <select name="type" id="type">';
                                     $s = array("active","inactive","hanging","finished");
                                     $i = 0;
                                     while($i < count($s)){
                                        if($status == $s[$i]){
                                            echo '<option selected="selected" value="'.$s[$i].'">'.$s[$i].'</option>';
                                        }else{
                                            echo '<option value="'.$s[$i].'">'.$s[$i].'</option>';
                                        }
                                        $i++;
                                     }
                                            
                       echo'         </select>
                                </td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Options Edite</th>
                                <td>
                                    <input name="update" type="submit" value="Submit"/>
                                </td>
                            </tr>';
                }          
                ?>
            </form>
          </tbody>
        </table>
    <?php
        if(isset($_POST['update'])){
            
            $name	            = strip_tags($_POST['name']);
            $co_name	        = strip_tags($_POST['co_name']);
            $tel	            = strip_tags($_POST['tel']);
            $email           	= strip_tags($_POST['email']);
            $page               = strip_tags($_POST['page']);
            $txt                = strip_tags($_POST['txt']);
            
            if(!empty($_POST['name'])){
                $up = mysql_query("UPDATE ads_newspaper SET 
                `name`=$name,
                `co_name`=$co_name,
                `tel`=$tel,
                `email`=$email,
                `page`=$page,
                `dat`=[value-7],
                `Version`=[value-8],
                `txt`=$txt,
                `status`=[value-11]
                WHERE id='$id_edit'") or die(mysql_error());
                if($up){
                    header("location: ./index.php?p=3&msg=1");
                }else{
                    header("location: ./index.php?p=3&msg=2");
                    die();
                }

            }else{
                echo '<center><img src="img/err.png" /></center>';
            }
        }
    //end edit 
    }else{
        header("Location: index.php&p=3");
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
                    <td><a href="../uploads/'.$file.'"><i class="fa icon-download icon-large"></i> '.$file.'</a></td>
                    <td>'.$status.'</td>
                    <td>
                        <a href="index.php?p='.$_GET["p"].'&q=edit&id='.$id.'"><i class="fa icon-wrench icon-large"></i></a> 
                        <a href="index.php?p='.$_GET["p"].'&q=show&id='.$id.'"><i class="fa icon-eye-open icon-large"></i></a>
                    </td>
                 </tr>';
        }          
        ?>
  </tbody>
</table>
<?php } ?>