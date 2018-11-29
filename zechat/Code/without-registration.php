<?php
/*
Copyright (c) 2015-17 Devendra Katariya (bylancer.com)
*/
require_once('app/config.php');


/*
 * For without registration set $_SESSION['username'] and $_SESSION['id']
 * variable on your site registration and login page. or you can set your site
 * session variable in setting.php file please check.
 */

$_SESSION['username'] = "wchat";
$_SESSION['id'] = "1";

require_once('app/setting.php');

if(!isset($sesId)) {
    header("Location: login.php");
    exit;
}

$from_userdata = get_userdata($con,$config,$sesUsername);
$picname = $from_userdata[$MySQLi_photo_field];

$ses_picname = ($picname == "")? "avatar_default.png" : $picname;

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>Gmail - Facebook Style AJAX Chat Demo - Zechat</title>
    <!-- Meta -->
    <meta charset="utf-8">
</head>
<body>


<!-- Bootstrap CSS - Not Necessary if already exist in your site. -->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Bootstrap CSS - Not Necessary if already exist in your site. -->


<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ZeChat Required Files Included\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->

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
<script type="text/javascript" src="app/plugins/smiley/smiley.js"></script>
<script type="text/javascript" src="app/includes/chatjs/lightbox.js"></script>
<script type="text/javascript" src="app/includes/chatjs/chat.js"></script>
<script type="text/javascript" src="app/includes/chatjs/custom.js"></script>


<script type="text/javascript" src="app/plugins/uploader/plupload.full.min.js"></script>
<script type="text/javascript" src="app/plugins/uploader/jquery.ui.plupload/jquery.ui.plupload.js"></script>

<?php require_once('contact-list.php');?>


<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ZeChat Required Files Included\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
</body>
</html>

