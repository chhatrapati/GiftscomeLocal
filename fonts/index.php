<?php
session_start();
error_reporting(0);

//print_r($_SESSION);
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
<script>
	function start(){
		scrollDiv_init();
		scrollDiv_init1();
	}
</script>
<!DOCTYPE html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once('templates/common_css.php');?>
	<link href="css/full-slider.css" rel="stylesheet">
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.css'>
	
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
			<div class="carousel-inner" role="listbox" style="height:58%">
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
<!-- ******************************************* Section For Player Level************************************************** -->	
<?php 
if(isset($_SESSION['name']) && $_SESSION['name']){
$uid = $_SESSION['id'];?>
<section  CLass="level_section">
   <div class="container">
   <div class="row">
      <div class="col-md-3 col-xs-12 text-center">
         <div class="col-md-12 ">	
            <?php $user_detail = $user_obj-> user_detail_byid($uid);
               $gs = $user_obj->get_game_statics();?>
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
            <?php $user_level = $user_obj-> get_level_point($uid);?>
            <div class="row">
               <div class="col-md-2 col-md-offset-1 "><img src="images/badges5.png" style="width:53px;height:53px;margin-right:45%" class="img1"></div>
               <div class="col-md-2" id="uncurrent"><img src="images/badges4.png" style="width:53px; height:53px;margin-right:20%" class="img2"></div>
               <div class="col-md-2 text-center" id="uncurrent"><img src="images/badges3.png" style="width:64px; height:53px;margin-left:10%" class="img3"></div>
               <div class="col-md-2 text-center" id="uncurrent"><img src="images/badges2.png" style="width:53px; height:53px;margin-left:60%" class="img4"></div>
               <div class="col-md-2 text-center" id="uncurrent"><img src="images/badges.png" style="width:53px; height:53px;margin-left:70%" class="img5"></div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-11 ulevel" >
               <div class="arrow-steps clearfix">
                  <div class="step" id="lev1">Level 1</div>
                  <div class="step" id="lev2">Level 2</div>
                  <div class="step" id="lev3">Level 3</div>
                  <div class="step" id="lev4">Level 4</div>
                  <div class="step" id="lev5">Level 5</div>
               </div>
               <div class="nav clearfix" style="display:none; ">
                  <a href="#" class="prev">Previous</a>
                  <a href="#" class="next pull-right">Next</a>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-3 col-xs-12 col-sm-3 ulevel">
               <p>Total Games Played : <strong class="levl3">5</strong>  
               <p>Total Coins Earned : <strong class="levl3">3500</strong>
               <p><button type="submit" id="addMe" name="req_to_admin" class="btn-upper btn-sm btn-info">Request Coins</button></p>
            </div>
            <div class="col-md-4 col-xs-12 col-sm-4 ulevel">
               <p style="font-size:14px;">Just Needs <strong style="color:red; "><?php echo $user_level['next_level'];?>Points</strong> To Acheive Next Level</p>
            </div>
            <div class="col-md-5 col-xs-12 col-sm-5 text-right ulevel" >
               <div class="col-xs-12 col-md-12 col-sm-12">
                  <p style="padding-right: 60px;">Refer to friend</p>
                  <?php $string = $user_detail['name'];
                     $string = str_replace(' ', '.', $string);?>
                  <p>http://www.gc.co?ref=<?php echo $string;?></p>
               </div>
               <div class="col-xs-12 col-md-12 col-sm-12 ulevel">
                  <button class="btn btn-basic share-btnv">
                     Share & Earn Points
                     <div class="social-icon social "><i class="fa fa-facebook "></i></div>
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php }?>	
<!-- *******************************************End Section For Player Level************************************************** -->
				<!-- Banner -->
				<section class="banner p-t-40 p-b-40">
					<div class="container">
						<div class="row">
							<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
								<!-- block1 -->
								<div class="block1 hov-img-zoom pos-relative m-b-30">
									<img src="images/banner1.png" alt="IMG-BENNER">
									<div class="text_img">
										<h5>LUCKY 28</h5>
										<p>Real Game Real Players</p>
										<p><a href="game_zone.php" style="color:white;text-decoration:underline">Play Now</a></p>
									</div>
								</div>
								<!-- block1 -->
								<div class="block1 hov-img-zoom pos-relative m-b-30" style="border-bottom:1px solid #08a6cc;">
									<h1 class="list-heading">Admin Announcements</h1>
									<div id="MyDivName" style="overflow:hidden;height:285px;" onMouseOver="pauseDiv()" onMouseOut="resumeDiv()">
										<ul style="border:2px solid #08a6cc;text-align:center;">
											<?php
											$query = "SELECT * FROM  announcement where is_active =1";
											$result = mysqli_query($con, $query) or die(mysqli_error($con));
											$i=0; while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {

												$announcement=$row['announcement'];
												$announcement_date=$row['announcement_date'];
												$announcement_time=$row['announcement_time'];
												$slider_description=$row['slider_description'];
												?>	
												<li><?php echo $announcement;?><p  class="list-para"><?php echo $announcement_date;?> &nbsp&nbsp <?php echo $announcement_time;?></p></li><hr>
												<?php }?>
											</ul>
										</div>
										<div class="block1-wrapbtn w-size2">	
										</div>
									</div>
								</div>
								<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
									<!-- block1 -->
									<div class="block1 hov-img-zoom pos-relative m-b-30">
										<img src="images/banner4.png" alt="IMG-BENNER">
										<div class="text_img">
											<h5>GIFT STORE</h5>
											<p>Beyond Smart</p>
											<p><a href="product.php" style="color:white;text-decoration:underline">Discover Now</a></p>
										</div>
										<div class="block1-wrapbtn w-size2">	
										</div>
									</div>
									<!-- block1 -->
									<style>
									#MyDivName1 p{margin-bottom: 0 !important;}
								</style>
								<div class="block1 hov-img-zoom pos-relative m-b-30" style="border:1px solid #08a6cc;">
									<h1 class="list-heading">Winner Lists</h1>
									<div class="list-group" id="MyDivName1" style="overflow:hidden;height:285px;"  onMouseOver="pauseDiv1()" onMouseOut="resumeDiv1()">

							<?php $winners = $user_obj->get_winners();//print_r($winners);
							while ($winner = mysqli_fetch_array($winners)){
								$user_id = $winner['user_id'];
								$total_bid_amount = $winner['total_bid_amount'];
								$total_won_coins = $winner['total_won_coins'];
								$win_date = $winner['create_date'];
								/*Get user detail by id*/
								$user_detail = $user_obj->user_detail_byid($user_id);
								?>
								<div class="row winner_list">
									<div class="col-sm-3">
										<?php if($user_detail['social_id']!=''){?>
										<img src="<?php echo $user_detail['user_picture'];?>"  style="width:80px">
										<?php } else {
											if($user_detail['user_picture'] == ""){ ?>
											<img src="users-images/user.png" style="width:80px">
											<?php }else {?>
											<img src="users-images/<?php echo $user_detail['user_picture'];?>" style="width:80px">
											<?php }}?>
										</div>
										<div class="col-sm-9">
											<p class="list-group-item-heading"><?php echo $user_detail['name'];?></p>
											<p class="list-group-item-heading"><span  style="color:#666;">Coins won:</span><span style="color:#e82a1b"> <?php echo $total_won_coins;?></span></p>
											<p class="list-group-item-text"><?php echo $win_date;?></p></div>
										</div>
										<?php }?>

										
									</div>

									<div class="block1-wrapbtn w-size2">


									</div>
								</div>
							</div>
							<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
								<!-- block1 -->
								<div class="block1 hov-img-zoom pos-relative m-b-30">
									<img src="images/banner3.png" alt="IMG-BENNER">
									<div class="text_img">
										<h5>FRIENDS SHARING</h5>
										<p>Share Is Care</p>
										<p><a href="view_friends" style="color:white;text-decoration:underline">Discover Now</a></p>
									</div>
									<div class="block1-wrapbtn w-size2">	
									</div>
								</div>
								<!-- block2 -->
								<div class="block2 wrap-pic-w pos-relative m-b-30">
									<img src="images/banner5.png" style="height:333px">
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- New Product -->
			<section class="newproduct bgwhite p-t-45 p-b-105">
				<div class="container">
					<div class="sec-title p-b-60">
						<h1 class="m-text5 t-center" style="text-align:center">
							Top Players 
						</h1>
					</div>
					<!-- Slide2 -->
					<div class="">
						<div class="row">
							<div class="col-sm-3" style="border:2px solid #08a6cc">
								<div class="item-slick2 p-l-15 p-r-15">
									<h5 style="padding-top:20px;padding-bottom:5px;text-align:center;font-family:poppins-bold">Player of the month</h5><hr>
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
											<img src="images/boy.png" alt="IMG-PRODUCT" style="width:250px;text-align:center">

											<div class="block2-overlay trans-0-4">
												<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
													<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
													<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
												</a>

												<div class="block2-btn-addcart w-size1 trans-0-4">
													<!-- Button -->
													<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
														<h6>Player of the month</h6>
													</button>
												</div>
											</div>
										</div>

										<div class="block2-txt p-t-20">
											<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">
												<h5 style="text-align:center">LazyBoy0317</h5>
											</a>
											<span class="block2-price  p-r-5">
												<div style="color:#666;text-align:left;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 634566</span></div>
												<div style="color:#666;text-align:left;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 634566</span></div>
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
													<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
														<div class="row">	
															<?php $data = $user_obj->get_all_user();	
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
																}?>
																<div class=" col-sm-2">
																	<?php if($row['social_id']!=''){?>
																	<img src="<?php echo $row['user_picture'];?>"  width="100px" height="100px">
																	<?php } else {
																		if($row['user_picture'] == ""){ ?>
																		<img src="users-images/user.png" width="100px" height="100px">
																		<?php }else {?>
																		<img src="users-images/<?php echo $row['user_picture'];?>" width="100px" height="100px">
																		<?php }}?>
																		<h6 class="topname"><a class="name-player" href="user-profile.php?user=<?php echo toPublicId($user_id);?>" target="_blank"  >	
																			<?php echo $row['name'];?>
																		</a></h6>
																		<div class="coin_display">	
																			<div style="color:#666;text-align:left;font-size:10px;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/icons/bid.png" width="20" height="20"> <?php echo $total_bids;?></span></div>	
																			<div style="color:#666;text-align:left;font-size:10px;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/icons/won.png" width="20" height="20"> <?php echo $total_won;?></span></div></div>													
																		</div><?php }?>
																	</div>
																</div>
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
																			<div class=" col-sm-2">

																				<?php if($row['social_id']!=''){?>
																				<img src="<?php echo $row['user_picture'];?>"  width="100px" height="100px" class="toplist">
																				<?php } else {
																					if($row['user_picture'] == ""){ ?>
																					<img src="users-images/user.png" width="100px" height="100px" class="toplist">
																					<?php }else {?>
																					<img src="users-images/<?php echo $row['user_picture'];?>" width="100px" height="100px" class="toplist">
																					<?php }}?>
																					<h6 style="text-align:center;font-family:poppins-semibold;padding-top:6px;"><a href="user-profile.php?user=<?php echo toPublicId($user_id);?>" target="_blank" ><?php echo $row['name'];?></a></h6>

																					<div style="color:#666;text-align:left;font-size:10px;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/icons/bid.png" width="20" height="20"> <?php echo $total_bids;?></span></div>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/won.png" width="20" height="20"> <?php echo $total_won;?></span></div>
																				</div><?php }?>
																			</div>
																		</div>
																		<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
																			<div class="row">

																				<div class=" col-sm-2">
																					<img src="users-images/i1.jpg" style="width:130px;height:130px;">
																					<h6 style="text-align:center;font-family:poppins-semibold;padding-top:6px;"><a href="user-profile.php?id=10" target="_blank"  >LazyGirl1923</a></h6>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 6340</span></div>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 12040</span></div>
																				</div>

																				<div class=" col-sm-2" style="padding-bottom:15px;">
																					<img src="users-images/i2.jpg" style="width:130px;height:130px;">
																					<h6 style="text-align:center;font-family:poppins-semibold;padding-top:6px;"><a href="user-profile.php?id=10" target="_blank"  >LazyGirl1923</a></h6>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 6340</span></div>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 12040</span></div>
																				</div>
																				<div class=" col-sm-2">
																					<img src="users-images/i1.jpg" style="width:130px;height:130px;">
																					<h6 style="text-align:center;font-family:poppins-semibold;padding-top:6px;"><a href="user-profile.php?id=10" target="_blank"  >LazyGirl1923</a></h6>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 6340</span></div>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 12040</span></div>
																				</div>
																				<div class=" col-sm-2">
																					<img src="users-images/i3.jpg" style="width:130px;height:130px;">
																					<h6 style="text-align:center;font-family:poppins-semibold;padding-top:6px;"><a href="user-profile.php?id=10" target="_blank"  >LazyGirl1923</a></h6>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 6340</span></div>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 12040</span></div>
																				</div>
																				<div class=" col-sm-2">
																					<img src="users-images/i2.jpg" style="width:130px;height:130px;">
																					<h6 style="text-align:center;font-family:poppins-semibold;padding-top:6px;"><a href="user-profile.php?id=10" target="_blank"  >LazyGirl1923</a></h6>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 6340</span></div>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 12040</span></div>
																				</div>
																				<div class=" col-sm-2">
																					<img src="users-images/i1.jpg" style="width:130px;height:130px;">
																					<h6 style="text-align:center;font-family:poppins-semibold;padding-top:6px;"><a href="user-profile.php?id=10" target="_blank"  >LazyGirl1923</a></h6>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 6340</span></div>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 12040</span></div>
																				</div>
																			</div>
																		</div>
																		<div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
																			<div class="row">

																				<div class=" col-sm-2">
																					<img src="users-images/i1.jpg" style="width:130px;height:130px;">
																					<h6 style="text-align:center;font-family:poppins-semibold;padding-top:6px;"><a href="user-profile.php?id=10" target="_blank"  >LazyGirl1923</a></h6>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 6340</span></div>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 12040</span></div>
																				</div>

																				<div class=" col-sm-2" style="padding-bottom:15px;">
																					<img src="users-images/i2.jpg" style="width:130px;height:130px;">
																					<h6 style="text-align:center;font-family:poppins-semibold;padding-top:6px;"><a href="user-profile.php?id=10" target="_blank"  >LazyGirl1923</a></h6>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 6340</span></div>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 12040</span></div>
																				</div>
																				<div class=" col-sm-2">
																					<img src="users-images/i1.jpg" style="width:130px;height:130px;">
																					<h6 style="text-align:center;font-family:poppins-semibold;padding-top:6px;"><a href="user-profile.php?id=10" target="_blank"  >LazyGirl1923</a></h6>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 6340</span></div>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 12040</span></div>
																				</div>
																				<div class=" col-sm-2">
																					<img src="users-images/i3.jpg" style="width:130px;height:130px;">
																					<h6 style="text-align:center;font-family:poppins-semibold;padding-top:6px;"><a href="user-profile.php?id=10" target="_blank"  >LazyGirl1923</a></h6>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 6340</span></div>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 12040</span></div>
																				</div>
																				<div class=" col-sm-2">
																					<img src="users-images/i2.jpg" style="width:130px;height:130px;">
																					<h6 style="text-align:center;font-family:poppins-semibold;padding-top:6px;"><a href="user-profile.php?id=10" target="_blank"  >LazyGirl1923</a></h6>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 6340</span></div>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 12040</span></div>
																				</div>
																				<div class=" col-sm-2">
																					<img src="users-images/i1.jpg" style="width:130px;height:130px;">
																					<h6 style="text-align:center;font-family:poppins-semibold;padding-top:6px;"><a href="user-profile.php?id=10" target="_blank"  >LazyGirl1923</a></h6>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 6340</span></div>
																					<div style="color:#666;text-align:left;font-size:10px;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/GameCoin-sm.png" class=""> 12040</span></div>
																				</div>
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
									</div>	
									<div class="container">																		</section>

										<div class="col-lg-12 play1 text-center"> 
											<?php
date_default_timezone_set('UTC');// change according timezone
$currentTime = date( 'Y-m-d H:i:s', time () );
$query = "SELECT * FROM tbl_game where game_start_time >= CURDATE() and is_active =1 limit 1";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
$game_start_time = $row['game_start_time'];
?>
<h1 style="text-align:center;font-size:26px;padding-top:1%">Next Game Starts in</h1>
<div class="clock" style="padding-top:2%;"></div>
<button class="faa-pulse animated" onClick="window.open('/giftscome/game_zone.php');" style="color:#000 ">CHECK PREVIOUS PAYOUT</button>
</div>
<div class="col-lg-12 play2 text-center" style="background-color:#0daacf;"> 
	<h1 style="text-align:center;font-size:26px;padding-top:1%; color:#fff;">Game Started</h1> 
	<button class="faa-pulse animated" onClick="window.open('/giftscome/game_zone.php');">
		<i class="fa far fa-play" aria-hidden="true" style="padding-right:10px "></i>PLAYNOW</button>
	</div>
</div>

<section class="blog bgwhite p-t-94 p-b-65">
	<div class="container">
		<div class="sec-title p-b-52">
			<h3 class="m-text5 t-center">
				Redeem from our gift store
			</h3>
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
				<div class="col-sm-10 col-md-2 p-b-30 m-l-r-auto Product">
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
							<span class="s-text6" class="s-text7 " style="font-size:14px;"><img alt="Game Coins" src="images/GameCoin-sm.png" style="padding-right: 5px;" /><?php echo $productPrice;?></span>
						</div>
					</div>
				</div>
				<?php } ?>

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
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/lightbox2/js/lightbox.min.js"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	</script>
	<script language="javascript">
		ScrollRate = 25;
		ScrollRate1 = 25;

		function scrollDiv_init() {
			DivElmnt = document.getElementById('MyDivName');
	//DivElmnt1 = document.getElementById('MyDivName1');
	ReachedMaxScroll = false;
	//ReachedMaxScroll1 = false;
	
	DivElmnt.scrollTop = 0;
	//DivElmnt.scrollTop1 = 0;
	PreviousScrollTop = 0;
	//PreviousScrollTop1 = 0;
	
	ScrollInterval = setInterval('scrollDiv()', ScrollRate);
	//ScrollInterval1 = setInterval('scrollDiv()', ScrollRate1);
}
function scrollDiv_init1() {
	
	DivElmnt1 = document.getElementById('MyDivName1');
	
	ReachedMaxScroll1 = false;
	
	
	DivElmnt.scrollTop1 = 0;
	
	PreviousScrollTop1 = 0;
	
	
	ScrollInterval1 = setInterval('scrollDiv()', ScrollRate1);
}

function scrollDiv() {
	
	if (!ReachedMaxScroll) {
		DivElmnt.scrollTop = PreviousScrollTop;
		PreviousScrollTop++;

		ReachedMaxScroll = DivElmnt.scrollTop >= (DivElmnt.scrollHeight - DivElmnt.offsetHeight);
	}
	else {
		ReachedMaxScroll = (DivElmnt.scrollTop == 0)?false:true;

		DivElmnt.scrollTop = PreviousScrollTop;
		PreviousScrollTop--;
	}
	
}
function scrollDiv1() {
	
	if (!ReachedMaxScroll1) {
		DivElmnt1.scrollTop = PreviousScrollTop1;
		PreviousScrollTop1++;

		ReachedMaxScroll1 = DivElmnt1.scrollTop >= (DivElmnt1.scrollHeight - DivElmnt1.offsetHeight);
	}
	else {
		ReachedMaxScroll1 = (DivElmnt1.scrollTop == 0)?false:true;

		DivElmnt1.scrollTop = PreviousScrollTop1;
		PreviousScrollTop1--;
	}
}

function pauseDiv() {
	clearInterval(ScrollInterval);
}
function pauseDiv1() {
	clearInterval(ScrollInterval1);
}

function resumeDiv() {
	PreviousScrollTop = DivElmnt.scrollTop;
	ScrollInterval = setInterval('scrollDiv()', ScrollRate);
}
function resumeDiv1() {
	PreviousScrollTop1 = DivElmnt1.scrollTop;
	ScrollInterval1 = setInterval('scrollDiv1()', ScrollRate1);
}
</script>
<script type="text/javascript">
	var clock;
	var game_start_time = '<?php echo $game_start_time;?>';
	$(document).ready(function() {
    // Set dates.
    var futureDate  = new Date(game_start_time);
    var currentDate = new Date('<?php echo $currentTime;?>');

    // Calculate the difference in seconds between the future and current date
    var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;
    if(diff<=0)
    	{	$(".Play1").remove();
    $(".Play2").show();
}
else{$(".Play2").remove();}
	// Calculate day difference and apply class to .clock for extra digit styling.
	function dayDiff(first, second) {
		return (second-first)/(1000*60*60*24);
	}

	if (dayDiff(currentDate, futureDate) < 100) {
		$('.clock').addClass('twoDayDigits');
	} else {
		$('.clock').addClass('threeDayDigits');
	}

	if(diff < 0) {
		diff = 0;
	}

     // Instantiate a coutdown FlipClock
     clock = $('.clock').FlipClock(diff, {
     //clockFace: 'MinuteCounter',
     countdown: true,
     callbacks: {
     	stop: function() {location.reload();
     	}
     }

 });
 });
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


</style>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.js'></script>
<script  src="js/index.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); });
</script>
</body>
</html>