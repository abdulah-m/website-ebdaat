<?php 
include('./inc/function.php');
if(isset($_GET["q"])){
    if($_GET["q"] == "show" and isset($_GET["id"])){ 
        $id_show= mysql_real_escape_string($_GET["id"]); ?>
    <table class="ads">  
      <tbody>
            <?php
            $select = "SELECT * FROM slider WHERE id=$id_show";
            $query  = mysql_query($select)or die (mysql_error());
            $row    = mysql_fetch_array($query);
            $image  =   htmlspecialchars($row['src']);
        
            echo '  <tr>
                        <td><img width="100%" src="../images/slider/'.$image.'"/></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="index.php?p='.$_GET["p"].'"><i class="icon-double-angle-left icon-large"></i></a>
                            <a href="index.php?p='.$_GET["p"].'&q=del&id='.$id_show.'"><i class="icon-trash icon-large"></i></a>
                        </td>
                    </tr>';     
            ?>
      </tbody>
    </table>
<?php 
    }elseif($_GET["q"] == "del" and isset($_GET["id"])){
        $id_del= mysql_real_escape_string($_GET["id"]);
        
        $r = mysql_fetch_row(mysql_query("SELECT * FROM slider WHERE id=$id_del")) or die (mysql_error());
        $pathName = htmlspecialchars($r[1]);
        
        $sql = "DELETE FROM slider WHERE id=$id_del";
        $retval = mysql_query( $sql);
        if(!$retval )
        {
            header("location: ./index.php?p=".$_GET["p"]."&q=show&id=".$id_del."&msg=2");
            die();
        }else{
            if(file_exists($pathF)){
                unlink("../images/slider/".$pathName);
            }elseif(!@unlink($pathF)){
                unlink("../images/slider/".$pathName);
            }
            header("location: ./index.php?p=".$_GET["p"]."&msg=1");
        }
        
    }elseif($_GET["q"] == "ins"){
        if(isset($_POST['submit'])){
            $target_path = "no-image.jpg";
            if(!empty($_FILES["file"])){
                $c = 0;
                $sel = "SELECT * FROM slider";
                $q   = mysql_query($sel) or die (mysql_error());
                while($row=mysql_fetch_array($q)){
                    $c    =   htmlspecialchars($row[0]);
                }
                $c++;
                $temp = explode(".", $_FILES["file"]["name"]);
                $extension = end($temp);
                if (move_uploaded_file($_FILES["file"]["tmp_name"],"../images/slider/slider".$c.".".$extension)) {
                    $target_path = "slider".$c.".".$extension;
                    smart_resize_image("../images/slider/".$target_path,null,1169,487);
                }
                else {
                    $target_path = "no-image.jpg";
                }

                $sql ="INSERT INTO slider (`id`,`src`) VALUES ('$c','$target_path')";
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
            <input class="form-control required" type="file" name="file" required><br />
            <input type="submit" name="submit" value="إرسال">
        </form>
<?php  }
    }
}else{
    echo '<a href="index.php?p='.$_GET["p"].'&q=ins"><i class="icon-plus-sign-alt icon-2x"></i></a>';
?>
<table class="ads"> 
  <tbody>
      <?php
        $select = "SELECT * FROM slider ORDER BY id DESC";
        $query  = mysql_query($select)or die (mysql_error());
        while($row=mysql_fetch_array($query)){
            $id    =   htmlspecialchars($row['id']);
            $image =   htmlspecialchars($row['src']);
            
            echo '<tr>
                    <td><a href="index.php?p='.$_GET["p"].'&q=show&id='.$id.'"><img width="200px" src="../images/slider/'.$image.'" /></a><br />
                        <a href="index.php?p='.$_GET["p"].'&q=del&id='.$id.'"><i class="icon-trash icon-large"></i></a>
                    </td>
                 </tr>';      
        }?>
  </tbody>
</table>
<?php } ?>