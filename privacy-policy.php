<?php session_start(); error_reporting(0); ?>
<!DOCTYPE html>
<head>
<title>Privacy Policy</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php require_once('templates/common_css.php');?>
<link rel="stylesheet" type="text/css" href="css/package.css">
</head>
<style>
.page-content span {color: #888888 !important;font-family: Poppins-medium !important;font-size: 15px;line-height: 25px;}
</style>
<body class="animsition">
<?php require_once('templates/header.php'); ?>
<?php
$result = mysqli_query($con, "SELECT * FROM  tbl_privacy_policy where is_active='1'") or die(mysqli_error($con));
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
$title=$row['title'];
$description=$row['description'];
?>
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
<h2 class="l-text2 t-center"><?php echo $title;?></h2>
</section>
<section class="bgwhite p-t-30 p-b-38" style="min-height:500px;">
<div class="container">
<!-- Portfolio -->
<div class="row page-content">
<?php echo $description;?>
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