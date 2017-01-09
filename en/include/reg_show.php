<?php
include('../../config.php');

if(!empty($_POST['name']) and !empty($_POST['tele']) and !empty($_POST['email']) and !empty($_POST['data_id'])){
    $name       =   strip_tags($_POST['name']);
    $tele       =   strip_tags($_POST['tele']);
    $email      =   strip_tags($_POST['email']);
    $data_id    =   strip_tags($_POST['data_id']);


    $insert = "INSERT INTO print_requests ( name, tele, email, id_request, date_request)
                                 VALUES ('$name','$tele','$email','$data_id',now())";
    $query = mysql_query($insert);

    if(isset($query))
    {
        echo '<center>
                <div class="success">Your request has been registered successfully will visit you as soon as our agent
                    <table>
                        <tr>
                            <th>Name</th>
                            <td>'.$name.'</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>'.$tele.'</td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td>'.$email.'</td>
                        </tr>
                    </table><hr>';

            $s = "SELECT * FROM pub_spec WHERE id=$data_id";
            $q = mysql_query($s)or die (mysql_error());
            while($row = mysql_fetch_array($q)){
                $name_r     = htmlspecialchars($row['name_en']);
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

                echo '<table>
                        <tr>
                            <th>Name</th>
                            <td>'.$name_r.'</td>
                        </tr>
                        <tr>
                            <th>Size</th>
                            <td>'.$size.'</td>
                        </tr>
                        <tr>
                            <th>Number of pages</th>
                            <td>'.$num_page.'</td>
                        </tr>
                        <tr>
                            <th>Faces</th>
                            <td>';
                            if($faces == 1){
                                echo 'One face';
                            }else{
                                echo 'Two faces';
                            }
                echo   '</td>
                        </tr>
                        <tr>
                            <th>Paper thickness</th>
                            <td>'.$thick.'</td>
                        </tr>
                        <tr>
                            <th>Paper type</th>
                            <td>'.$paper_type.'</td>
                        </tr>
                        <tr>
                            <th>Cover thickness</th>
                            <td>'.$cover_thick.'</td>
                        </tr>
                        <tr>
                            <th>cellophane</th>
                            <td>';
                            $s = array("Without cellophane","cellophane glossy","cellophane DIED","cellophane was + polishing");
                            $i = 0;
                            while($i < count($s)){
                                if($i==$slovan-1){
                                    echo $s[$i];
                                    break;
                                }
                                $i++;
                            }
                echo        '</td>
                        </tr>
                        <tr>
                            <th>Number</th>
                            <td>'.$number.'</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>'.$price.'TL</td>
                        </tr>

                    </table><hr>';
            }
        echo '</div>
        </center>';
    }
    else
    {
        echo '<center><div class="err"> There is an error please try again</div></center>';
    }
}else{
    echo '<center><div class="err"> Please fill out the required fields</div></center>';
}
?>