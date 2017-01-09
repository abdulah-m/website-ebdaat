    </div>
    <div class="container">
        <footer>
            <div class="row-h">
               <div class="social">
                    <ul class="social-share">
                        <?php
                        $selectSocial = "SELECT * FROM social";
                        $querySocial  = mysql_query($selectSocial)or die (mysql_error());
                        while($row=mysql_fetch_array($querySocial)){
                            $link=htmlspecialchars($row[2]);
                            $title=htmlspecialchars($row[3]);
                            $selectType="SELECT icon FROM social_types where id=$row[1]";
                            $queryType=mysql_query($selectType)or die (mysql_error());
                            $class=mysql_fetch_row($queryType);
                            echo '
                                <li>
                                    <a href="http://'.$link.'" title="'.$title.'" target="_blank">
                                        <i class="fa '.$class[0].'"></i>
                                    </a>
                                </li>';
                        }?>
                    </ul>
               </div>
            </div>
            <div class="row-h">
                <form id="mailing-list-form" method="post" action="">
                    <input type="email" name="email" value="" placeholder="Subscribe to our mailing list to receive all what's new" />
                    <button name="submitmailing" value="">Send</button>
                </form>
                <?php
                    if (isset($_POST['submitmailing'])) {
                        if (!empty($_POST['email'])) {
                                $from_name = $_POST['email'];
                                $from_mail = $_POST['email'];
                                $replyto   = $_POST['email'];
                                $subject   = " Mailing Subscript ";
                                $message   = " You have a new account on the mailing list by Site: ".'\r\n ';
                                $message  .= "E-mail : ".$_POST['email'].'\r\n ';
                                $message  .= "------------------------ ".'\r\n ';
                                $mailto    = s_email;
                                $sendmail  = mail_attachment($mailto, $from_mail, $from_name, $replyto, $subject, $message);

                                if ($sendmail){
                                    echo '<div class="success">Send a thank you successfully been</div>';
                                }else{
                                    echo '<div class="err">There is no transmitting error, please try again</div>';
                                }
                        }else{
                            echo '<div class="err">There is no transmitting error, please try again</div>';
                        }
                    }
                ?>
            </div>
            <div class="row-h">
                <div class="copy"><?php echo s_copy; ?></div>
            </div>
        </footer>
    </div>
    <!------------------------------------- script --------------------------------------------->
    <!-- Google Map -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="js/jquery.gmap3.min.js"></script>
    <!-- Google Map Init-->
    <script type="text/javascript">
        jQuery(function($){
            $('#map_canvas').gmap3({
                marker:{

                    address: '41.021856, 28.916009'
                },
                map:{
                    options:{
                        zoom: 15,
                        scrollwheel: false,
                        streetViewControl : true
                    }
                }
            });
        });
    </script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>

    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script type="text/javascript">
                $('.portfolio-filter-p a').click(function(){
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "include/table_show.php",
                    type: "POST",
                    data: "id="+id,
                    dataType: 'html',
                    success: function(data) {
                        $('#layout').html(data);  
                        
                        $('.apply').click(function(){
                            var id = $(this).attr('data-id');
                                                        
                            if($('#app_pub').css('display') == 'none'){
                                $('#app_pub .conte').remove();
                                $('#app_pub').fadeIn(600);
                                if($('#app_pub form').length == 0){
                                    $('#app_pub').append('<form method="post" action="include/reg_show.php" accept-charset="utf-8"><input type="text"  name="name"  placeholder="Name"   required/><input type="text"  name="tele"  placeholder="Phone" required/><input type="email" name="email" placeholder="E-mail" required/><button name="submit">send</button></form>');
                                }
                                var form = $('#app_pub form');
                                
                                form.submit(function(event){
                                    
                                    //disable the default form submission
                                    event.preventDefault();
                                    if($('#app_pub form input:hidden[name=data_id]').length == 0){
                                        form.append('<input type="hidden" name="data_id" value="'+id+'" />');
                                    }
                                    if($('#app_pub .conte').length == 0){
                                        $('#app_pub').append('<div class="conte"></div>');
                                    }
                                    //grab all form data  
                                    var formData = new FormData($(this)[0]);
                                    $.ajax({
                                        url         :$(this).attr('action'),
                                        type        :'POST',
                                        data        : formData,
                                        async       : false,
                                        cache       : false,
                                        contentType : false,
                                        processData : false,
                                        dataType    : 'html',
                                        success     : function(data) {
                                            $('#app_pub .conte').html(data);   
                                            $('#app_pub form').remove();
                                            
                                        },  
                                    });
                                });
                                
                            }else {
                                $('#app_pub').fadeOut(600);
                                $('#app_pub form').remove();
                                $('#app_pub .conte').remove();
                            }
                            $('#close_app_pub').click(function(){
                                $('#app_pub').fadeOut(600);
                                $('#app_pub form').remove();
                                $('#app_pub .conte').remove();
                            });
                        });
                    },  
                });
            });
        
        $('#add_ads_a').click(function(){
            if($('#add_ads').css('display') == 'none'){
                $('#add_ads').fadeIn(600);


                $('.optRad').click(function(){
                    var page_id = $('input:radio[name=pagenum]:checked').val();

                    $.ajax({
                        url: "include/page_show.php",
                        type: "POST",
                        data: "page_id="+page_id,
                        dataType: 'html',
                        success: function(data) {
                            $('#step_2').html(data); 
                            $('#step_2 .area-ad .checkb').asCheck({
                                skin: 'skin-1'
                            });  
                        },  
                    });
                });

                var form = $('#add-ad-form');
                form.submit(function(event){
                    //disable the default form submission
                    event.preventDefault();

                    //grab all form data  
                    var formData = new FormData($(this)[0]); 

                    $.ajax({
                        url         :$(this).attr('action'),
                        type        :'POST',
                        data        : formData,
                        async       : false,
                        cache       : false,
                        contentType : false,
                        processData : false,
                        dataType    : 'html',
                        success     : function(data) {
                            $('#status').html(data);    
                        },  
                    });
                });
            }else {
                $('#add_ads').fadeOut(600);
            }
            $('#close_box').click(function(){
                $('#add_ads').fadeOut(600);
            });
        });

        $('#link_classified').click(function(){
            if($('#classified').css('display') == 'none'){
                $('#classified').fadeIn(600);
            }else {
                $('#classified').fadeOut(600);
            }
            $('#close_class').click(function(){
                $('#classified').fadeOut(600);
            });
        });
        $('#calc_pub').click(function(){
            if($('#publ_form').css('display') == 'none'){
                $('#publ_form').fadeIn(600);
                var form = $('#publ_form2');
                form.submit(function(event){
                    //disable the default form submission
                    event.preventDefault();
                    //grab all form data  
                    var formData = new FormData($(this)[0]); 

                    $.ajax({
                        url         :$(this).attr('action'),
                        type        :'POST',
                        data        : formData,
                        async       : false,
                        cache       : false,
                        contentType : false,
                        processData : false,
                        dataType    : 'html',
                        success     : function(data) {
                            $('#publ_status').html(data);
                        },  
                    });
                });
            }else {
                $('#publ_form').fadeOut(600);
            }
            $('#close_box').click(function(){
                $('#publ_form').fadeOut(600);
            });
        });
    </script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="js/jquery-asCheck.js"></script>
    <!--start add_ads -->
    <div id="add_ads" style="display:none;">
        <a id="close_box" href="#" ><img src="img/close_btn.png" /></a>
        <div id="status"></div>
        <form id="add-ad-form" name="add-ad-form" method="post" action="include/add_ads.php"  enctype="multipart/form-data" accept-charset="utf-8">
            <div id="step_1">
                <table>
                    <tr>
                        <td class="star"><label for="name">*</label></td>
                        <td class="inp" colspan="2"><input id="name" class="inputtxt" type="text" name="name" value="" placeholder="Name" required /></td>
                    </tr>
                    <tr>
                        <td class="star"><label for="co_name">*</label></td>
                        <td class="inp" colspan="2"><input id="co_name" class="inputtxt" type="text" name="co_name" value="" placeholder="Company" required /></td>
                    </tr>
                    <tr>
                        <td class="star"><label for="tel">*</label></td>
                        <td class="inp" colspan="2"><input id="tel" class="inputtxt" type="text" name="tel" value="" placeholder="Phone" required /></td>
                    </tr>
                    <tr>
                        <td class="star"><label for="email">*</label></td>
                        <td class="inp" colspan="2"><input id="email" class="inputtxt" type="email" name="email" value="" placeholder="Email" required /></td>
                    </tr>
                    <tr>
                        <td class="star"></td>
                        <td class="inp" colspan="2"><input id="uploadedfile" type="file" name="uploadedfile"/></td>
                    </tr>
                    <tr>
                        <td class="star"></td>
                        <td class="inp" colspan="2"><textarea id="txt" name="txt" placeholder="Advertising Information"></textarea></td>
                    </tr>
                        <?php
                        $select_page = "SELECT * FROM pages";
                        $query_page  = mysql_query($select_page)or die (mysql_error());
                        while($row = mysql_fetch_array($query_page)){
                            $id         =  htmlspecialchars($row[0]);
                            $title      =  htmlspecialchars($row[1]);
                            $boxes_num  =  htmlspecialchars($row[4]);
                            echo '<tr><td class="star"><input type="radio" name="pagenum" class="optRad" id="optionsRadios'.$id.'" value="'.$id.'" required /></td>
                                  <td class="inp" colspan="2"><label for="optionsRadios'.$id.'">Page '.$title.'</label></td></tr>
                                ';
                        }?>
                </table>
            </div>
            <div id="step_2">
            </div>
            <div class="clear"></div>
            <button id="submit-ads" name="submit-ads" value="">Submit</button>
        </form>
    </div>
    <!--end  add_ads -->
    <!--start classified -->
    <div id="classified" style="display:none;"> 
        <a id="close_class" href="#" ><img src="img/close_btn.png" /></a>
        <h1>Add a free ad classified</h1>
        <form method="post" action="include/classified.php">
            <input id="tel" type="text"  name="tel" placeholder="Phone" />
            <input id="email" type="email" name="email" placeholder="Email" />
            <input id="region" type="text" name="region" placeholder="Region" />
            <select name="type" id="type">
                <option value="" selected="selected">Choose Ad Type</option>
                <?php
                $selectType = "SELECT * FROM classified_type";
                $queryType  = mysql_query($selectType)or die (mysql_error());
                while($row=mysql_fetch_array($queryType)){
                    $idType    =  htmlspecialchars($row[0]);
                    $title     =  htmlspecialchars($row[1]);
                    $Type      =  htmlspecialchars($row[2]);

                    echo '<option value="'.$idType.'">'.$Type.'</option>';
                }?>
            </select>
            <textarea id="textad" name="textad" maxlength="200" placeholder="Advertising Text"></textarea>
            <button id="classified_btn" name="classified_btn">Send</button>
        </form>
    </div>
<!--start -->
        <div id="app_pub" style="display:none;"> 
            <a id="close_app_pub" href="#" ><img src="img/close_btn.png" /></a>
            <form method="post" action="include/reg_show.php" accept-charset="utf-8">
                <input type="text"  name="name"  placeholder="name"   required/>
                <input type="text"  name="tele"  placeholder="phone" required/>
                <input type="email" name="email" placeholder="E-mail" required/>
                <button name="submit">send</button>
            </form>
            <div class="conte"></div>
        </div>
        <!--end  -->
    <?php
    if(isset($_GET["msg"])){
        if($_GET["msg"] == 1){
            echo '<div id="done"> Done successfully </div>';
            echo '<meta http-equiv="refresh" content="5;URL='.$_SERVER["PHP_SELF"].'" />';
         }elseif($_GET["msg"] == 2){ 
            echo'<div id="error"> There is a problem please try </div>';
            echo '<meta http-equiv="refresh" content="5;URL='.$_SERVER["PHP_SELF"].'" />'; 
        }
    } 
    ?>
    <!--end classified -->

    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.carousel').carousel({
                interval: 2000
            });
        });
    </script>
	</body>
</html>