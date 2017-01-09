<?php 
include('./inc/function.php');
if(isset($_GET["q"])){
    $table = mysql_real_escape_string($_GET["table"]);
    
    if($_GET["q"] == "del" and isset($_GET["id"])){
        
        $id_del= mysql_real_escape_string($_GET["id"]);
        $sql = "DELETE FROM $table WHERE id=$id_del";
        $retval = mysql_query( $sql);
        if(! $retval )
        {
            header("location: ./index.php?p=".$_GET["p"]."&q=edit&id=".$id_del."&msg=2");
            die();
        }else{
            header("location: ./index.php?p=".$_GET["p"]."&msg=1");
        }
        
    }elseif($_GET["q"] == "ins"){
        if(isset($_POST['submit'])){
            $title      = strip_tags($_POST['title_ar']);
            $filter     = strip_tags($_POST['title_en']);
            $title_tr   = strip_tags($_POST['title_tr']);
            
            
            if(!empty($title) && !empty($filter)){
                
                $sql ="INSERT INTO $table (`title`, `filter`, `tr`) VALUES ('$title','$filter','$title_tr')";
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
                <input class="form-control required" type="text" name="title_ar" placeholder="العنوان العربي" required><br />
                <input class="form-control required" type="text" name="title_en" placeholder="العنوان الانكليزي" required><br />
                <input class="form-control required" type="text" name="title_tr" placeholder="العنوان التركي" required><br />
                <input type="submit" name="submit" value="ادخال">
            </form>
<?php  }
    }
}else{
echo '<a href="index.php?p='.$_GET["p"].'&q=ins&table=design_type"><i class="icon-plus-sign-alt icon-2x"></i></a>';
?>
<table class="ads">
  <thead>
      <tr>
          <th colspan="4">انواع التصميم</th>
      </tr>
      <tr>
          <th>عربي</th>
          <th>انكليزي</th>
          <th>تركي</th>
      </tr>
  </thead>   
  <tbody>
      <?php
        $select = "SELECT * FROM design_type ORDER BY id DESC";
        $query  = mysql_query($select)or die (mysql_error());
        while($row=mysql_fetch_array($query)){
            $id             =   htmlspecialchars($row['id']);
            $title          =   htmlspecialchars($row['title']);
            $filter         =   htmlspecialchars($row['filter']);
            $title_tr       =   htmlspecialchars($row['tr']);
            
            echo '<tr>
                    <td>'.$title.'</td>
                    <td>'.$filter.'</td>
                    <td>'.$title_tr.'</td>
                    <td colspan="2">
                        <a href="index.php?p='.$_GET["p"].'&q=del&table=design_type&id='.$id.'"><i class="icon-trash icon-large"></i></a>
                    </td>
                 </tr>';
        }?>
  </tbody>
</table>
<br />
<hr />
<?php
echo '<a href="index.php?p='.$_GET["p"].'&q=ins&table=publications_type"><i class="icon-plus-sign-alt icon-2x"></i></a>';
?>
<table class="ads">
  <thead>
      <tr>
          <th colspan="4">انواع المطبوعات</th>
      </tr>
      <tr>
          <th>عربي</th>
          <th>انكليزي</th>
          <th>تركي</th>
      </tr>
  </thead>   
  <tbody>
      <?php
        $select = "SELECT * FROM publications_type ORDER BY id DESC";
        $query  = mysql_query($select)or die (mysql_error());
        while($row=mysql_fetch_array($query)){
            $id             =   htmlspecialchars($row['id']);
            $title          =   htmlspecialchars($row['title']);
            $filter         =   htmlspecialchars($row['filter']);
            $title_tr       =   htmlspecialchars($row['tr']);
            
            echo '<tr>
                    <td>'.$title.'</td>
                    <td>'.$filter.'</td>
                    <td>'.$title_tr.'</td>
                    <td colspan="2">
                        <a href="index.php?p='.$_GET["p"].'&q=del&table=publications_type&id='.$id.'"><i class="icon-trash icon-large"></i></a>
                    </td>
                 </tr>';      
        }?>
  </tbody>
</table>
<?php } ?>