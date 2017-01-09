<?php
include('./inc/function.php');
if(isset($_GET["q"])){
    //start show
    if($_GET["q"] == "show" and isset($_GET["id"])){ 
        
        $id_show= mysql_real_escape_string($_GET["id"]); ?>
    <table class="ads">  
      <tbody>
            <?php
            $select = "SELECT * FROM classified_ads WHERE id=$id_show";
            $query  = mysql_query($select)or die (mysql_error());
            while($row=mysql_fetch_array($query)){
                
                $id             =   htmlspecialchars($row['id']);
                $id_type        =   htmlspecialchars($row['id_type']);
                $tel            =   htmlspecialchars($row['tel']);
                $email          =   htmlspecialchars($row['email']);
                $region         =   htmlspecialchars($row['region']);
                $textad         =   htmlspecialchars($row['textad']);
                $dat            =   htmlspecialchars($row['dat']);
                $Version        =   htmlspecialchars($row['Version']);

                $selectType = "SELECT * FROM classified_type WHERE id=$id_type";
                $queryType  = mysql_query($selectType)or die (mysql_error());
                $Ty = mysql_fetch_row($queryType);

                echo '  <tr>
                            <th style="width:20%;">النوع</th>
                            <td>'.$Ty[1].'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">الهاتف</th>
                            <td>'.$tel.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">البريد</th>
                            <td>'.$email.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">المنطقة</th>
                            <td>'.$region.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">نص الاعلان</th>
                            <td>'.$textad.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">التاريخ</th>
                            <td>'.$dat.'</td>
                        </tr>
                        <tr>
                            <th style="width:20%;">الاصدار</th>
                            <td>'.$Version.'</td>
                        </tr>
                        <tr>
                            <td colspan="2" ><a href="index.php?p='.$_GET["p"].'"><i class="fa fa-chevron-left icon-large"> Back</i></a></td>
                        </tr>
                        ';
            }
            //end show         
            ?>
      </tbody>
    </table>
<?php 
    }    
}else{ ?>
<table class="ads">
  <thead>
      <tr>
          <th>النوع</th>
          <th>الهاتف</th>
          <th>البريد</th>
          <th>المنطقة</th>
          <th>نص الاعلان</th>
          <th>التاريخ</th>
          <th>الاصدار</th>
      </tr>
  </thead>   
  <tbody>
        <?php
        $select = "SELECT * FROM classified_ads ORDER BY id DESC";
        $query  = mysql_query($select)or die (mysql_error());
        while($row=mysql_fetch_array($query)){
            $id             =   htmlspecialchars($row['id']);
            $id_type        =   htmlspecialchars($row['id_type']);
            $tel            =   htmlspecialchars($row['tel']);
            $email          =   htmlspecialchars($row['email']);
            $region         =   htmlspecialchars($row['region']);
            $textad         =   htmlspecialchars($row['textad']);
            $dat            =   htmlspecialchars($row['dat']);
            $Version        =   htmlspecialchars($row['Version']);
            
            $selectType = "SELECT * FROM classified_type WHERE id=$id_type";
            $queryType  = mysql_query($selectType)or die (mysql_error());
            $Ty = mysql_fetch_row($queryType);
            
            echo '  <tr>
                    <td>'.$Ty[1].'</td>
                    <td>'.$tel.'</td>
                    <td>'.$email.'</td>
                    <td>'.$region.'</td>
                    <td>'.Cut_Text($textad).'</a></td>
                    <td>'.$dat.'</a></td>
                    <td>'.$Version.'</td>
                    <td colspan="2">
                        <a href="index.php?p='.$_GET["p"].'&q=show&id='.$id.'"><i class="fa icon-eye-open icon-large"></i></a>
                    </td>
                 </tr>';
        }          
        ?>
  </tbody>
</table>
<?php } ?>