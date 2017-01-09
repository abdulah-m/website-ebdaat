<?php
include('./inc/function.php');
if(isset($_GET["q"])){
    //start edit
    if($_GET["q"] == "edit" and isset($_GET["id"])){
        //start edit
        $id_edit= mysql_real_escape_string($_GET["id"]);
        if(isset($_POST['update'])){
            
            $name       = strip_tags($_POST['name']);
            $tele       = strip_tags($_POST['tele']);
            $email      = strip_tags($_POST['email']);
            $id_req     = strip_tags($_POST['id_request']);
            
            if(!empty($_POST['name'])){
                $query = " UPDATE print_requests SET name='$name',tele='$tele',email='$email',id_request='$id_req' WHERE id=".$id_edit;
                $up = mysql_query ($query) or die (mysql_error());
                    
                if($up){
                    header("location: ./index.php?p=".$_GET["p"]."&q=show&id=".$id_edit."&msg=1");
                }else{
                    header("location: ./index.php?p=".$_GET["p"]."&q=edit&id=".$id_edit."&msg=2");
                    die();
                }

            }
        }
?>
        <table class="ads">  
          <tbody>
              <form method="POST" action="">
                <?php
                $sel = "SELECT * FROM print_requests WHERE id=$id_edit";
                $que = mysql_query($sel)or die (mysql_error());
                $row = mysql_fetch_array($que);
        
                $id      =   htmlspecialchars($row['id']);
                $name    =   htmlspecialchars($row['name']);
                $tele    =   htmlspecialchars($row['tele']);
                $email   =   htmlspecialchars($row['email']);
                $id_req  =   htmlspecialchars($row['id_request']);
                $date_req=   htmlspecialchars($row['date_request']);

                //Get values requst from pub_spec table.
                $sel = "SELECT * FROM pub_spec WHERE id=$id_req";
                $que = mysql_query($sel)or die (mysql_error());
                $row    = mysql_fetch_array($que);

                $name_ar    = htmlspecialchars($row['name_ar']);

                echo '  <tr>
                            <th style="width:20%;">الاسم</th>
                            <td><input class="form-control required" type="text" name="name" value="'.$name.'" required/></td>
                        </tr>
                        <tr>
                            <th style="width:20%;">الهاتف</th>
                            <td><input class="form-control required" type="text" name="tele" value="'.$tele.'" required /></td>
                        </tr>
                        <tr>
                            <th style="width:20%;">البريد الالكتروني</th>
                            <td><input class="form-control required" type="email" name="email" value="'.$email.'" required /></td>
                        </tr>
                        <tr>
                            <th style="width:20%;">الطلب</th>
                            <td><select class="form-control required" name="id_request" required>';
                                $q  = mysql_query("SELECT * FROM pub_spec")or die (mysql_error());
                                while($row = mysql_fetch_array($q)){
                                    $idr     =  htmlspecialchars($row['id']);
                                    $name_ar =  htmlspecialchars($row['name_ar']);
                                    if($page_id == $idp){
                                        echo '<option selected="selected" value="'.$idr.'">'.$name_ar.'</option>';
                                    }else{
                                        echo '<option value="'.$idr.'">'.$name_ar.'</option>';
                                    }
                                }

                   echo'        </select>
                            </td>
                        </tr>
                        <tr>
                            <td  colspan="2">
                                <input name="update" type="submit" value="Save"/>
                            </td>
                        </tr>';       
                ?>
            </form>
          </tbody>
        </table>
    <?php
    //end edit 
    }elseif($_GET["q"] == "del" and isset($_GET["id"])){
        //start edit
        $id_del= mysql_real_escape_string($_GET["id"]);
        $sql = "DELETE FROM print_requests WHERE id=$id_del";
        $retval = mysql_query( $sql);
        if(!$retval )
        {
            header("location: ./index.php?p=".$_GET["p"]."&q=edit&id=".$id_edit."&msg=2");
            die();
        }else{
            header("location: ./index.php?p=".$_GET["p"]."&msg=1");
        }
    }else{
        header("Location: index.php?p=".$_GET["p"]);
    }
}else{ ?>
<table class="ads">
  <thead>
      <tr>
          <th>الاسم</th>
          <th>الهاتف</th>
          <th>البريد</th>
          <th>التاريخ</th>
          <th>الطلب</th>
          <th>خيارات</th>
      </tr>
  </thead>   
  <tbody>
        <?php
        $select = "SELECT * FROM print_requests ORDER BY id DESC";
        $query  = mysql_query($select)or die (mysql_error());
        while($row=mysql_fetch_array($query)){
            $id      =   htmlspecialchars($row['id']);
            $name    =   htmlspecialchars($row['name']);
            $tele    =   htmlspecialchars($row['tele']);
            $email   =   htmlspecialchars($row['email']);
            $id_req  =   htmlspecialchars($row['id_request']);
            $date_req=   htmlspecialchars($row['date_request']);
            
            //Get values requst from pub_spec table.
            $sel = "SELECT * FROM pub_spec WHERE id=$id_req";
            $que = mysql_query($sel)or die (mysql_error());
            $row    = mysql_fetch_array($que);

            $name_ar    = htmlspecialchars($row['name_ar']);
            
            echo '  <tr>
                    <td>'.$name.'</td>
                    <td>'.$tele.'</td>
                    <td>'.$email.'</td>
                    <td>'.$date_req.'</td>
                    <td><a href="index.php?p=6&q=show&id='.$id_req.'">'.$name_ar.' <i class="fa icon-eye-open"></i></a></td>
                    <td>
                        <a href="index.php?p='.$_GET["p"].'&q=edit&id='.$id.'"><i class="fa icon-wrench"></i></a> 
                        <a href="index.php?p='.$_GET["p"].'&q=del&id='.$id.'"><i class="icon-trash"></i></a>
                    </td>
                 </tr>';
        }          
        ?>
</div>
  </tbody>
</table>
<?php } ?>