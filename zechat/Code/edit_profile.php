<?php
require_once('app/config.php');
require_once('app/setting.php');
if(!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$query1 = "SELECT * FROM `".$config['db']['pre']."userdata` where id = '".$_SESSION['id']."'";
$result1 = $con->query($query1);
$row1 = mysqli_fetch_assoc($result1);
$string = $row1['username'];
$ses_picname = $row1['picname'];

if($ses_picname == "")
    $ses_picname = "avatar_default.png";


$error = "";

if(isset($_POST['Submit']))
{
    if($_FILES['file']['name'] != "")
    {
        $uploaddir = 'storage/user_image/';
        $original_filename = $_FILES['file']['name'];

        $extensions = explode(".", $original_filename);
        $extension = $extensions[count($extensions) - 1];
        $uniqueName =  $string . "." . $extension;
        $filename = $uploaddir . $uniqueName;

        $file_type = "file";

        if ($extension == "jpg" || $extension == "jpeg" || $extension == "gif" || $extension == "png") {
            $file_type = "image";

            $size = filesize($_FILES['file']['tmp_name']);

            $image = $_FILES["file"]["name"];
            $uploadedfile = $_FILES['file']['tmp_name'];

            if ($image) {
                if ($extension == "jpg" || $extension == "jpeg") {
                    $uploadedfile = $_FILES['file']['tmp_name'];
                    $src = imagecreatefromjpeg($uploadedfile);
                } else if ($extension == "png") {
                    $uploadedfile = $_FILES['file']['tmp_name'];
                    $src = imagecreatefrompng($uploadedfile);
                } else {
                    $src = imagecreatefromgif($uploadedfile);
                }

                list($width, $height) = getimagesize($uploadedfile);

                $newwidth = 225;
                $newheight = ($height / $width) * $newwidth;
                $tmp = imagecreatetruecolor($newwidth, $newheight);

                imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                imagejpeg($tmp, $filename, 100);

                imagedestroy($src);
                imagedestroy($tmp);

                $query = "Update `".$config['db']['pre']."userdata` set name='" . $_POST['name'] . "', email='" . $_POST['email'] . "', about='" . $_POST['about'] . "', sex='" . $_POST['sex'] . "', dob='" . $_POST['dob'] . "', skype='" . $_POST['skype'] . "', facebook='" . $_POST['facebook'] . "', twitter='" . $_POST['twitter'] . "', googleplus='" . $_POST['googleplus'] . "', instagram='" . $_POST['instagram'] . "', picname='$uniqueName' WHERE id = {$_SESSION['id']} ";
                $query_result = $con->query($query);

                header("Location: index.php");
                exit;
            }
        }

    }
    else{
        //$time = date('Y-m-d H:i:s', time());
        $query = "Update `".$config['db']['pre']."userdata` set name='" . $_POST['name'] . "', email='" . $_POST['email'] . "', about='". addslashes($_POST['about'])."', sex='" . $_POST['sex'] . "', dob='" . $_POST['dob'] . "', skype='" . $_POST['skype'] . "', facebook='" . $_POST['facebook'] . "', twitter='" . $_POST['twitter'] . "',googleplus='" . $_POST['googleplus'] . "', instagram='" . $_POST['instagram'] . "' WHERE id = {$_SESSION['id']}";
        $query_result = $con->query($query);

        header("Location: index.php");
        exit;
    }

}


?>
<?php if(!empty($error)) {
    echo '<script type="text/javascript">alert("' . $error . '");</script>';
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Gmail - Facebook Style AJAX Chat Demo - Zechat</title>
    <meta name="keywords" content="php chat script, php ajax Chat,facebook similar chat, php mysql chat, chat script, facebook style chat script, gmail style chat script. fbchat, gmail chat, facebook style message inbox, facebook similar inbox, facebook like chat" />
    <meta name="description"  content="This jQuery chat module easily to integrate Gmail/Facebook style chat into your existing website." />
    <meta name="author" content="Zechat - Codentheme.com">
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
    <style>
        /*Loader start*/
        .hidden{  display: none!important;  visibility: hidden!important;  }
        .text-center {  text-align: center;  }
        .Dboot-preloader {  background-color: #fff;  display: block;  width: 100%;  height: 100%;  position: fixed;  z-index: 999999999999999;}
        /*Loader end*/

        .middle-container {
            clear: both;
            padding: 50px 0px;
        }.middle-dabba {
             margin: 0px auto;
             border-radius: 5px;
             background: none repeat scroll 0% 0% #FFF;
             border-top: 5px solid #337ab7;
             padding: 45px 50px;
             box-shadow: 0px 2px 2px -1px rgba(0, 0, 0, 0.11);
         }.middle-dabba h1 {
              font: 45px/45px 'clan-thinthin',Helvetica,sans-serif;
              margin-bottom: 25px;
              font-weight: bold;
              letter-spacing: -2px;
              color: #337ab7;
              text-align: left;
              margin-top: 0px;
          }#post-form {
               margin: 0 auto;
               margin-top: 0px;
               margin-bottom: 0px;
               padding: 30px;
           }
        #post-form{
            /*width: 50%;*/
        }
        form {
                 margin: 10px 0 0 0;
             }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #666;
        }
        input, select {
            width: 95%;
        }
        #post-form input, #post-form textarea {
            background: none repeat scroll 0 0 #FFFFFF;
            color: #545658;
            border: 2px solid #C9C9C9 !important;
            padding: 8px;
            font-size: 14px;
            border-radius: 2px 2px 2px 2px;
        }
        input, textarea {
            font: 14px/24px Helvetica, Arial, sans-serif;
            color: #666;
        }
        #send p {
                  margin-bottom: 20px;width: 50%;
              }
        .middle-dabba p {
            margin: 0px 0px 24px;
            color: #7D7D7D;
            letter-spacing: 0.03em;
            text-rendering: optimizelegibility;
            font: 18px/30px 'bentonsanslight',Helvetica,sans-serif;
        }
        .input{padding: 12px;}
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
            <img width="169px" style="min-height:170px;" src="storage/user_image/<?php echo $ses_picname; ?>" alt="<?php echo $_SESSION['username'];?>">
        </div>

        <div class="profile-content pull-left">
            <h1 class="name"><?php echo $row1['name'];?></h1>
            <h2 class="desc">#<?php echo $_SESSION['username'];?></h2>
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
        <a class="btn btn-cta-primary pull-right" href="edit_profile.php"><i class="fa fa-paper-plane"></i> Edit Profile</a>
    </div><!--//container-->
</header><!--//header-->

<div class="middle-container container">
    <div class="middle-dabba col-md-12">
        <h1>Edit Your Profile</h1>
        <div id="post-form" style="padding:10px">

            <form name="form1" method="post" action="" id="send" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="input text">
                        <label for="name">Fullname </label><input type="text" name="name" value="<?php echo $row1['name'];?>">
                    </div>

                    <div class="input text">
                        <label for="dob">Date of Birth </label><input type="text" name="dob" placeholder="Format : 02-April-1992" value="<?php echo $row1['dob'];?>">
                    </div>

                    <div class="input text">
                        <label for="file">Change Profile Picture </label>
                        <img class="pull-left" src="storage/user_image/<?php echo $ses_picname; ?>" alt="<?php echo $_SESSION['username'];?>"  style="width: 42px; border-radius: 50%"/>
                        <input type="file" name="file" style="width:86%">
                    </div>

                    <div class="input text">
                        <label for="about">About Me </label>
                        <textarea name="about" style="width: 95%;height: 137px"><?php echo $row1['about'];?></textarea>
                    </div>

                    <div class="input text">
                        <label for="sex">Sex</label>
                        <input type="radio" name="sex" value="male" style="width: 10%" <?php if($row1['sex'] == "male") { echo "checked"; }?>> Male <br>
                        <input type="radio" name="sex" value="female" style="width: 10%" <?php if($row1['sex'] == "female") { echo "checked"; }?>> Female

                    </div>
                </div>


                <div class="col-md-6">
                    <div class="input text">
                        <label for="email">Email</label><input type="text" name="email" value="<?php echo $row1['email'];?>">
                    </div>

                    <div class="input text">
                        <label for="skype">Skype ID</label><input type="text" name="skype" value="<?php echo $row1['skype'];?>">
                    </div>

                    <div class="input text">
                        <label for="facebook">Facebook</label><input type="text" name="facebook" value="<?php echo $row1['facebook'];?>">
                    </div>

                    <div class="input text">
                        <label for="googleplus">Google Plus</label><input type="text" name="googleplus" value="<?php echo $row1['googleplus'];?>">
                    </div>

                    <div class="input text">
                        <label for="twitter">Twitter</label><input type="text" name="twitter" value="<?php echo $row1['twitter'];?>">
                    </div>

                    <div class="input text">
                        <label for="instagram">Instagram</label><input type="text" name="instagram" value="<?php echo $row1['instagram'];?>">
                    </div>
                </div>
            </div>
            <div class="col-md-12" align="center">
                <button class="btn btn-cta-theme" type="submit" name="Submit">Save</button>
            </div>

            </form>
        </div>
    </div>
</div>


<!-- ******FOOTER****** -->
<footer class="footer">
    <div class="container text-center">
        <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can check out other license options via our website: themes.3rdwavemedia.com */-->
        <small class="copyright">Developed with <i class="fa fa-heart"></i> by <a href="http://www.byweb.online" target="_blank">Deven Katariya</a> for developers</small>
    </div><!--//container-->
</footer><!--//footer-->



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