<?php session_start(); error_reporting(0); ?>
<!DOCTYPE html>
<head>
<title>Thank You</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php require_once('templates/common_css.php');?>
<link rel="stylesheet" type="text/css" href="css/package.css">
</head>
<body class="animsition">
<?php require_once('templates/header.php'); ?>
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
<h2 class="l-text2 t-center">
Thank You
</h2>
</section>
<section class="bgwhite p-t-66 p-b-38" style="min-height:500px;">
<div class="container">
<!-- Portfolio -->
<div class="row">
<p>Congratulations! You have successfully subscribed to vip membership. </p> 
</div>
</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
<?php require_once('templates/chat_script.php');?>
<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
<span class="symbol-btn-back-to-top">
<i class="fa fa-angle-double-up" aria-hidden="true"></i>
</span>
</div>
<!-- Container Selection -->
<div id="dropDownSelect1"></div>
<div id="dropDownSelect2"></div>
</body>
</html>