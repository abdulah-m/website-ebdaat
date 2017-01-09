<?php 
include('./inc/function.php');
if(isset($_GET["q"])){
    if($_GET["q"] == "edit" and isset($_GET["id"])){
        $id_edit= mysql_real_escape_string($_GET["id"]); 
        if(isset($_POST['update'])){
            
            $type   = strip_tags($_POST['type']);
            $link   = strip_tags($_POST['link']);
            $title  = strip_tags($_POST['title']);
            
            $query = "UPDATE social SET type_id='$type', link='$link', title='$title' WHERE id=$id_edit";
            $up    = mysql_query ($query);
            if($up){
                header("location: ./index.php?p=".$_GET["p"]."&msg=1");
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
            $select = "SELECT * FROM social WHERE id=$id_edit";
            $query  = mysql_query($select)or die (mysql_error());
            $row    = mysql_fetch_array($query);
            $id             =   htmlspecialchars($row['id']);
            $id_type        =   htmlspecialchars($row['type_id']);
            $link           =   htmlspecialchars($row['link']);
            $title          =   htmlspecialchars($row['title']);
            
            echo '  <tr>
                        <th style="width:20%;">النوع</th>
                        <td><select class="form-control required" name="type" required>';
                        $q  = mysql_query("SELECT * FROM social_types")or die (mysql_error());
                        while($row = mysql_fetch_array($q)){
                            $idtype   =  htmlspecialchars($row[0]);
                            $type     =  htmlspecialchars($row[1]);
                            if($idtype == $id_type){
                                echo '<option selected="selected" value="'.$idtype.'">'.$type.'</option>';
                            }else{
                                echo '<option value="'.$idtype.'">'.$type.'</option>';
                            }
                        }                  
                       echo'</select>
                       </td>
                    </tr>
                    <tr>
                        <th style="width:20%;">الرابط</th>
                        <td><input class="form-control required" type="text" name="link" value="'.$link.'" required /></td>
                    </tr>
                    <tr>
                        <th style="width:20%;">العنوان</th>
                        <td><input class="form-control required" type="text" name="title" value="'.$title.'" required /></td>
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
        
        $r = mysql_fetch_row(mysql_query("SELECT * FROM social WHERE id=$id_del")) or die (mysql_error());
        $pathName = htmlspecialchars($r[5]);
        
        $sql = "DELETE FROM social WHERE id=$id_del";
        $retval = mysql_query( $sql);
        if(! $retval )
        {
            header("location: ./index.php?p=".$_GET["p"]."&msg=2");
            die();
        }else{
            header("location: ./index.php?p=".$_GET["p"]."&msg=1");
        }
        
    }elseif($_GET["q"] == "ins"){
        if(isset($_POST['submit'])){
            $type   = strip_tags($_POST['type']);
            $link   = strip_tags($_POST['link']);
            $title  = strip_tags($_POST['title']);

            if(!empty($type) && !empty($link) && !empty($title)){
                
                $sql ="INSERT INTO social (`type_id`, `link`, `title`) VALUES ('$type','$link','$title')";
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
                $q  = mysql_query("SELECT * FROM social_types")or die (mysql_error());
                while($row = mysql_fetch_array($q)){
                    $id    =  htmlspecialchars($row['id']);
                    $type   =  htmlspecialchars($row['type']);
                    echo '<option value="'.$id.'">'.$type.'</option>';
                } ?>
            </select><br />
            <input class="form-control required" type="text" name="link" placeholder="الرابط" required><br />
            <input class="form-control required" type="text" name="title" placeholder="العنوان" required><br />
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
          <th>النوع</th>
          <th>الرابط</th>
          <th>العنوان</th>
      </tr>
  </thead>   
  <tbody>
      <?php
        $select = "SELECT * FROM social";
        $query  = mysql_query($select)or die (mysql_error());
        while($row=mysql_fetch_array($query)){
            $id       =   htmlspecialchars($row['id']);
            $type     =   htmlspecialchars($row['type_id']);
            $link     =   htmlspecialchars($row['link']);
            $title    =   htmlspecialchars($row['title']);
            $q   = mysql_query("SELECT * FROM social_types WHERE id=$type")or die (mysql_error());
            $row = mysql_fetch_array($q);
            $t   = $row[1];
            echo '<tr>
                    <td>'.$t.'</td>
                    <td>'.$link.'</td>
                    <td>'.$title.'</td>
                    <td colspan="2">
                        <a href="index.php?p='.$_GET["p"].'&q=edit&id='.$id.'"><i class="fa icon-wrench icon-large"></i></a> 
                        <a href="index.php?p='.$_GET["p"].'&q=del&id='.$id.'"><i class="icon-trash icon-large"></i></a>
                    </td>
                 </tr>';      
        }?>
  </tbody>
</table>
<?php } ?>