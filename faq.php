<?php
session_start();
error_reporting(0);
include('includes/config.php');
$user_obj = new Cl_User();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>FAQ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="faq/css/bootstrap.min.css" />
    <script type="text/javascript" src="faq/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="faq/js/bootstrap.min.js"></script>
	<?php require_once('templates/common_css.php');?>
	<link rel="stylesheet" type="text/css" href="css/faq.css" />
</head>
<body>
<?php require_once('templates/header.php');?>
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);"><h2 class="l-text2 t-center">Frequently Asked Questions</h2></section>
<div class="container">
<!-- Bootstrap FAQ - START -->
<div class="container">
    <div class="panel-group" id="accordion">
	<?php 
$result = mysqli_query($con, "SELECT tbl_faq.*, tbl_faq_categories.cat_name as cat_name,tbl_faq_categories.id as cat_id FROM tbl_faq join tbl_faq_categories on tbl_faq_categories.id=tbl_faq.cat_name group by tbl_faq.cat_name") or die(mysqli_error($con));
	?> 
	<?php $i=0; while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
	$cat_name=$row['cat_name'];
	$cat_id=$row['cat_id'];?>
    <div class="faqHeader" id="<?php echo $cat_name;?>"><?php echo $cat_name;?></div>
	<?php $result12 = mysqli_query($con, "SELECT id,question,answer FROM tbl_faq where cat_name='$cat_id' AND is_active='1'") or die(mysqli_error($con));
   while ($row12 = mysqli_fetch_array($result12, MYSQLI_BOTH)) {
	$question=$row12['question'];
	$answer=$row12['answer'];?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i;?>"><?php echo $question;?></a>
                </h4>
            </div>
            <div id="collapse<?php echo $i;?>" class="panel-collapse collapse">
                <div class="panel-body">
                   <p><?php echo $answer;?> </p>
                </div>
            </div>
        </div>
   <?php $i++; }}?>       
    </div>
</div>
<!-- Bootstrap FAQ - END -->
</div>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
<?php require_once('templates/chat_script.php');?>
</body>
</html>