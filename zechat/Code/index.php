<?php
/*
Copyright (c) 2015-17 Devendra Katariya (bylancer.com)
*/
require_once('app/config.php');
require_once('app/setting.php');

if(!isset($sesId)) {
    header("Location: login.php");
    exit;
}

$query1 = "SELECT * FROM `".$config['db']['pre']."userdata` where id = '".$sesId."'";
$result1 = $con->query($query1);
$row1 = mysqli_fetch_assoc($result1);
$string = $row1['username'];
$picname = $row1['picname'];

$ses_picname = ($picname == "")? "avatar_default.png" : $picname;

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<body>





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
<script type="text/javascript" src="app/plugins/smiley/smiley.js"></script>
<script type="text/javascript" src="app/includes/chatjs/lightbox.js"></script>
<script type="text/javascript" src="app/includes/chatjs/chat.js"></script>
<script type="text/javascript" src="app/includes/chatjs/custom.js"></script>


<script type="text/javascript" src="app/plugins/uploader/plupload.full.min.js"></script>
<script type="text/javascript" src="app/plugins/uploader/jquery.ui.plupload/jquery.ui.plupload.js"></script>

<?php require_once('contact-list.php');?>


<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->

<script>
    $(window).load(function() {
        $('.Dboot-preloader').addClass('hidden');
    });
</script>
</body>
</html>

