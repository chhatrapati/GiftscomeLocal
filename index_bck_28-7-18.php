<?php
session_start();
error_reporting(0);
require_once('includes/config.php');
$user_obj = new Cl_User();
require_once('includes/function.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
			header('location:index.php');
		}else{
			$message="Product ID is invalid";
		}
	}
}
?>
<script type="text/javascript">
	if (window.location.hash == '#_=_'){
		history.replaceState 
		? history.replaceState(null, null, window.location.href.split('#')[0])
		: window.location.hash = '';
	}
</script>
<!--<script>
	function start(){
		scrollDiv_init();
		scrollDiv_init1();
	}
</script>-->
<!DOCTYPE html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once('templates/common_css.php');?>
	<link href="css/full-slider.css" rel="stylesheet">
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.css'>
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
	<style>
	   .carousel-inner{
		   height:58%;
	   }
	   @media only screen and (max-width: 800px) {
    .carousel-inner {
   height:20%;
    }
	
}
 @media only screen and (max-width: 1100px) {
    .carousel-inner {
   height:28%;
    }
	
}

	</style>
	<!--Start of Zendesk Chat Script-->
<!--<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?5n3mHk9u51zdSTKylasbAjuABXN0b1yG";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>-->
<!--End of Zendesk Chat Script-->
</head>
<body class="animsition" onLoad="start()">
	<?php require_once('templates/header.php');?>
			<!-- Slide1 -->
			<section class="slider_img">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner" role="listbox" >
						<?php
						$query = "SELECT * FROM  slider where is_active =1";
						$result = mysqli_query($con, $query) or die(mysqli_error($con));
						$i=0; while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {

							$slider_id=$row['slider_id'];
							$slider_image=$row['slider_image'];
							$slider_title=$row['slider_title'];
							$slider_description=$row['slider_description'];
							?>	
							<!-- Slide One - Set the background image for this slide in the line below -->
							<div class="carousel-item <?php if($i==0){?> active <?php } ?>" style="background-image: url('admin/images/<?php echo $slider_image;?>')">
							</div>
							<?php $i++; }  ?>

						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="fa fa-caret-square-o-left arrow_slide" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="fa fa-caret-square-o-right arrow_slide" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</section>
				<!-- User level -->
				<?php 
				if(isset($_SESSION['name']) && $_SESSION['name']){
				$uid = $_SESSION['id'];?>
				<!-- ******************************************* Section For Player Level************************************************** -->	
				<section  CLass="level_section">		
				<div class="container">
				<div class="row">	
					<div class="col-md-3 col-xs-12 text-center">
						<div class="col-md-12 ">	
						<?php $user_detail = $user_obj-> user_detail_byid($uid);?>
						<?php $pic = $row['user_picture'];								  									
						if($user_detail['user_picture'] == ""){ ?>
						<img src="users-images/user.png" width="200" height="200" class="User_level">
						<?php }elseif (strpos($pic, 'https') !== false) {?>
						<img src="<?php echo $user_detail['user_picture'];?>" width="200" height="200" class="User_level">
						<?php } else {?>
						<img src="users-images/<?php echo $user_detail['user_picture'];?>" width="200" height="200" class="User_level">
						<?php }?>
						</div>
					<div class="col-md-12">
					<span>
					<p class="lvtext2"><?php echo $user_detail['name'];?></p>
					<p class="lvtext1"> Member Since: <?php	$create_date = $user_detail['regDate'];
					echo date('M-y',strtotime($create_date));?>
					</p>
					</span>
					</div>
					</div>
				<div class="col-md-9 col-xs-12 text-center">
				<div class="col-md-12 text-center"><span style="color:#000">Nice To See You Back! Lets Play The Next Game & Redeem Gifts</span></div>
					<div class="col-md-12 text-center">
					<?php $user_level = $user_obj-> get_level_point($uid); //print_r($user_level);?>
						<div class="row">
						<div class="col-md-2 col-md" style="margin-left: 4%;"><img src="images/badges1.png" style="width:53px;height:53px;margin-right:45%;display:none;" class="img1"></div>
						<div class="col-md-2 col-md" style="margin-left: 4%;"><img src="images/badges2.png" style="width:53px;height:53px;margin-right:45%;display:none;" class="img2"></div>
						<div class="col-md-2 col-md" style="margin-left: 4%;"><img src="images/badges3.png" style="width:53px;height:53px;margin-right:45%;display:none;" class="img3"></div>
						<div class="col-md-2 col-md" style="margin-left: 4%;"><img src="images/badges4.png" style="width:53px;height:53px;margin-right:45%;display:none;" class="img4"></div>
						<div class="col-md-2 col-md" style="margin-left: 0%;"><img src="images/badges5.png" style="width:53px;height:53px;margin-right:45%;display:none;" class="img5"></div>
						</div>								               
					</div>
				<div class="row">
				<div class="col-md-12 col-xs-12 col-sm-11 ulevel" > 
					<div class="arrow-steps clearfix">										
					<?php                                 
					$userlevelids=array();	
					$index=1;
					$sql = mysqli_query($con, "SELECT * FROM user_levels")or die(mysqli_error($con));
					while($result=mysqli_fetch_array($sql))
					{
					$user_levels_id =$result['user_levels_id'];
					$userlevelids[$index]=$user_levels_id;
					$user_levels_name =$result['user_levels_name'];
					$user_levels_complete =$result['user_levels_complete'];	
					$index++;							  
					?>
					<div class="step" id="Level<?php echo $user_levels_name;?>" data-points="<?php echo $user_levels_id;?>">Level <?php echo $user_levels_name;?></div>	
					<?php } ?>
					<?php
					$userpoints='';
					$sql = mysqli_query($con, "SELECT user_points FROM users WHERE id = '$uid'")or die(mysqli_error($con));
					$result=mysqli_fetch_assoc($sql);
					$userpoints =$result['user_points'];
					?>
					<?php
					$sql1 = mysqli_query($con,"SELECT level_image FROM tbl_users_level where level_points='$userpoints'")or die(mysqli_error($con));
					$result=mysqli_fetch_assoc($sql1);
					//$level_image =$result['level_image'];
					//echo "update users set user_medal='$level_image' WHERE user_points = '$userpoints'";
					$level_user =$user_level['next_level'];
					if($level_user >=0 && $level_user <=5)
					{
					$level_image ='images1.png';
					}
					if($level_user >5 && $level_user <=15)
					{
					$level_image ='images2.png';
					}
					if($level_user >15)
					{
					$level_image ='images3.png';
					}
					?>
					<img src="admin/images/<?php echo $level_image;?>" width="30" height="30"  id="image_lev" style="display:none;" >
					<input type="hidden" id="users_points" value="<?php  echo $userpoints;?>">
					</div>
				<div class="nav clearfix" style="display:none; ">
				<a href="#" class="prev">Previous</a>
				<a href="#" class="next pull-right">Next</a>
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-3 col-xs-12 col-sm-3 ulevel">
				<?php 
				$total_games = $user_obj->total_games_byuser($uid);
				$total_wons = $user_obj->total_coins_won_byuser($uid);
				?>
				<p>Total Games Played : <strong class="levl3"><?php if($total_games!=''){ echo $total_games; } else {echo '0';}?></strong>  
				<p>Total Coins Earned : <strong class="levl3"><?php if($total_wons!=''){ echo $total_wons; } else {echo '0';}?></strong>
				<!--<p><button type="submit" id="addMe" name="req_to_admin" class="btn-upper btn-sm btn-info">Request Coins</button></p>-->							
				</div>
				<div class="col-md-4 col-xs-12 col-sm-4 ulevel">
				<p class="text-left" style="font-size:14px;">Total Points :&nbsp; <strong style="color:red; "><?php echo $user_detail['user_points'];?> Points</strong></p>
				<?php if($user_level['user_level'] != 'Level 5'){?>
				<p class="text-left" style="font-size:14px;">Just Needs <strong style="color:red; "> <?php echo $user_level['next_level'];?> Points</strong> To Acheive Next Level</p>
				<?php }?>
				</div>
				<div class="col-md-5 col-xs-12 col-sm-5 text-right ulevel" >
				<div class="col-xs-12 col-md-12 col-sm-12">
				<p style="padding-right: 60px;">Refer to friend</p>
				<?php $string = $user_detail['name'];
				$string = str_replace(' ', '.', $string);?>
				<p>http://www.gc.co?ref=<?php echo $string;?></p>
				 </div>									
				<div class="col-xs-12 col-md-12 col-sm-12 ulevel">  
				<button class="btn btn-basic share-btnv">Share & Earn Points<div class="social-icon social "><i class="fa fa-facebook "></i></div></button> 
				</div>
				</div>
				</div>
				</div>	
				</div>	
				</section>
				<?php }?>	
<!-- *******************************************End Section For Player Level************************************************** -->		

	<!--***************************************** Section For Three Banner********************************************************* -->
	<section class="section_banner">
		<div class="container">
			<div class="row">

				<div class="col-sm-4 col-md-4 col-xs-12  block1 hov-img-zoom pos-relative m-b-30">
					<img src="images/banner1.png" alt="IMG-BENNER">
					<div class="text_img">
						<h5>LUCKY 28</h5>
						<p>Real Game Real Players</p>
						<p><a href="game_zone.php" style="color:white;text-decoration:underline">Play Now</a></p>
					</div>
				</div>
				<div class=" col-sm-4 col-md-4 col-xs-12 block1 hov-img-zoom pos-relative m-b-30">
					<img src="images/banner4.png" alt="IMG-BENNER">
					<div class="text_img">
						<h5>GIFT STORE</h5>
						<p>Beyond Smart</p>
						<p><a href="product.php" style="color:white;text-decoration:underline">Discover Now</a></p>
					</div>
					<div class="block1-wrapbtn w-size2">	
					</div>
				</div>
				<div class="col-sm-4 col-md-4 col-xs-12 block1 hov-img-zoom pos-relative m-b-30">
					<img src="images/banner3.png" alt="IMG-BENNER">
					<div class="text_img">
						<h5>FRIENDS SHARING</h5>
						<p>Share Is Care</p>
						<p><a href="chatting.php" style="color:white;text-decoration:underline">Discover Now</a></p>
					</div>
					<div class="block1-wrapbtn w-size2">	
					</div>
				</div>
			</div>	
		</div>
	</section>	
	<!-- ******************************************* End Section For Three Banner************************************************** -->

	<!-- ******************************************* Section For List Scrollingr************************************************** -->
	<section class="banner p-t-40 p-b-40">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-md-4 col-xs-12 m-l-r-auto">
					<div class="block1 text-left pos-relative m-b-30" style="border-bottom:1px solid #08a6cc;">
						<h1 class="list-heading" style="margin-top:0">Admin Announcements</h1>
						<div class="demo5 demof" style="overflow:hidden;height:285px;">
							<ul style="border:2px solid #08a6cc;">
								<?php
								$query = "SELECT * FROM  announcement where is_active =1";
								$result = mysqli_query($con, $query) or die(mysqli_error($con));
								$i=0; while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
									$announcement=$row['announcement'];
									$announcement_date=$row['announcement_date'];
									$announcement_time=$row['announcement_time'];
									$slider_description=$row['slider_description'];
									$id='announcement.php?'.$row['id'];


									?>										
									<li class="demof ancm"><?php if (strlen($announcement) > 25) {
											$trimstring = substr($announcement, 0, 50)."<a href= '".$id."'>&nbsp;&nbsp; ReadMore</a>";
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
					<div class="col-sm-4 col-md-4 col-xs-12 m-l-r-auto ">			
						<div class="block1  pos-relative m-b-30" >
							<h1 class="list-heading" style="margin-top:0">Winner Lists</h1>
							<div class="demo5 demof" style="overflow:hidden;height:285px!important; border:1px solid #08a6cc;">
							<?php $winners = $user_obj->get_winners();?>
							<ul><?php
							while ($winner = mysqli_fetch_array($winners)){
								$user_id = $winner['user_id'];
								$total_bid_amount = $winner['total_bid_amount'];
								$total_won_coins = $winner['total_won'];
								$win_date = $winner['create_date'];
								/*Get user detail by id*/
								$user_detail = $user_obj->user_detail_byid($user_id);
								$create_date= $win_date; ?>
										<li>
										   <?php $pic = $row['user_picture'];								  									
											if($user_detail['user_picture'] == ""){ ?>
											<img src="users-images/user.png" style="width:50px; height:50px;">
											<?php }elseif (strpos($pic, 'https') !== false) {?>
											<img src="<?php echo $user_detail['user_picture'];?>"  style="width:50px; height:50px;">
											<?php } else {?>
											<img src="users-images/<?php echo $user_detail['user_picture'];?>" style="width:50px; height:50px;">
											<?php }?>
											<a href="user-profile.php?user=<?php echo toPublicId($user_id);?>" target="_SELF"><?php echo $user_detail['name'];?></a>
											<p><span  style="color:#666;">Coins won:</span>
											<span style="color:#e82a1b"> <?php echo $total_won_coins;?></span>&nbsp;&nbsp;&nbsp; <?php echo date('d-M-y',strtotime($create_date));?></p>
										</li>								 
									<?php }?>	
									</ul>																			
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-md-4 col-xs-12 m-l-r-auto">					
								<!-- block2 -->
								<div class="block2 wrap-pic-w pos-relative m-b-30">
									<img src="images/banner5.png" style="height:333px">
								</div>
							</div>
						</div>
					</div>			
				</section>
	<!-- ******************************************* End Section For List Scrollingr************************************************** -->	
	<!-- ******************************************* Section For Products*********************************************************** -->
<section class="blog bgwhite p-t-30 p-b-30" style="border-bottom:1px solid #eee; ">
   <div class="container">
	  <div class="sec-title p-b-52">
		 <h3 class="m-text5 t-center">Redeem from our gift store</h3>
	  </div>
	  <div class="row">
		 <?php
			$query = "SELECT * FROM  products limit 6";
			$result = mysqli_query($con, $query) or die(mysqli_error($con));
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {

				$product_id=$row['id'];
				$productName=$row['productName'];
				$productImage1=$row['productImage1'];
				$postingDate=$row['postingDate'];
				$productCompany=$row['productCompany'];
				$productPrice=$row['productPrice'];

				?>
		 <div class="col-sm-10 col-xs-6 col-md-2 Product text-center">
			<!-- Block3 -->
			<div class="block3">
			   <a href="product_detail.php?product_id=<?php echo toPublicId($row['id']);?>" class="block3-img dis-block ">
			   <img src="admin/productimages/<?php echo $productName;?>/<?php echo $productImage1;?>" class="img-fluid" alt="IMG-BLOG">
			   </a>
			   <div class="block3-txt p-t-14">
				  <h4 class="p-b-7">
					 <a href="product_detail.php?product_id=<?php echo toPublicId($row['id']);?>" class="m-text11">
					 <?php echo $productName;?>
					 </a>
				  </h4>
				  <span class="s-text6" class="s-text7 " style="font-size:14px;"><img alt="Game Coins" src="images/icons/bid.png" width="20" height="20" style="padding-right: 5px;" /><?php echo $productPrice;?></span>
			   </div>
			</div>
		 </div>
		 <?php } ?>
	  </div>
   </div>
</section>
<!-- ******************************************* End Section For Products************************************************ -->

	<!-- ******************************************* Section For Players************************************************** -->
<section class="newproduct bgwhite p-t-45 p-b-105">
<div class="container">
<div class="sec-title p-b-60">
<h1 class="m-text5 t-center" style="text-align:center">Top Players</h1>
</div>
<div class="row">
<!-- *******************************************Players Of Month************************************************** -->
<div class="col-sm-3 text-center plm" style="border:2px solid #08a6cc">
 <div class="item-slick2 p-l-15 p-r-15">
	<h5 style="padding-top:20px;padding-bottom:5px;text-align:center;font-family:poppins-bold">Player of the month</h5>
	<hr>
	<!-- Block2 -->
	<div class="block2">
	<?php
	$sql_09 = $user_obj->player_of_month($id_user);
	$result_09=mysqli_fetch_array($sql_09);
	$id_user= $result_09['user_id'];
	$total_bid_amount= $result_09['total_bid_amount'];
	$total_won= $result_09['total_won'];
	$details_user = $user_obj->user_detail_byid($id_user);
	$user_type = $details_user['user_type'];
	//print_r($result_09);?>
	   <div class="block2-img wrap-pic-w of-hidden pos-relative <?php if($user_type=='vip'){?>block2-labelnew <?php }?>">
	   <?php if($details_user['social_id']!=''){ if (strpos($pic, 'https') !== false) {?>
     <img src="<?php echo $details_user['user_picture'];?>"  alt="Player of month" style="width:250px;text-align:center">
	 <?php }}	if($details_user['user_picture'] == ""){ ?>	
	 <img src="users-images/user.png" alt="Player of month" style="width:250px;text-align:center">
     <?php }else {?>
	 <img src="users-images/<?php echo $details_user['user_picture'];?>"  alt="Player of month" style="width:250px;text-align:center">
	 <?php }?>
		  <div class="block2-overlay trans-0-4">
			<!-- <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
			 <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
			 <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
			 </a>-->
			 
		  </div>
	   </div>
	   <div class="block2-txt p-t-20">
		  <a href="user-profile.php?user=<?php echo toPublicId($id_user);?>" target="_blank" class="block2-name dis-block s-text3 p-b-5">
			 <h5><?php echo $details_user['name'];?></h5>
		  </a>
		  <span class="block2-price  p-r-5">
			 <div style="color:#666;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/icons/bid.png" width="20" height="20"> <?php echo $total_bid_amount;?></span></div>
			 <div style="color:#666;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/icons/won.png" width="20" height="20"><?php echo $total_won;?></span></div>
		  </span>
	   </div>
	</div>
 </div>
</div>
<div class="col-sm-9">
 <section id="tabs">
	<div class="container-fluid">
	   <div class="row">
		  <div class="col-xs-12 ">
			 <nav>
				<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
				   <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Top Players</a>
				   <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">New Player</a>
				   <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Top Rated</a>
				   <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Most Popular</a>
				</div>
			 </nav>
			 <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
				<!--********* ***********************Top Players******************************************************* -->
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				   <div class="row">
					  <?php $winners = $user_obj->get_winners();
						 $i = 0;	
						 while ($winner = mysqli_fetch_array($winners)){
							 $user_id = $winner['user_id'];
							 $total_bids = $winner['total_bid_amount'];
							 $total_won = $winner['total_won'];
							 $win_date = $winner['create_date'];
							 /*Get user detail by id*/
							 $user_detail = $user_obj->user_detail_byid($user_id);
							$i ++; 
							if ($total_bids=='')
							{
								$total_bids ='0000';
							}
							$total_won = $user_obj->total_coins_won($user_id);
							if ($total_won=='')
							{
								$total_won ='0000';
							}
						  if($i==6) 
						  {
							echo '<div class="col-sm-2" style="display:none"></div>';
							$i = 0;
						  }
							?>
					  <div class=" col-sm-2 col-xs-6  win_img text-center">
						 <?php if($user_detail['social_id']!=''){
							if (strpos($pic, 'https') !== false)
							{?>
						 <img src="<?php echo $user_detail['user_picture'];?>"  width="100px" height="100px">
						 <?php }
							}																						if($user_detail['user_picture'] == ""){ ?>
						 <img src="users-images/user.png" width="100px" height="100px">
						 <?php }else {?>
						 <img src="users-images/<?php echo $user_detail['user_picture'];?>" width="100px" height="100px">
						 <?php }?>
						 <h6 class="topname text-center" style="margin:0; ">						 <a class="name-player" href="user-profile.php?user=<?php echo toPublicId($user_id);?>" target="_blank"><?php echo $user_detail['name'];?></a></h6>
						 <div class="coin_display text-center">
							<div class="total_b">Total Bids: <span style="color:#0daacf"> 
							   <?php echo $total_bids;?></span>
							</div>
							<div class="total_b">Total Wons: <span style="color:#e82a1b"> 
							   <?php echo $total_won;?></span>
							</div>
						 </div>
					  </div>
					  <?php }?>
				   </div>
				</div>
				<!--*********************************New Playe******************************************************* -->
				<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				   <div class="row">
					  <?php $data = $user_obj->get_new_user();	
						 while($row=mysqli_fetch_array($data)){	
							$user_id =$row['id'];
							$total_bids = $user_obj->total_bids_byuser_byallgames($user_id);
							if ($total_bids=='')
							{
								$total_bids ='0000';
							}
							$total_won = $user_obj-> total_coins_won($user_id);
							if ($total_won=='')
							{
								$total_won ='0000';
							}
							?>	
					  <div class=" col-sm-2 col-xs-6  win_img text-center">
						 <?php if($row['social_id']!=''){
							if (strpos($pic, 'https') !== false)
								{?>
						 <img src="<?php echo $row['user_picture'];?>"  width="100px" height="100px">
						 <?php }
							}																
							if($row['user_picture'] == ""){ ?>
						 <img src="users-images/user.png" width="100px" height="100px">
						 <?php }else {?>
						 <img src="users-images/<?php echo $row['user_picture'];?>" width="100px" height="100px">
						 <?php }?>
						 <h6 class="topname text-center" style="margin:0; "><a class="name-player" href="user-profile.php?user=<?php echo toPublicId($user_id);?>" target="_blank"  >	
							<?php echo $row['name'];?>
							</a>
						 </h6>
						 <div class="coin_display text-center">
							<div class="total_b">Total Bids: <span style="color:#0daacf"> 
							   <?php echo $total_bids;?></span>
							</div>
							<div class="total_b">Total Wons: <span style="color:#e82a1b"> 
							   <?php echo $total_won;?></span>
							</div>
						 </div>
					  </div>
					  <?php }?>
				   </div>
				</div>
				<!--********************************Top Rated******************************************************* -->
				<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
				   <div class="row">
					  <?php $data = $user_obj->get_Popular_user();	
						 while($mpu=mysqli_fetch_array($data)){	
							$user_id =$mpu['id'];
							$total_bids = $user_obj->total_bids_byuser_byallgames($user_id);
							if ($total_bids=='')
							{
								$total_bids ='0000';
							}
							$total_won = $user_obj-> total_coins_won($user_id);
							if ($total_won=='')
							{
								$total_won ='0000';
							}
							?>	
					  <div class=" col-sm-2 col-xs-6  win_img text-center">
						 <?php if($mpu['social_id']!=''){
							if (strpos($pic, 'https') !== false)
								{?>
						 <img src="<?php echo $mpu['user_picture'];?>"  width="100px" height="100px">
						 <?php }
							}																
							if($mpu['user_picture'] == ""){ ?>
						 <img src="users-images/user.png" width="100px" height="100px">
						 <?php }else {?>
						 <img src="users-images/<?php echo $mpu['user_picture'];?>" width="100px" height="100px">
						 <?php }?>
						 <h6 class="topname text-center" style="margin:0; "><a class="name-player" href="user-profile.php?user=<?php echo toPublicId($user_id);?>" target="_blank"  >	
							<?php echo $mpu['name'];?>
							</a>
						 </h6>
						 <div class="coin_display text-center">
							<div class="total_b">Total Bids: <span style="color:#0daacf"> 
							   <?php echo $total_bids;?></span>
							</div>
							<div class="total_b">Total Wons: <span style="color:#e82a1b"> 
							   <?php echo $total_won;?></span>
							</div>
						 </div>
					  </div>
					  <?php }?>
				   </div>
				</div>
				<!--*********************************Most Popular Player******************************************************* -->
				<div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
				   <div class="row">
					  <?php $data = $user_obj->get_Popular_user();	
						 while($mpu=mysqli_fetch_array($data)){	
							$user_id =$mpu['id'];
							$total_bids = $user_obj->total_bids_byuser_byallgames($user_id);
							if ($total_bids=='')
							{
								$total_bids ='0000';
							}
							$total_won = $user_obj-> total_coins_won($user_id);
							if ($total_won=='')
							{
								$total_won ='0000';
							}
							?>	
					  <div class=" col-sm-2 col-xs-6 win_img text-center">
						 <?php if($mpu['social_id']!=''){
							if (strpos($pic, 'https') !== false)
								{?>
						 <img src="<?php echo $mpu['user_picture'];?>"  width="100px" height="100px">
						 <?php }
							}																
							if($mpu['user_picture'] == ""){ ?>
						 <img src="users-images/user.png" width="100px" height="100px">
						 <?php }else {?>
						 <img src="users-images/<?php echo $mpu['user_picture'];?>" width="100px" height="100px">
						 <?php }?>
						 <h6 class="topname text-center" style="margin:0; "><a class="name-player" href="user-profile.php?user=<?php echo toPublicId($user_id);?>" target="_blank"  >	
							<?php echo $mpu['name'];?>
							</a>
						 </h6>
						 <div class="coin_display text-center">
							<div class="total_b">Total Bids: <span style="color:#0daacf"> 
							   <?php echo $total_bids;?></span>
							</div>
							<div class="total_b">Total Wons: <span style="color:#e82a1b"> 
							   <?php echo $total_won;?></span>
							</div>
						 </div>
					  </div>
					  <?php }?>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
 </section>
</div>
</div>
</div>
</section>
<?php require_once('templates/footer.php');?>
	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>
	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>
	<?php require_once('templates/common_js.php');?>
	<?php require_once('templates/chat_script.php');?>
	<script src="js/jquery.sharebox.js"></script>
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>	
	<!--<script type="text/javascript" src="vendor/countdowntime/countdowntime.js"></script>	
	<script type="text/javascript" src="vendor/lightbox2/js/lightbox.min.js"></script>-->
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
   $('.block2-btn-addcart').each(function(){
		var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
		$(this).on('click', function(){
			swal(nameProduct, "is added to cart !", "success");
		});
	});
</script>
<!-- For Daynamic Level -->
<?php $user_level = $user_obj-> get_level_point($uid); 
 $lev =$user_level['user_level'];//print_r($user_level);?>
 
<script type="text/javascript">
	var str = "";
	var str1 ='<?php echo $lev ;?>';
	$('.step').each(function(){
	str = $(this).text();    
	if (str === str1){
	$('.step').removeClass('current');
	$(".step:contains('" + str + "')").addClass("current");
	$('div[id|="uncurrent"]').remove(); }  
})
</script> 
<script>
var users_points = document.getElementById("users_points").value;
var madal_img=$("#image_lev").attr("src");
$( "<div><img src='"+madal_img+"'width='30' height='30'></div>" ).appendTo( ".current" );
</script>   
<script>
var users_points = document.getElementById("users_points").value;
//alert(users_points);
if (users_points >=0 && users_points<=20){
        $(".img1").css("display","block");
    }
	 if (users_points >=21 && users_points<=50) {
       $(".img2").css("display","block");
    }
    if (users_points >=51 && users_points<=100) {
        $(".img3").css("display","block");
    }
   if (users_points >=101 && users_points<=200) {
        $(".img4").css("display","block");
    }
	   if (users_points >=200) {
        $(".img5").css("display","block");
    }
      
</script>
<style>
   .toplist{
   width:130px;
   height:130px;
   }
   .toplist:hover{
   border:1px solid #0daacf;
   opacity:0.5;
   }
   .topname{
   text-align:center;
   font-family:poppins-semibold;
   padding-top:14px;
   padding-bottam:24px;
   }
   .topname:hover{
   font-size:30%;
   }
   .arrow-steps .step.current {
    position: relative;
}
.arrow-steps .step.current img{
    position: absolute;
    right: 3px;
    top: 3px;
    text-align: center;
    color: white;
    font-size: 20px;
}
.badge-warning {color: #111!important; background-color: #ffc107!important;}
.badge-info { color: #fff!important; background-color: #17a2b8!important;}
</style>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/jquery.easy-ticker.js"></script> 
<script>
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
<!-- // For Facebook share -->
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId            : '208527059935526',
			autoLogAppEvents : true,
			xfbml            : true,
			version          : 'v2.12'
		});
	};
	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "https://connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.12&appId=208527059935526&autoLogAppEvents=1';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
 $(document).ready(function(){
 $('button.share-btnv').on( 'click', fb_share );
	});
	function fb_share() { 
			FB.ui( {
			method: 'feed',
			name: "GiftsCome",
			link: "http://giftscome.com/index.php",
			picture: "http://giftscome.com/images/logo.png",
			caption: "The world's most popular Game",
			actions: {"name":"Search", "link":"http://giftscome.com/index.php"}
		},  function(response) {

			if (response && !response.error_message) {
				 window.location.href = "share1.php";
				} else {
				window.location.href = "/";
			}
		} );
	}
</script>
<script  src="js/index.js"></script>
</body>
</html>