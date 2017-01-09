<?php
include('../../config.php');
include('function.php');

$id = $_POST['id'];
echo '<table>
        <tr>
            <th>Önizleme</th>
            <th>isim</th>
            <th>Boyutu</th>
            <th>yüzleri</th>
            <th>Sayfa sayısı</th>
            <th>Kağıt kalınlığı</th>
            <th>Kağıt türü</th>
            <th>Kapak kalınlığı</th>
            <th>selofan</th>
            <th>numara</th>
            <th>fiyat</th>
            <th></th>
        </tr>
        ';

$select = "SELECT * FROM pub_spec WHERE id_type=$id";
$query  = mysql_query($select)or die (mysql_error());
$count  = mysql_num_rows($query)-1;
while($row = mysql_fetch_array($query)){
    $id         = htmlspecialchars($row['id']);
    $id_type    = htmlspecialchars($row['id_type']);
    $name       = htmlspecialchars($row['name_tr']);
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
                <td>
                    <img width="150px" src="../images/publications/recent/'.$image.'"/>
                </td>
                
                <td>'.$name.'</td>
                <td>'.$size.'</td>
                <td>';
                if($faces == 1){
                    echo 'Bir yüzü';
                }else{
                    echo 'iki yüz';
                }
                
    echo       '</td>
                <td>'.$num_page.'</td>
                <td>'.$thick.'g</td>
                <td>'.$paper_type.'</td>
                <td>'.$cover_thick.'</td>
                <td>';
                $s = array("Selofan olmadan", "selofan parlak", "selofan polisaj + oldu", "selofan ÖLDÜ");
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
                <td><a class="apply btn btn-default" href="#" data-id="'.$id.'">istek</a></td>
            </tr>
    ';
}
echo '
        </table>
    ';
?>

    
        