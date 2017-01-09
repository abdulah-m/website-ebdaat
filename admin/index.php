<?php
session_start();
session_name('LoginForm');

@session_start();

error_reporting(0);
include("../config.php");

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>EBDAAT</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel='stylesheet' href='css/main.css' type='text/css' />
        <link rel='stylesheet' href='css/font-awesome.min.css' type='text/css' />
        <link rel='stylesheet' href='css/glyphicons.css' type='text/css' />
        <link rel='stylesheet' href='css/style-responsive.css' type='text/css' />
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:400,300,500' type='text/css' />
        <link rel='stylesheet' href='//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' type='text/css' />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
        <script src="js/jquery-1.8.2.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/main.js"></script>
    </head>
    <body>
<?php
	$error = '';
	if(isset($_POST['is_login'])){
		$sql = "SELECT * FROM ".$SETTINGS["USERS"]." WHERE `username` = '".mysql_real_escape_string($_POST['username'])."' AND `password` = '".mysql_real_escape_string($_POST['password'])."'";
		$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
		$user = mysql_fetch_assoc($sql_result);
		if(!empty($user)){
            ob_start();
            session_start();
			$_SESSION['user_info'] = $user;
			$query = " UPDATE ".$SETTINGS["USERS"]." SET last_login = NOW() WHERE id=".$user['id'];
			mysql_query ($query, $connection ) or die ('request "Could not execute SQL query" '.$query);
		}
		else{
			$error = 'Wrong username or password.';
		}
	}
	
	if(isset($_GET['ac']) && $_GET['ac'] == 'logout'){
		$_SESSION['user_info'] = null;
		unset($_SESSION['user_info']);
	}
?>
	<?php if(isset($_SESSION['user_info']) && is_array($_SESSION['user_info'])) { ?>
        <div class="container">
            <div class="row">
                <!-- start: nav Menu -->
                <nav id="navbar" class="animated fadeIn">
                    <ul>
                        <li><a href="./index.php?p=11"><i class="fa icon-key"></i>تغيير كلمة المرور</a></li>
                        <li><a href="index.php?ac=logout"><i class="fa icon-off"></i>خروج</a></li>
                    </ul>
                    <div id="logo">
                        <img src="img/logo-nav.png" />
                        
                    </div>
                </nav>
                <!-- end: nav Menu -->
            </div>
            <div class="row">
                <!-- start: sidebar -->
                <div id="sidebar">
                    <h1><?php// echo $_SESSION['user_info']['name']  ?></h1>
                    <ul>
                        <?php if($_SESSION['user_info']['level']==1){  ?>
                        <li><a href="./index.php?p=1"><i class="fa icon-cogs"></i><span> عام</span></a></li>	
                        <li><a href="./index.php?p=2"><i class="fa icon-picture"></i><span> سلايدر</span></a></li>
                        <li><a href="./index.php?p=3"><i class="fa icon-file"></i><span> اعلانات </span></a></li>
                        <li><a href="./index.php?p=4"><i class="fa icon-file"></i><span> مبوب</span></a></li>
                        <li><a href="./index.php?p=5"><i class="fa icon-leaf"></i><span> تصميم</span></a></li>
                        <li><a href="./index.php?p=6"><i class="fa icon-print"></i><span> مطبوعات</span></a></li>
                        <li><a href="./index.php?p=7"><i class="fa icon-print"></i><span> طلبات الطباعة</span></a></li>
                        <li><a href="./index.php?p=8"><i class="fa icon-certificate"></i><span>انواع التصميم و المطبوعات</span></a></li>
                        <li><a href="./index.php?p=9"><i class="fa icon-certificate"></i><span> شبكات التواصل</span></a></li>
                        <?php }else{ ?>
                        <li><a href="./index.php?p=3"><i class="fa icon-file"></i><span> اعلانات</span></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- end: sidebar -->
                <!-- start: content -->
                <div class="content">
                    <?php 
                    $title="";
                    if(isset($_GET["p"]))$p=$_GET["p"];else $p=0;
                    switch ($p){
                        case 1:
                            $title = "عام";
                            break;
                        case 2:
                            $title = "سلايدر";
                            break;
                        case 3:
                            $title = "اعلانات";
                            break;
                        case 4:
                            $title = "مبوب";
                            break;
                        case 5:
                            $title = "تصميم";
                            break;
                        case 6:
                            $title = "مطبوعات";
                            break;
                        case 7:
                            $title = "طلبات الطباعة";
                            break;
                        case 8:
                            $title = "انواع التصميم و المطبوعات";
                            break;
                        case 9:
                            $title = "شبكات التواصل";
                            break;
                        case 11:
                            $title = "تغيير كلمة المرور";
                            break;
                        default:
                            $title = "اهلا و سهلا ".$_SESSION['user_info']['name'];
                            break;
                    }?>
                    
                    <div class="title"><h1><?php echo $title;?></h1></div>
                    
                    <?php
                    if(isset($_GET["msg"])){
                        if($_GET["msg"] == 1){
                            echo '<center><img src="img/secc.png" /></center>';
                        }elseif($_GET["msg"] == 2){
                            echo '<center><img src="img/err.png" /></center>';
                        }
                    }
                                                                                 
                    if(isset($_GET["p"]))$p=$_GET["p"];else $p=0;
                    switch ($p){
                        case 1:
                            include("./general.php");
                            break;
                        case 2:
                            include("./slider.php");
                            break;
                        case 3:
                            include("./ads.php");
                            break;
                        case 4:
                            include("./Classified.php");
                            break;
                        case 5:
                            include("./design.php");
                            break;
                        case 6:
                            include("./publications.php");
                            break;
                        case 7:
                            include("./print_requests.php");
                            break;
                        case 8:
                            include("./typeDP.php");
                            break;
                        case 9:
                            include("./social.php");
                            break;
                        case 11:
                            include("./ch_pass.php");
                            break;
                        default:
                            echo "<center>اهلا و سهلا  ".$_SESSION['user_info']['name']."</center>";
                            //include("./count.php");
                            break;
                        }//end switch
                    ?>
                </div>
                <div class="clear"></div>
                <!-- end: content -->
            </div>
            <div class="row">
                <!-- start: footer -->
                <div id="footer">
                    جميع الحقوق محفوظة © 2015
                </div>
                <!-- end: footer -->
            </div>
        </div>
    <?php } else { ?>
            <form id="login-form" class="login-form" name="form1" method="post" action="index.php">
                <input type="hidden" name="is_login" value="1">
                <div class="h1">تسجيل الدخول</div>
                <div id="form-content">
                    <div class="group">
                        <!--<label for="username">اسم المستخدم :</label>-->
                        <div><input id="username" name="username" class="form-control required" type="text" placeholder="اسم المستخدم"></div>
                    </div>
                   <div class="group">
                        <!--<label for="name">كلمة المرور :</label>-->
                        <div><input id="password" name="password" class="form-control required" type="password" placeholder="كلمة المرور"></div>
                    </div>
                    <?php if($error) { ?>
                        <em>
                            <label class="err" for="password" generated="true" style="display: block;"><?php echo $error ?></label>
                        </em>
                    <?php } ?>
                    <div class="group submit">
                        <label class="empty"></label>
                        <div><input name="submit" type="submit" value="دخول"/></div>
                    </div>
                </div>
                <div id="form-loading" class="hide"><i class="fa fa-circle-o-notch fa-spin"></i></div>
            </form>
	<?php } ?>   
        
        
    </body>
</html>
