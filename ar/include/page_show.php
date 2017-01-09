<?php
include('../../config.php');
include('function.php');

$page_id = $_POST['page_id'];

$select_page = "SELECT * FROM pages WHERE id=$page_id";
$query_page  = mysql_query($select_page)or die (mysql_error());
$row         = mysql_fetch_row($query_page);
$title       = htmlspecialchars($row[2]);
$box_price   = htmlspecialchars($row[3]);
$boxes_num   = htmlspecialchars($row[4]);
//get date today
$d                  = strtotime("today");
$dat                = date("Y-m-d h:i:s", $d);
$Version            = date("W", strtotime($dat));
$Version            = $Version/2;

echo '      <table>
                <tr>
                    <td colspan="6"> الصفحة '.$title.' </td>
                </tr>';

$i = 1;
$j = 1;
while($i <= $boxes_num){
    
    $select_box = "SELECT * FROM ads_boxes WHERE val=$i AND id_page=$page_id AND version=$Version";
    $query_box  = mysql_query($select_box)or die (mysql_error());
    $row = mysql_fetch_row($query_box);

    if($i ==1 && $page_id == 1){
        echo '<tr>
                <td colspan="6"><img src="img/head-1.png" /></td>
              </tr>
              <tr>';
    }elseif($i ==1 && $page_id == 2){
        echo '<tr>
                <td colspan="6"><img src="img/head-2.png" /></td>
              </tr>
              <tr>';
    }elseif($i ==1 && $page_id == 3){
        echo '<tr>
                <td colspan="6"><img src="img/head-3.png" /></td>
              </tr>
              <tr>';
    }
    
    if($page_id == 3){
        echo '  <td class="area-ad">
                    <label for="checkbox'.$i.'"></label>
                    <input type="checkbox" class="checkb" name="boxe[]" value="'.$i.'" id="checkbox'.$i.'"/>
                </td>';
    }else{
        if($row[2]==$i){
            
            echo '<td class="area-ad" style="background:red;color:#fff;">
                    <label for="checkbox'.$i.'"></label>
                    <input type="checkbox" class="checkb" name="boxe[]" value="'.$i.'" id="checkbox'.$i.'" disabled />
                  </td>';
        }else{
            echo '<td class="area-ad">
                    <label for="checkbox'.$i.'"></label>
                    <input type="checkbox" class="checkb" name="boxe[]" value="'.$i.'" id="checkbox'.$i.'" />
                  </td>';
        }
    }
    if($j == 6){
       echo '</tr><tr>';
        $j = 1;
    }else{
        $j++; 
    }
    $i++;
}
echo '           </tr>
            </table>';  
?>

    
        