<?php
session_start();
require_once('includes/config.php');
$user_obj = new Cl_User();
if(strlen($_SESSION['login'])==0)
{   
	$_SESSION['url'] = $_SERVER['REQUEST_URI'];
	header('location:login.php');
}
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
$uid = $_SESSION['id'];
$row = $user_obj->user_detail_byid($uid);
$id = $row['id'];
$user_type = $row['user_type'];
$gift_coins_balance =$row['gift_coins'];
/*Code of fetch how many time users have get coins in day*/
$result_data = $user_obj->times_of_coins_get($id);
$no_of_coins_get = $result_data['COUNT(1)'];

/*Code of fetch coins supplement details on request to admin by user id*/
$data123 = $user_obj->coins_supplement_details($user_type);
$minimum_gift_coins_value = $data123['minimum_gift_coins_value'];
$no_val = $data123['daily_click_button_limit'];
$gift_coins_value = $data123['gift_coins_value'];
/*Check user's login time*/
$ss=  mysqli_query($con,"SELECT logindate FROM userlog  WHERE user_id='$uid' order by loginTime desc limit 1");
$result_data = mysqli_fetch_assoc($ss);
$logindate = $result_data['logindate'];
$cur_date= date("Y-m-d");
/*Coins by social share*/
$coins_by_social_share = $user_obj->coins_value_social_share();
/*Count no of times daily login coins requested by user*/
$sql_98=  mysqli_query($con,"SELECT * FROM user_wallet  WHERE user_id='$uid' AND reason_mode_of_coins='By Redeem Daily Login Giftcoins' AND date_of_coins_get='$cur_date' ");
$no_of_daily_login_req = mysqli_num_rows($sql_98);
?>
<script type="text/javascript">
	if (window.location.hash == '#_=_'){
		history.replaceState 
		? history.replaceState(null, null, window.location.href.split('#')[0])
		: window.location.hash = '';
	}
</script>
<!DOCTYPE html>
<html>
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>Gift Coins Earning Center</title>
<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<meta property="og:image" content="http://giftscome.com.cp-28.hostgatorwebservers.com/images/fb-bg.png"/>
<meta property="og:title" content="Play Game & Get Coins"/>
<meta property="fb:app_id" content="208527059935526"/>
<?php require_once('templates/common_css.php');?>	
<style>
h2.title{color:#fff;}
.baner{font-size:20px; font-family:Montserrat-regular;max-width:230px;}
.note{color:red!important;font-size:12px;}
.text_img {position: absolute;top: 50%;left: 10%;transform: translate(0%, -50%);color: #fff;}
#RCS:hover {text-decoration: none; color: #08a6cc !important;}
a.btn.btn-basic.share-btnv {cursor: pointer;}
i.fa.fa-facebook{color:#fff;background-color:#3b5998;width:30px;height:30px;line-height:30px;font-size: 16px;border-radius:50%;text-align:center;transition:0.5s all;-webkit-transition:0.5s all;
-moz-transition:0.5s all;-o-transition:0.5s all;-webkit-border-radius:50%;-moz-border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;-ms-transition:0.5s all;}
i.fa.fa-facebook:hover {background-color:#17233E;}
.img_box{width:100%;}
.banner_bg {background-image:url(images/refer-earn1.png);background-size: cover; background-repeat: no-repeat; height: 243px;text-align: center;}
</style>
</head>
<body class="animsition">
<?php require_once('templates/header.php');?>
<!-- Title Page -->
	<section class="flex-col-c-m Uearn banner_bg" class="">
		<h2 class="title">Gift Coins Earning Center</h2>
	</section><br>
	<div class="container">
	<div class="row">
	<div class="col-sm-12 col-md-12 col-xs-12" id="msg_1"></div>
	     <div class="col-sm-4 col-md-4 col-xs-12 block1 hov-img-zoom pos-relative m-b-30">
		 <img src="images/req.png" alt="IMG-BENNER" class="img_box">
					<div class="text_img">
						<h6 class="baner">Request Coin <br> Supplement</h6>
						<p style="color:yellow";>Request to admin</p>
						<?php if(($gift_coins_balance <= $minimum_gift_coins_value) AND $no_of_coins_get < $no_val) {?>
						<p><button type="submit" id="RCS" name="req_to_admin" class="" style="color:black;text-decoration:underline">Request Coin Supplement</button></p>
						<?php } ?>
						<?php if($no_of_coins_get >= $no_val) {?>
						<p><button type="submit" id="" name="" class="" style="color:black;text-decoration:none; cursor:none;">Already Requested</button></p>
						<?php }?>
						<?php //if($gift_coins_balance < $minimum_gift_coins_value) {?>
						<!--<p><button type="submit" id="" name="" class="" style="color:black;text-decoration:none; cursor:none;">Coins balance is low to avail offer!!</button></p>-->
						<?php //}?>
						
						<p id="msg"></p>
						<p class="note">*You can request <?php echo $gift_coins_value;?> coins <br/>*You can request <?php echo $no_val;?> times per day <br/>*You can request if coin balance drop to <?php echo $minimum_gift_coins_value;?></p>
		 </div>
	</div>
		 <div class="col-sm-4 col-md-4 col-xs-12 block1 hov-img-zoom pos-relative m-b-30">
		 <img src="images/banner3.png" alt="IMG-BENNER" class="img_box">
					<div class="text_img">
						<h6 class="baner">By Refer To Friend</h6>
						<p style="color:yellow";>connect with friend</p>
						<p><a href="refer_coin.php" style="color:black;text-decoration:underline">Discover Now</a></p>
		 </div>
	</div>
	<div class="col-sm-4 col-md-4 col-xs-12 block1 hov-img-zoom pos-relative m-b-30">
		 <img src="images/package.png" alt="IMG-BENNER" class="img_box">
					<div class="text_img">
						<h6 class="baner">By Purchase <br>GiftsCome VIP</h6>
						<p style="color:yellow;">Get Coins</p>
						<p><a href="package.php" style="color:black;text-decoration:underline">Discover Now</a></p>
		 </div>
	</div>
	</div><br>
	<div class="row">
	     <div class="col-sm-4 col-md-4 col-xs-12 block1 hov-img-zoom pos-relative m-b-30">
		 <img src="images/package.png" alt="IMG-BENNER" class="img_box">
					<div class="text_img">
						<h6 class="baner">Redeem Your Daily <br>Login Giftscoins</h6>
						<p style="color:yellow;">Get Coins Reward</p>
						<?php 
							$curr_user= $user_obj->user_type($uid);
						if($curr_user=='vip'){?>
							<p>VIP users automatically get <br/> their daily login rewards.</p>
						<?php } else {
						if($no_of_daily_login_req<=0){?>
						<p><button type="submit" id="req_daily_login_coins" name="req_daily_login_coins" class="" style="color:black;text-decoration:underline">Click to redeem</button></p>
						<?php } else {?>
						<p><button type="submit" id="" name="" class="" style="color:black;text-decoration:none; cursor:none;">Already Requested</button></p>
						<?php }}?>
		 </div>
	</div>
	     <div class="col-sm-4 col-md-4 col-xs-12 block1 hov-img-zoom pos-relative m-b-30">
		 <img src="images/social-share.png" alt="IMG-BENNER" class="img_box">
					<div class="text_img">
					<h6 class="baner">Daily sharing to social media and earn</h6>
						<p style="color:yellow";><?php echo $coins_by_social_share;?> giftcoins</p>
						<p><a class="btn btn-basic share-btnv"><i class="fa fa-facebook"></i></p>
		 </div>
	    </div>
		 <!--<div class="col-sm-4 col-md-4 col-xs-12 block1 hov-img-zoom pos-relative m-b-30">
		 <img src="images/share.png" alt="IMG-BENNER" style="width:350px">
					<div class="text_img">
						<h6 class="baner">By Share To Friend</h6>
						<p style="color:yellow";>Share is Care</p>
						<p><a href="#" style="color:black;text-decoration:underline">Discover Now</a></p>
		 </div>
	</div>-->
	 <div class="col-lg-2"></div>
	</div>
	
	</div>
	</div>
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
<script type="text/javascript">
	$(document).ready(function() {
		var jq = $.noConflict();
		jq("#RCS").click(function(){
			//alert('dtrt');
				//var name = $("#name").val();
				//var email = $("#email").val();
				var name = 'preet';
				var name1= 'mtharu';
				var dataString = 'name='+ name + '&name1='+ name1;
					jq.ajax({
						url : 'coins_supplement.php', 
						type : 'post',
						data: dataString,
						success : function(data){
							jq("#msg_1").html(data);
							jq("#msg_1").show();
						 //window.setTimeout(function(){location.reload()},3000);
					}
				});		
			});
			
			jq("#req_daily_login_coins").click(function(){
				var id_user = '<?php echo $uid?>';
				var dataString = 'id_user='+ id_user;
					jq.ajax({
						url : 'coins_supplement_bydaily-login.php', 
						type : 'post',
						data: dataString,
						success : function(data){
							jq("#msg_1").html(data);
							jq("#msg_1").show();
						 //window.setTimeout(function(){location.reload()},3000);
					}
				});		
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
 $('.share-btnv').on( 'click', fb_share );
	});
	function fb_share() { 
			FB.ui( {
			method: 'feed',
			name: "GiftsCome",
			link: "http://giftscome.com.cp-28.hostgatorwebservers.com",
			picture: "http://giftscome.com.cp-28.hostgatorwebservers.com/images/fb-bg.png",
			caption: "Play Game & Get Coins",
			actions: {"name":"Search", "link":"http://giftscome.com.cp-28.hostgatorwebservers.com"}
		},  function(response) {

			if (response && !response.error_message) {
				 window.location.href = "share1.php";
				} else {
				//window.location.href = "/";
			}
		} );
	}
</script>
</body>
</html>