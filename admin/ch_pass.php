<?php
ob_start();
if(isset($_POST["chpass"])){
    if(isset($_SESSION['user_info']) && !empty($_POST["old"]) && !empty($_POST["new"]) && !empty($_POST["confirm"])) {
        
        $old        =   $_POST["old"];
        $new        =   $_POST["new"];
        $confirm    =   $_POST["confirm"];
        
        $userid     =   $_SESSION['user_info']['id'];
        
        $q      =   mysql_query("SELECT * FROM php_users_login WHERE id='$userid'") or die(mysql_error());
        $check  =   mysql_fetch_row($q);
        
        if($check['0'] == $userid){
            
            if($new == $confirm){
                
                $up = mysql_query("UPDATE php_users_login SET password='$new' WHERE id='$userid'") or die(mysql_error());
                if($up){
                    header("location: ./index.php?p=6&msg=1");
                }else{
                    header("location: ./index.php?p=6&msg=2");
                    die();
                }
                
            }else{
                  header("location: ./index.php?p=6&msg=2");
                  die();
            }
        }else{
            header("location: ./index.php?p=6&msg=2");
            die();
        }
    }else{
            header("location: ./index.php?p=6&msg=2");
            die();
    }
}else{
    
?>
    <fieldset>
        <legend>Please enter your current password and then enter the new password and repeated in the confirmation box</legend>
        <form method="post" action="index.php?p=6">
            <table>
                <tr>
                    <td>Old password</td>
                    <td><input class="form-control required" type="password" name="old"></td>
                </tr>
                <tr>
                    <td>New password</td>
                    <td><input class="form-control required" type="password" name="new"></td>
                </tr>
                <tr>
                    <td>Confirm new password</td>
                    <td><input  class="form-control required" type="password" name="confirm"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="chpass" value="change"></td>
                </tr>
            </table>
        </form>
    </fieldset>
<?php } ?>