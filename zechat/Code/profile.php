<?php
require_once('app/config.php');
require_once('app/setting.php');

$uName = strtolower($_GET['uname']);
if(!isset($_GET['uname']))
{
    echo "Error in Url";
    exit();
}
if(isset($_SESSION['username']))
{
    $sesUsername = strtolower($_SESSION['username']);
    if($sesUsername == $uName){
        echo '<script type="text/javascript"> window.location = "index.php" </script>';
        exit();
    }
}




$query1 = "SELECT * FROM `".$config['db']['pre']."userdata` where username = '".$_GET['uname']."'";
$result1 = $con->query($query1);
if(mysqli_num_rows($result1)==0){
    //and we send 0 to the ajax request
    echo "Error: USERID not available";
    exit();
}
$row1 = mysqli_fetch_assoc($result1);

$res1 = mysqli_query($con, "SELECT * FROM `".$config['db']['pre']."userdata` WHERE id='".$row1['id']."' AND TIMESTAMPDIFF(MINUTE, last_active_timestamp, NOW()) > 1;");
if($res1 === FALSE) {
    die(mysqli_error($con)); // TODO: better error handling
}
$num1 = mysqli_num_rows($res1);
if($num1 == "0")
    $onofst1 = "Online";
else
    $onofst1 = "Offline";


$string = $row1['username'];
$sesuserpic = $row1['picname'];

if($sesuserpic == "")
    $sesuserpic = "avatar_default.png";

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title><?php echo $row1['name'];?> - Zechat Profile</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="php chat script, php ajax Chat,facebook similar chat, php mysql chat, chat script, facebook style chat script, gmail style chat script. fbchat, gmail chat, facebook style message inbox, facebook similar inbox, facebook like chat" />
    <meta name="description"  content="This jQuery chat module easily to integrate Gmail/Facebook style chat into your existing website." />
    <meta name="author" content="Zechat - Codentheme.com">
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        /*Loader start*/
        .hidden {  display: none!important;  visibility: hidden!important;  }
        .text-center {  text-align: center;  }
        .Dboot-preloader {  background-color: #fff;  display: block;  width: 100%;  height: 100%;  position: fixed;  z-index: 999999999999999;  }
        /*Loader end*/
    </style>
</head>

<body>
<!--/*Loader start*/-->
<div class="Dboot-preloader text-center">
    <img src="assets/img/loader.gif" width="400"/>
</div>

<div class="entry-board J_entryBoard">
    <div class="container">
        <ul class="external-entries">
            <li class="entry"><a href="index.php" target="_self">My Profile</a></li>
        </ul>

        <div class="account-info ">
            <div class="sign-entries" id="J_signEntries" style="display: block;">
                <ul>
                    <li class="entry">
                        <a href="https://codecanyon.net/item/wchat-fully-responsive-phpajax-chat/18047319" target="_blank">Facebook Like Inbox Messaging</a>
                    </li>
                    <li class="entry">
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div align="center" style="color: #fff; background-color: #778492; padding: 5px;">
    <div class="container"><span style="text-align: center;">Note: Please load the following links in different browsers with2 different USERID For Testing:</span></div>
</div>
<!--/*Loader END*/-->


<!-- ******HEADER****** -->
<header class="header">
    <div class="container">
        <div class="profile-picture medium-profile-picture mpp XxGreen pull-left">
            <img width="169px" style="min-height:170px;" src="storage/user_image/<?php echo $sesuserpic; ?>">
        </div>

        <div class="profile-content pull-left">
            <h1 class="name"><?php echo $row1['name'];?></h1>
            <h2 class="desc">#<?php echo $row1['username'];?></h2>
            <ul class="social list-inline">
                <?php if(!empty($row1['facebook'])){?>
                    <li><a href="<?php echo $row1['facebook'];?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <?php } ?>
                <?php if(!empty($row1['twitter'])){?>
                    <li><a href="<?php echo $row1['twitter'];?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <?php } ?>
                <?php if(!empty($row1['googleplus'])){?>
                    <li><a href="<?php echo $row1['googleplus'];?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                <?php } ?>
                <?php if(!empty($row1['instagram'])){?>
                    <li><a href="<?php echo $row1['instagram'];?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                <?php } ?>
            </ul>
        </div><!--//profile-->
        <?php
        if(isset($_SESSION['id']) ){ ?>
            <a class="btn btn-cta-primary pull-right" href="javascript:void(0)" onclick="javascript:chatWith('<?php echo $row1['username'] ?>','<?php echo $row1['id'] ?>','<?php echo $sesuserpic; ?>','<?php echo $onofst1; ?>')"> <i class="fa fa-paper-plane"></i>Start Chat</a>

        <?php }else{ ?>
            <a class="btn btn-cta-primary pull-right" href="login.php"><i class="fa fa-paper-plane"></i>Start Chat</a>
        <?php } ?>
    </div><!--//container-->
</header><!--//header-->




<div class="container sections-wrapper">
    <div class="row">
        <div class="primary col-md-8 col-sm-12 col-xs-12">
            <section class="about section">
                <div class="section-inner">
                    <h2 class="heading">About Me</h2>
                    <div class="content">
                        <?php echo $row1['about'];?>

                    </div><!--//content-->
                </div><!--//section-inner-->
            </section><!--//section-->

        </div><!--//primary-->
        <div class="secondary col-md-4 col-sm-12 col-xs-12">
            <aside class="info aside section">
                <div class="section-inner">
                    <h2 class="heading sr-only">Basic Information</h2>
                    <div class="content">
                        <ul class="list-unstyled">
                            <?php
                            if(!empty($row1['sex']))
                            {
                                if($row1['sex'] == "male")
                                {
                                    ?><li><i class="fa fa-mars"></i><span class="sr-only">Sex:</span>Male</li><?php
                                }
                                else{
                                    ?><li><i class="fa fa-venus"></i><span class="sr-only">Sex:</span>Female</li><?php
                                }
                            }
                            ?>


                            <li><i class="fa fa-birthday-cake"></i><span class="sr-only">DOB:</span><?php echo $row1['dob'];?></li>
                            <li><i class="fa fa-map-marker"></i><span class="sr-only">Location:</span><?php echo $row1['country'];?></li>
                            <li><i class="fa fa-envelope-o"></i><span class="sr-only">Email:</span><a href="#"><?php echo $row1['email'];?></a></li>
                            <li><i class="fa fa-skype"></i><span class="sr-only">Skype ID:</span><a href="#"><?php echo $row1['skype'];?></a></li>
                        </ul>
                    </div><!--//content-->
                </div><!--//section-inner-->
            </aside><!--//aside-->



        </div><!--//secondary-->
    </div><!--//row-->
</div><!--//masonry-->

<!-- ******FOOTER****** -->
<footer class="footer">
    <div class="container text-center">
        <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can check out other license options via our website: themes.3rdwavemedia.com */-->
        <small class="copyright">Developed with <i class="fa fa-heart"></i> by <a href="http://www.byweb.online" target="_blank">Deven Katariya</a> for developers</small>
    </div><!--//container-->
</footer><!--//footer-->

<!-- Javascript -->
<script type="text/javascript" src="assets/plugins/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery-rss/dist/jquery.rss.min.js"></script>




<script>
    $(window).load(function() {
        $('.Dboot-preloader').addClass('hidden');
    });
</script>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->

<script>
    var siteurl = '<?php echo $config['site_url']; ?>';
    var session_uname = '<?php echo $sesUsername; ?>';
    var session_img = '<?php echo $ses_picname; ?>';
</script>

<!--ZeChat Box CSS-->
<link type="text/css" rel="stylesheet" media="all" href="app/includes/chatcss/chat.css" />
<!--ZeChat Box CSS-->

<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- Media Uploader -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<!-- Zechat js -->
<script type="text/javascript" src="app/plugins/smiley/js/emojione.min.js"></script>
<script type="text/javascript" src="app/includes/chatjs/lightbox.js"></script>
<script type="text/javascript" src="app/includes/chatjs/chat.js"></script>
<script type="text/javascript" src="app/includes/chatjs/custom.js"></script>


<script type="text/javascript" src="app/plugins/uploader/plupload.full.min.js"></script>
<script type="text/javascript" src="app/plugins/uploader/jquery.ui.plupload/jquery.ui.plupload.js"></script>

<?php require_once('contact-list.php');?>


<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->

</body>
</html>

