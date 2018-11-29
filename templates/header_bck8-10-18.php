<?php @session_start();
require_once 'includes/config.php';
error_reporting(1);
$user_obj = new Cl_User();
?>
<?php
if(strlen($_SESSION['login'])!=0)
{
$uid= $_SESSION['id'];
/*Count unread ticket messages from admin to user*/
$unread_msgs =$user_obj->count_unread_msg($uid);
$level= $user_obj->get_level_point($uid);
$level_of_user =$level['user_level'];
/* Set Sub Level Of User */
$userpoints='';
$userpoints =$user_obj->user_total_points($uid);
$sql1 = mysqli_query($con,"SELECT * FROM user_levels where user_levels_name='$level_of_user'")or die(mysqli_error($con));
$result=mysqli_fetch_assoc($sql1);//print_r($result);
$sub_lev1_points =$result['sub_lev1_points'];
$sub_lev2_points =$result['sub_lev2_points'];
$sub_lev3_points =$result['sub_lev3_points'];
$sub_lev4_points =$result['sub_lev4_points'];
$sub_lev5_points =$result['sub_lev5_points'];
if($userpoints ==$sub_lev1_points || $userpoints < $sub_lev2_points )
	{
	  $sub_lev ='1';
	}
	if($userpoints >=$sub_lev2_points && $userpoints >$sub_lev1_points )
	{
	  $sub_lev ='2';
	}
	if($userpoints >=$sub_lev3_points && $userpoints >$sub_lev2_points)
	{
	  $sub_lev ='3';
	}
	if($userpoints >=$sub_lev4_points && $userpoints >$sub_lev3_points)
	{
	  $sub_lev ='4';
	}
	if($userpoints >=$sub_lev5_points && $userpoints >$sub_lev4_points)
	{
	  $sub_lev ='5';
	}
/* End Of Set Sub Level Of User */
/*Package Validity for user*/
$sss=mysqli_query($con,"SELECT count(*) as TotalVIPPackage FROM package_sales WHERE user_id='".$uid."' and expire_date >= CURRENT_DATE");
$row_vip_total=mysqli_fetch_array($sss);//print_r($row_vip_total);
$TotalVIPPackage = $row_vip_total['TotalVIPPackage'];
if($TotalVIPPackage ==0 )
{
	$query98=mysqli_query($con, "update users set user_type='normal' where id=".$uid."");	
}
/*End Package Validity for user*/
/*Set user's auto bid for all games*/
//require_once('auto-bids.php');
//$ret=mysqli_query($con,"select game_coins, gift_coins from users where id=$uid;");
$ret=mysqli_query($con,"select game_coins, gift_coins,sound_notification,user_type from users where id=$uid;");
$row=mysqli_fetch_array($ret);
//print_r($row);
$user_balance = $row['game_coins'];
$user_type = $row['user_type'];
if($user_type=='normal')
{
$user_type = 'Vip'; $cls='normal';
}
if($user_type=='vip')
{
$user_type = 'Vip';$cls='vip';
}
$_SESSION['sound_noti'] = $row['sound_notification'];
$sound_noti = $_SESSION['sound_noti'];
$_SESSION['gift_coins'] = $row['gift_coins'];
$_SESSION['game_coins'] = $user_balance;
}
$quer_new=mysqli_query($con,"select count(*) as UpdateGame from tbl_game WHERE (`game_status`=0 or `game_status`=1) and `game_start_time` < (UTC_TIMESTAMP - INTERVAL 3 HOUR_MINUTE)");
$row_new=mysqli_fetch_array($quer_new);
//print_r($row_new);
if($row_new['UpdateGame'] > 0){	
	$sql_12=mysqli_query($con, "update tbl_game set game_status = '3' WHERE (`game_status`=0 or `game_status`=1) and game_start_time < (UTC_TIMESTAMP - INTERVAL 3 HOUR_MINUTE)");	
}

?>
<!-- Header -->
<header class="header1">
	<!-- Header desktop -->
	<div class="container-menu-header">
		<div class="topbar">
			<div class="topbar-social">
				<a href="#" class="topbar-social-item fa fa-facebook"></a>
				<a href="#" class="topbar-social-item fa fa-instagram"></a>
				<!--<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
				<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
				<a href="#" class="topbar-social-item fa fa-youtube-play"></a>-->
			</div>

			<span class="topbar-child1">
				<a  href="my-account.php#collapseTwo"><img alt="Gift Coins" src="images/GiftCoin.png" class="top-icons" /><?php  if (isset($_SESSION['gift_coins'])) { echo number_format($_SESSION['gift_coins']); } else {echo '0000';} ?></a>
			</span>


			<?php 
			if(isset($_SESSION['name']) && $_SESSION['name']){
				$_SESSION['username_1'] =	$_SESSION['name'];
			}
			?>
			<div class="topbar-child2">
				<?php if(strlen(@$_SESSION['login'])==0)
				{ 
					echo $_SESSION['login'];  ?>
					<span class="topbar-email">
						<a href="login.php"><i class="icon fa fa-sign-in"></i> Login</a>
					</span>
					<?php } 
					else { ?>
					<?php $stylepopular= ''; $stylenotpopular= '';?>
					<?php 
					if($sound_noti==0)
					{
						$stylepopular= "style= display:none";
						$stylenotpopular= "style= cursor:pointer";
					}
					
					if($sound_noti==1)
					{
						$stylenotpopular= "style= display:none";
						$stylepopular= "style= cursor:pointer";
					}
					
					?>
					<span class="topbar-email" style="padding-right:10px;">
					<img id="imgnotpopular<?php echo $uid; ?>" onclick="funisactive(<?php echo $uid; ?>,1)" alt="click to play sound" title="click to play sound" src='images/sound-off.png' width='30' height='30' <?php echo $stylenotpopular;?> />
					<img id="imgpopular<?php echo $uid; ?>" onclick="funisactive(<?php echo $uid; ?>,0)" src='images/sound-on.png' alt="click to mute sound" title="click to mute sound" width='30' height='30' <?php echo $stylepopular;?> />
					</span>
					<span class="topbar-email" style="padding-right:10px;">
						Welcome, <?php echo htmlentities(@$_SESSION['username_1']);?> <span class="badge-pill badge-success user-level"><?php echo $level_of_user;?> <?php echo $sub_lev;?></span> <span class="badge-pill badge-success <?php echo $cls;?>"><?php echo $user_type;?></span>
					</span>
					<span class="topbar-email"  style="padding-right:10px;">
						<a href="my-account.php"><i class="icon fa fa-user"></i> My account</a> <a href="support_us.php"><i class="icon fa fa-envelope"></i></a><span class="header-count"><?php echo $unread_msgs; ?> </span>
					</span>
					<span class="topbar-email">
						<a href="logout.php"><i class="icon fa fa-sign-out"></i> Logout</a>
					</span>
					
					<?php } ?>

				</div>
			</div>

			<div class="wrap_header">
				<!-- Logo -->
				<a href="index.php" class="logo">
					<img style="max-height:100%;" src="images/logo.png" alt="IMG-LOGO">
				</a>

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li class="sale-noti">
								<a href="game_zone.php"  onclick="localStorage.clear();">GAME ZONE</a>
							</li>
							<li class="sale-noti">
								<a href="game-history.php"  onclick="localStorage.clear();">GAME HISTORY</a>
							</li>
							<li class="sale-noti">
								<a href="game_statistic.php"  onclick="localStorage.clear();">GAME STATISTICS</a>
							</li>
							<li class="">
								<a href="package.php"  onclick="localStorage.clear();">PACKAGES</a>
							</li>
							<li class="">
								<a href="coins-earning.php"  onclick="localStorage.clear();">Gift COINS EARNING </a>
							</li>
							<li class="">
								<a href="product.php"  onclick="localStorage.clear();">REDEEM</a>
							</li>
														
							<li class="">
								<a href="faq.php"  onclick="localStorage.clear();">FAQ</a>
							</li>
							<li class="">
								<a href="contact.php"  onclick="localStorage.clear();">CONTACT</a>
							</li>
							<!--<?php //if(strlen(@$_SESSION['login'])==0) {   ?>
							<?php //} else { ?>
							<li class="">
								<a href="chatting.php"  onclick="localStorage.clear();" class="notification">CHAT<span class="label label-pill label-danger count" style="border-radius:10px;"></span></a>
							</li>
							<?php //}?>
							-->
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->

				<div class="header-icons">
                    <!--<a href="#" class="header-wrapicon1 dis-block">
                        <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
                    </a>

                    <span class="linedivide1"></span>-->

                    <div class="header-wrapicon2">
                    	<span class="header-icons-noti badge"><?php if (!empty($_SESSION["shopping_cart"])) { echo  count($_SESSION["shopping_cart"]); } else { echo '0';} ?></span>
                    	<img src="images/icons/cart.png" class="header-icon1 js-show-header-dropdown" alt="ICON">


                    	<div class="header-cart header-dropdown" id="order_table">
                    		<?php
                    		if (!empty($_SESSION["shopping_cart"])) {
                    			$total = 0;
                    			foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                    				$_SESSION['product_quantity'] = $values["product_quantity"];
                    				$_SESSION['product_id'] = $values["product_id"];
                    				?> 
                    				<ul class="header-cart-wrapitem">
                    					<li class="header-cart-item">
                    						<div class="header-cart-item-img">
                    							<img src="admin/productimages/<?php echo $values["product_name"]?>/<?php echo $values["product_image"];?>" alt="IMG">
                    						</div>

                    						<div class="header-cart-item-txt">
                    							<a href="#" class="header-cart-item-name">
                    								<?php echo $values["product_name"]; ?>
                    							</a>
                    							<span class="header-cart-item-info">
                    								<?php echo number_format($values["product_price"]); ?> x <?php echo $values["product_quantity"]; ?>
                    							</span>



                    						</div>
                    					</li>
                    				</ul>
                    				<?php
                    				$total = $total + ($values["product_quantity"] * $values["product_price"]);
                    				$_SESSION['tp'] = $total;
                    			} ?>
                    			<div class="header-cart-total">
                    				Total: <?php echo number_format($total); ?>
                    			</div>
                    			<div class="header-cart-buttons">
                    				<div class="header-cart-wrapbtn">
                    					
                    				</div>
                    				<div class="header-cart-wrapbtn">
									<a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                    						View Cart
                    					</a>
                    					<!--<form method="post" action="">
                    						<button type="submit" name="ordersubmit_header"  class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                    							Check Out
                    						</button>
											
                    					</form>-->
                    				</div>
                    			</div>
                    			<?php } else { ?>
                    			Your Shopping Cart Is Empty!!
                    			<?php } ?>
                    		</div>

                    	</div>
                    </div>






                </div>
            </div>

            <!-- Header Mobile -->
            <div class="wrap_header_mobile">
            	<!-- Logo moblie -->
            	<a href="index.php" class="logo-mobile">
            		<img src="images/logo.png" alt="IMG-LOGO">
            	</a>

            	<!-- Button show menu -->
            	<div class="btn-show-menu">
            		<!-- Header Icon mobile -->
            		<div class="header-icons-mobile">
					<!--<a href="#" class="header-wrapicon1 dis-block">
						<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide2"></span>-->

					<div class="header-wrapicon2">
						<img src="images/icons/cart.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti badge"><?php if (!empty($_SESSION["shopping_cart"])) { echo  count($_SESSION["shopping_cart"]); } else { echo '0';} ?></span>

						<!-- Header cart noti -->
						<div class="header-cart header-dropdown" id="order_table">
							<?php 
							if (!empty($_SESSION["shopping_cart"])) {
								$total = 0;
								foreach ($_SESSION["shopping_cart"] as $keys => $values) {
									$_SESSION['product_quantity'] = $values["product_quantity"];
									$_SESSION['product_id'] = $values["product_id"];
									?> 
									<ul class="header-cart-wrapitem">
										<li class="header-cart-item">
											<div class="header-cart-item-img">
												<img src="admin/productimages/<?php echo $values["product_name"]?>/<?php echo $values["product_image"];?>" alt="IMG">
											</div>

											<div class="header-cart-item-txt">
												<a href="#" class="header-cart-item-name">
													<?php echo $values["product_name"]; ?>
												</a>
												<span class="header-cart-item-info">
													<?php echo number_format($values["product_price"]); ?> x <?php echo $values["product_quantity"]; ?>
												</span>



											</div>


										</li>
									</ul>
									<?php
									$total = $total + ($values["product_quantity"] * $values["product_price"]);
									$_SESSION['tp'] = $total;
								} ?>

								<div class="header-cart-total">
									Total: <?php echo number_format($total); ?>
								</div>

								<div class="header-cart-buttons">
									<div class="header-cart-wrapbtn">
										
									</div>
									<div class="header-cart-wrapbtn">
									<a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
											View Cart
										</a>
										<!--<form method="post" action="">
											<button type="submit" name="ordersubmit_header"  class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
												Check Out
											</button>

										</form>-->
									</div>
								</div>
								<?php } else { ?>
								Your Shopping Cart Is Empty!!
								<?php } ?>
								
								
							</div>
						</div>
					</div>

					<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</div>
				</div>
			</div>
			<span class="topbar-child1" style="margin-left:40%;">
							<a href="my-account.php#collapseTwo"><img alt="Gift Coins" src="images/GiftCoin.png" class="top-icons" /><?php  if (isset($_SESSION['gift_coins'])) { echo number_format($_SESSION['gift_coins']); } else {echo '0000';} ?></a>
			</span>

			<!-- Menu Mobile -->
			<div class="wrap-side-menu" >
				<nav class="side-menu">
					<ul class="main-menu">
						<li class="item-topbar-mobile p-l-10">
							<div class="topbar-social-mobile">
								<a href="#" class="topbar-social-item fa fa-facebook"></a>
								<a href="#" class="topbar-social-item fa fa-instagram"></a>
								<!--<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
								<a href="#" class="topbar-social-item fa fa-twitter"></a>
								<a href="#" class="topbar-social-item fa fa-youtube-play"></a>-->
							</div>
						</li>
										
						<?php 
						if(isset($_SESSION['name']) && $_SESSION['name']){
							$_SESSION['username_1'] =	$_SESSION['name'];
						}
						?>
			<?php if(strlen(@$_SESSION['login'])==0) {   ?>
					<div class="topbar-child2">
						<span class="topbar-email">
							<a href="login.php"><i class="icon fa fa-sign-in"></i> Login</a>
						</span>
					</div> <?php }
					 else { ?>
					<div class="topbar-child2">
						<span class="topbar-email" style="padding-right:10px;">
							Welcome, <?php echo htmlentities(@$_SESSION['username_1']);?> <span class="badge-pill badge-success user-level"><?php echo $level_of_user;?> <?php echo $sub_lev;?></span> <span class="badge-pill badge-success <?php echo $cls;?>"><?php echo $user_type;?></span>
						</span>
						<span class="topbar-email"  style="padding-right:10px;">
							<a href="my-account.php"><i class="icon fa fa-user"></i> My account</a> <a href="support_us.php"><i class="icon fa fa-envelope"></i></a><span class="header-count"><?php echo $unread_msgs; ?> </span>
						</span>
						<span class="topbar-email">
							<a href="logout.php"><i class="icon fa fa-sign-out"></i> Logout</a>
						</span>
					</div>
					<?php } ?>

					<li class="item-menu-mobile">
						<a href="game_zone.php">GAME ZONE</a>
					</li>
					<li class="item-menu-mobile">
								<a href="game-history.php"  onclick="localStorage.clear();">GAME HISTORY</a>
					</li>
					
					<li class="item-menu-mobile">
								<a href="game_statistic.php"  onclick="localStorage.clear();">GAME STATISTICS</a>
				   </li>

					<li class="item-menu-mobile">
						<a href="package.php">PACKAGES</a>
					</li>
					
					<li class="item-menu-mobile">
						<a href="coins-earning.php">Gift COINS EARNING</a>
					</li>

					<li class="item-menu-mobile">
						<a href="product.php">REDEEM</a>
					</li>
					
					 <li class="item-menu-mobile">
						<a href="faq.php" >FAQ</a>
					</li>
					<li class="item-menu-mobile">
						<a href="contact.php">CONTACT</a>
					</li>
					<!--<?php //if(strlen(@$_SESSION['login'])!=0) {   ?>
					<li class="item-menu-mobile">
						<a href="my-account.php">MY ACCOUNT</a>
					</li>
					<li class="item-menu-mobile">
						<a href="logout.php">LOGOUT</a>
					</li>
					<?php //} else {?>
					<li class="item-menu-mobile">
						<a href="login.php">LOGIN</a>
					</li> <?php //} ?>-->

				</ul>
			</nav>
		</div>
	</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
var timezone_offset_minutes = new Date().getTimezoneOffset();
timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;

// Timezone difference in minutes such as 330 or -360 or 0
//console.log(timezone_offset_minutes);

$.ajax({
			url: 'time.php',
			type: 'POST',
			async: false,
			data:{
				timezone_offset_minutes: timezone_offset_minutes,
				
			},
			success: function(pp){
				//alert(pp);
				//$('#time').html(response);
	
			}
		});
</script>
<?php
if(strlen($_SESSION['login'])!=0) {?>
<script>
//var jt = $.noConflict();
function funisactive(id,status)
{
	
	$.ajax({  
	 type: "POST",  
	 url: "sound_notification_update.php",  
	 data: "id=" + id + "& status=" + status,  
	 success: function(){  
		//success (not finished)
		if(status=='1')
		{
		$('#imgnotpopular'+id).hide();
		$('#imgpopular'+id).show();
		$('#imgpopular'+id).css("cursor","pointer");
		}
		else
		{
		$('#imgnotpopular'+id).show();
		$('#imgnotpopular'+id).css("cursor","pointer");
		$('#imgpopular'+id).hide();
		}
		}  
	 });  
  return false;
}
</script>
<?php }?>