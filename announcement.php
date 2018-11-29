<?php
session_start();
error_reporting(0);
require_once('includes/config.php');
$user_obj = new Cl_User();
//require_once('includes/function.php');
$item=toInternalId($_GET['list']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Announcements</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once('templates/common_css.php');?>	
<style>
</style>
</head>
<body class="animsition" onLoad="start()">
<?php require_once('templates/header.php');?>
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/announcements-banner.jpg);">
		<h2 style="color:#fff;">
			Announcement
		</h2>
	</section>	
<section class="bgwhite p-t-30 p-b-38" style="min-height:500px;">
<div class="container">
<div class="row">	
	<div class="col-sm-4 col-md-4 col-xs-12 m-l-r-auto">
					<div class="block1 text-left pos-relative m-b-30" style="border-bottom:1px solid #08a6cc; z-index:0; ">
						<h1 class="list-heading" style="margin-top:0">Admin Announcements</h1>
						<div class="demo5 demof" style="overflow:hidden;height:285px;">
								<ul style="border:2px solid #08a6cc;">
								<?php
								$query = "SELECT * FROM  announcement where is_active =1";
								$result = mysqli_query($con, $query) or die(mysqli_error($con));
								$i=0; while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
									$id= $row['id'];
									$id= toPublicId($id);
									$announcement=$row['announcement'];
									$announcement_date=$row['announcement_date'];
									$announcement_time=$row['announcement_time'];
									$slider_description=$row['slider_description'];
									//$id='announcement.php?'.toPublicId($row['id']);


									?>										
									<li class="demof ancm"><?php if (strlen($announcement) > 25) {
											$trimstring = substr($announcement, 0, 70)."<a href=announcement.php?list=".$id.">&nbsp;&nbsp; Read More...</a>";
											} else {
											$trimstring = $string;
											}
											echo $trimstring;?>
											<p  class="list-para"><?php echo $announcement_date;?> &nbsp&nbsp <?php echo $announcement_time;?></p></li><hr>
									<?php }?>
								</ul>
							</div>
							<div class="block1-wrapbtn w-size2">	
							</div>
						</div>
					</div>
<div class="col-sm-8">
<?php
$result = mysqli_query($con, "SELECT * FROM  announcement where id ='$item'") or die(mysqli_error($con));
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
$announcement=$row['announcement'];	
$title=$row['title'];
?>
<h3 class="text-center" style="text-transform:uppercase; "><?php echo $title; ?></h3><br/>
<p><?php echo $announcement; ?></p>
</div>
</div>
</div>
</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
<?php require_once('templates/chat_script.php');?>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/jquery.easy-ticker.js"></script> 
<script type="text/javascript">
   $(function(){	
   	$('.demo5').easyTicker({
   		direction: 'up',
   		visible: 3,
   		interval: 1000,
   		controls: {
   			up: '.btnUp',
   			down: '.btnDown',
   			toggle: '.btnToggle'}
   	});
   });
</script>
</body>
</html>