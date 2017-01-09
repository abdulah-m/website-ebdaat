<?php 
include"header.php";
include"include/function.php";
?>
        <section class="content">
            <div class="row-h">
                <div class="mapcon">
                    <div class="googlemap-wrapper">
                        <div id="map_canvas" class="map-canvas"></div>
                    </div>
                </div>
            </div>
            <div class="contact-det">
                <ul id="contact-info">
                    <li><i class="fa fa-phone-square"> </i> <?php echo s_tel; ?></li>
                    <li><i class="fa fa-phone"></i>  <?php echo s_mob; ?></li>
                    <li><i class="fa fa-envelope"></i> <a href="mailto://<?php echo s_email; ?>"> <?php echo s_email; ?></a></li>
                    <li><i class="fa fa-home"></i> <?php echo s_address; ?></li>
                </ul>
                <form id="contact-us-form" method="post" action="">
                    <input type="text" size="30" name="name" value="" placeholder="Name" required />
                    <input type="email" size="30" name="email" value="" placeholder="Email" required />
                    <input type="text" size="30" name="subject" value="" placeholder="Subject"/>
                    <textarea name="msg" placeholder="Message"></textarea>
                    <button name="submitcontact" value="">Send</button>
                </form>
                <?php
                if (isset($_POST['submitcontact'])) {
                    $from_name = $_POST['name'];
                    $from_mail = $_POST['email'];
                    $replyto   = $_POST['email'];
                    $subject   = $_POST['subject'];
                    $message   = $_POST['msg'];
                    $mailto    = s_email;
                    $sendmail  = mail_attachment($mailto, $from_mail, $from_name, $replyto, $subject, $message);

                    if ($sendmail){
                        echo '<div class="success">Send a thank you successfully been</div>';
                    }else{
                        echo '<div class="err">There is no sending error, please try again</div>';
                    }
                }
                ?>
            </div>
        </section>
<?php include"footer.php"; ?>