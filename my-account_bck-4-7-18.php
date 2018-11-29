<?php
session_start();
error_reporting(0);
include('includes/config.php');
$user_obj = new Cl_User();
if(strlen($_SESSION['login'])==0)
{   
	header('location:login.php');
}
$uid = $_SESSION['id'];
if(isset($_POST['update']) && $_SESSION["csrf_token"] == $_POST['csrf_token'])
{
	$name=$_POST['name'];
	if($_POST['nick_name']!='') {$nick_name=$_POST['nick_name']; } else {$nick_name=$_POST['nick_name_old'];}
	$gender=$_POST['gender'];
	$email=$_POST['email'];
	$contactno=$_POST['contactno'];
	$user_picture = $_FILES['user_image']['name'];
	$img_name = preg_replace("@[^A-Za-z0-9\-_.\/]+@i","",$user_picture);
	$tmp_user_picture = $_FILES['user_image']['tmp_name'];
	if(is_uploaded_file($tmp_user_picture))
	{
		move_uploaded_file($tmp_user_picture,"users-images/$img_name");
		$query=mysqli_query($con,"update users set name='$name',gender='$gender',email='$email',nick_name='$nick_name',contactno='$contactno',user_picture='$img_name' where id='".$_SESSION['id']."'");
		$_SESSION['msg'] ='Your info has been updated';
	}
	else
	{
		$query=mysqli_query($con,"update users set name='$name',gender='$gender',email='$email',nick_name='$nick_name',contactno='$contactno' where id='".$_SESSION['id']."'");
		$_SESSION['msg'] ='Your info has been updated';	
	}
}
	// code for shipping address updation
	if(isset($_POST['billupdate']) && $_SESSION["csrf_token_3"] == $_POST['csrf_token_3'])
	{
		$saddress=$_POST['shippingaddress'];
		$sstate=$_POST['shippingstate'];
		$scity=$_POST['shippingcity'];
		$spincode=$_POST['shippingpincode'];
		$query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
		if($query)
		{
			$_SESSION['msg'] ='Your info has been updated';
		}
	}
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_POST['subbtn']) && @$_SESSION["csrf_token_1234"] == @$_POST['csrf_token_1234'])
{
//print_r($_POST);
$payout_amount0 = $_POST['payout_amount0'];
$payout_amount1 = $_POST['payout_amount1'];
$payout_amount2 = $_POST['payout_amount2'];
$payout_amount3 = $_POST['payout_amount3'];
$payout_amount4 = $_POST['payout_amount4'];
$payout_amount5 = $_POST['payout_amount5'];
$payout_amount6 = $_POST['payout_amount6'];
$payout_amount7 = $_POST['payout_amount7'];
$payout_amount8 = $_POST['payout_amount8'];
$payout_amount9 = $_POST['payout_amount9'];
$payout_amount10 = $_POST['payout_amount10'];
$payout_amount11 = $_POST['payout_amount11'];
$payout_amount12 = $_POST['payout_amount12'];
$payout_amount13 = $_POST['payout_amount13'];
$payout_amount14 = $_POST['payout_amount14'];
$payout_amount15 = $_POST['payout_amount15'];
$payout_amount16 = $_POST['payout_amount16'];
$payout_amount17 = $_POST['payout_amount17'];
$payout_amount18 = $_POST['payout_amount18'];
$payout_amount19 = $_POST['payout_amount19'];
$payout_amount20 = $_POST['payout_amount20'];
$payout_amount21 = $_POST['payout_amount21'];
$payout_amount22 = $_POST['payout_amount22'];
$payout_amount23 = $_POST['payout_amount23'];
$payout_amount24 = $_POST['payout_amount24'];
$payout_amount25 = $_POST['payout_amount25'];
$payout_amount26 = $_POST['payout_amount26'];
$payout_amount27 = $_POST['payout_amount27'];
$total_pre_bids = $payout_amount0 + $payout_amount1 + $payout_amount2 + $payout_amount3 + $payout_amount4 + $payout_amount5 + $payout_amount6 + $payout_amount7 + $payout_amount8 + $payout_amount9 + $payout_amount10 + $payout_amount11 + $payout_amount12 + $payout_amount13 + $payout_amount14 + $payout_amount15 + $payout_amount16 + $payout_amount17 + $payout_amount18 + $payout_amount19 + $payout_amount20 + $payout_amount21 + $payout_amount22 + $payout_amount23 + $payout_amount24 + $payout_amount25 + $payout_amount26 + $payout_amount27; 
$sql = mysqli_query($con,"SELECT * FROM tbl_user_robot where user_id ='$uid'");
$result=mysqli_fetch_array($sql);
if($result=='')
{
$sql=mysqli_query($con,"insert into tbl_user_robot(bid_0,bid_1,bid_2,bid_3,bid_4,bid_5,bid_6,bid_7,bid_8,bid_9,bid_10,bid_11,bid_12,bid_13,bid_14,bid_15,bid_16,bid_17,bid_18,bid_19,bid_20,bid_21,bid_22,bid_23,bid_24,bid_25,bid_26,bid_27,user_id,total_bids) values('$payout_amount0','$payout_amount1','$payout_amount2','$payout_amount3','$payout_amount4','$payout_amount5','$payout_amount6','$payout_amount7','$payout_amount8','$payout_amount9','$payout_amount10','$payout_amount11','$payout_amount12','$payout_amount13','$payout_amount14','$payout_amount15','$payout_amount16','$payout_amount17','$payout_amount18','$payout_amount19','$payout_amount20','$payout_amount21','$payout_amount22','$payout_amount23','$payout_amount24','$payout_amount25','$payout_amount26','$payout_amount27','$uid',$total_pre_bids)");
}
else
{
$sql=mysqli_query($con,"update tbl_user_robot set bid_0='$payout_amount0',bid_1='$payout_amount1', bid_2='$payout_amount2',bid_3='$payout_amount3',bid_4='$payout_amount4',bid_5='$payout_amount5',bid_6='$payout_amount6',bid_7='$payout_amount7',bid_8='$payout_amount8',bid_9='$payout_amount9',bid_10='$payout_amount10',bid_11='$payout_amount11',bid_12='$payout_amount12',bid_13='$payout_amount13',bid_14='$payout_amount14',bid_15='$payout_amount15',bid_16='$payout_amount16',bid_17='$payout_amount17',bid_18='$payout_amount18',bid_19='$payout_amount19',bid_20='$payout_amount20',bid_21='$payout_amount21',bid_22='$payout_amount22',bid_23='$payout_amount23',bid_24='$payout_amount24',bid_25='$payout_amount25',bid_26='$payout_amount26',bid_27='$payout_amount27',total_bids='$total_pre_bids' where user_id ='$uid' ");
}
$_SESSION['msg']="Record Added Successfully!!";
require_once('auto-bids-latest.php');
}
?>
<script type="text/javascript">
	if (window.location.hash == '#_=_'){
		history.replaceState 
		? history.replaceState(null, null, window.location.href.split('#')[0])
		: window.location.hash = '';
	}
</script>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="MediaCenter, Template, eCommerce">
	<meta name="robots" content="all">
	<title>My Account</title>
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	<!-- Customizable CSS -->
<?php require_once('templates/common_css.php');?>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/main.css">
	
	<link rel="stylesheet" href="admin/css/matrix-style.css" />
	<link rel="stylesheet" href="admin/css/matrix-media.css" />
	
	<style>
	.dataTables_filter {display:none;}
	div.dataTables_wrapper .ui-widget-header {
		border-right: medium none;
		border-top: 0px;
		font-weight: normal;
		margin-top: -1px;
	}
	.widget-title, .modal-header, .table th, div.dataTables_wrapper .ui-widget-header {
		background: none;
		border: none;
		height: 36px;
	}
	.dataTables_length {
		color: #878787;
		margin: 20px 14px 5px 0;
		position: relative;
		left: 5px;
		width: 50%;
		top: 0px;
	}
</style>
</head>
<body class="animsition">
	<?php require_once('templates/header.php');?>
	<!-- ============================================== HEADER : END ============================================== -->
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
		<h2 style="color:#fff;">
			My Account
		</h2>
	</section>
	<section class="bgwhite p-t-66 p-b-38">
		<div class="container">
			<div class="body-content outer-top-bd">
				<div class="container">
					<div class="checkout-box inner-bottom-sm">
						<div class="row">
							<div class="col-md-12">
								<?php if(!empty($_SESSION['msg'])){?>
								<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
								</div>
								<?php } ?>
								<?php if(!empty($_SESSION['msg_status'])){?>
								<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg_status']);?><?php echo htmlentities($_SESSION['msg_status']="");?>
								</div>
								<?php } ?>
								<?php if(!empty($_SESSION['alert_msg'])){?>
								<div class="alert alert-danger alert-dismissible" id="msg">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oops!</strong>	<?php echo htmlentities($_SESSION['alert_msg']);?><?php echo htmlentities($_SESSION['alert_msg']="");?>
								</div>
								<?php } ?>
								<div class="panel-group checkout-steps" id="accordion">
									<!-- checkout-step-01  -->
									<div class="panel panel-default checkout-step-01">
										<!-- panel-heading -->
										<div class="panel-heading">
											<h4 class="unicase-checkout-title">
												<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
													<span>1</span>My Profile
												</a>
											</h4>
										</div>
										<!-- panel-heading -->
										<div id="collapseOne" class="panel-collapse collapse in">
											<!-- panel-body  -->
											<div class="panel-body">
												<div class="row">
													<!-- <h4 class="title-custome">Personal info</h4><br/> -->
													<!-- <p><a href="admin/user_login.php" target="_blank">Login </a> to your dashboard to manage your profile.</p> -->

													<div class="col-md-12 col-sm-12 already-registered-login">
														<?php
														$row = $user_obj->user_detail_byid($uid);
														//echo '<pre>'; print_r($row);
														?>
<form class="register-form coin-balance" name="editprofile" id="editprofile" role="form" method="post" enctype="multipart/form-data">
	<div class="row col-md-12 form-group">
		<div class="col-md-4"> <label class="info-title" for="name">Name<span>*</span></label></div>
		<div  class="col-md-8"><input type="text" class="form-control unicase-form-control text-input" value="<?php echo $row['name'];?>" id="name" name="name" required="required">
		<?php $_SESSION['name']=$row['name'];?>
			<span class="help-block"></span>
		</div>
	</div>
	<div class="row col-md-12 form-group">
		<div class="col-md-4"><label class="info-title" for="name">Profile Image<span>*</span></label>
		<?php $_SESSION['login_userpic']=$row['user_picture'];?>
		</div>
		<div class="col-md-8">
			<span class="help-block"></span>
			<?php if($row['social_id']!=''){?>
			<img src="users-images/<?php echo $row['user_picture'];?>"  width="100px" height="100px">
			<?php } else {
				if($row['user_picture'] == ""){ ?>
				<img src="users-images/user.png" width="100px" height="100px">
				<?php }else {?>
				<img src="users-images/<?php echo $row['user_picture'];?>" width="100px" height="100px">
				<?php $_SESSION['login_userpic']=$row['user_picture'];?>
				<?php }}?><br>
				<input type="file" class="form-control unicase-form-control text-input" name="user_image">
			</div>
		</div>
		<div class="row col-md-12 form-group">
			<div class="col-md-4"><label class="info-title" for="name">Gender</label>
			</div>
			<div class="col-md-8"> <div class="controls" style="display:table">
					   <!--   <input type="radio"  name="gender" value="Male" <?php if ($row['gender'] == 'Male') echo 'checked="checked"'; ?> /> Male<br />
					   	<input type="radio" name="gender" value="Female"<?php if ($row['gender'] == 'Female') echo 'checked="checked"'; ?> /> Female -->
					   	<label for="one">Male</label><input type="radio"  name="gender" value="Male" <?php if ($row['gender'] == 'Male') echo 'checked="checked"'; ?> />
					   	&nbsp;&nbsp;&nbsp;<label for="two">Female</label><input type="radio" name="gender" value="Female"<?php if ($row['gender'] == 'Female') echo 'checked="checked"'; ?> />
					   </div>
					</div>
				</div>
				<div class="row col-md-12 form-group">
					<div class="col-md-4"> <label class="info-title" for="name">Nick Name</label>
					</div>
					<div class="col-md-8"> <input type="text" class="form-control unicase-form-control text-input" value="<?php echo $row['nick_name'];?>" id="nick_name" name="nick_name">
					<input type="hidden" value="<?php echo $row['nick_name'];?>" id="nick_name_old" name="nick_name_old">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="row col-md-12 form-group">
					<div class="col-md-4">
						<label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
					</div>
					<div class="col-md-8">
						<input type="email" class="form-control unicase-form-control text-input" id="email" name="email" value="<?php echo $row['email'];?>" readonly >
						<span class="help-block"></span>
					</div>
				</div>
				<div class="row col-md-12 form-group">
					<div class="col-md-4"><label class="info-title" for="Contact No.">Contact No.</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control unicase-form-control text-input" id="contactno" name="contactno"  value="<?php echo $row['contactno'];?>"  maxlength="10">
						<span class="help-block"></span>
					</div>
				</div>				   
				<?php $_SESSION["csrf_token"] = md5(rand(0,10000000)).time(); ?>
				<input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION["csrf_token"]);?>">
				<button type="submit" name="update" class="btn-upper btn btn-primary checkout-page-button">Update</button>
				<button type="reset" class="btn-upper btn btn-primary checkout-page-button" value="Cancel">Cancel</button>
			</form>
		</div>	
		<!-- already-registered-login -->		
	</div>			
</div>
<!-- panel-body  -->
</div><!-- row -->
</div>
<!-- checkout-step-02  -->
<div class="panel panel-default checkout-step-02">
	<!-- panel-heading -->
	<div class="panel-heading">
		<h4 class="unicase-checkout-title">
			<a data-toggle="collapse" class="collapsed in" data-parent="#accordion" href="#collapseTwo">
				<span>2</span>Coins Balance
			</a>
		</h4>
	</div>
	<!-- panel-heading -->
	<div id="collapseTwo" class="panel-collapse collapse ">
		<!-- panel-body  -->
		<div class="panel-body">
			<div class="row">		
				<div class="col-md-12 col-sm-12 already-registered-login coin-balance">
					<div class="row col-md-12 form-group">
						<div class="col-md-4"><label class="info-title" for="Billing State ">Total Gift Coins</label>
						</div>
						<div class="col-md-8">
							<input type="text" class="form-control unicase-form-control text-input" id="gift_coins" name="gift_coins" value="<?php echo $row['gift_coins'];?>" readonly>
						</div>
					</div>
					<div class="row col-md-12 form-group">
						<div class="col-md-4">
							<label class="info-title" for="Billing City">Total Game Coins</label>
						</div>
						<div class="col-md-8">
							<input type="text" class="form-control unicase-form-control text-input" id="game_coins" name="game_coins"  value="<?php echo $row['game_coins'];?>" readonly>
						</div>
					</div>
					<div class="row col-md-12 form-group">
						<?php
						$id = $row['id'];
						$user_type = $row['user_type'];
						$gift_coins_balance =$row['gift_coins'];
						/*Code of fetch how many time users have get coins in day*/
						$result_data = $user_obj->times_of_coins_get($id);
						$no_of_coins_get = $result_data['COUNT(1)'];
						/*Code of fetch coins supplement details on request to admin by user id*/
						$data123 = $user_obj->coins_supplement_details($user_type);
						$minimum_gift_coins_value = $data123['minimum_gift_coins_value'];
					    ?>
					<?php if(($gift_coins_balance >= $minimum_gift_coins_value) AND $no_of_coins_get < 5) {?>
					<p>You can request gift coins 5 times a day.</p>
					<button type="submit" id="RCS" name="req_to_admin" class="btn-upper btn btn-primary checkout-page-button">Request Coin Supplement</button>
					<?php $_SESSION["csrf_token_1"] = md5(rand(0,10000000)).time(); ?>
					<input type="hidden" name="csrf_token_1" value="<?php echo htmlspecialchars($_SESSION["csrf_token_1"]);?>">
					<div id="theCount"></div>
					<input type="hidden" id="hiddenVal" value="0">
					<?php } else { ?>
					<p>*To claim this offer your gift coins must be less than <b><?php echo $minimum_gift_coins_value;?> </b></p>
					<p>*You can claim gift coins 5 times in a day.</p>
					<button type="submit" id="" name="" class="btn-upper btn btn-primary checkout-page-button" disabled>Request Coin Supplement</button>
					<?php } ?>
				</div>
				<!--</form>-->
				<style>
				.custom-table tr th{
					font-size: 14px;
				}
				.custom-table tr td{
					font-size: 14px;
					line-height:0 !important;
				}
			</style>
				<table id="example" class="table  data-table custom-table  table-striped"  cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Coins Value</th>
							<th>Coins Type </th>
							<!--<th>Contact no</th>-->
							<th>Coins Receive By</th>
							<th>Date</th>	
						</tr>
					</thead>
					<tbody>
						<?php $query12=mysqli_query($con,"select * from user_wallet where user_id='$id' ");
						$cnt=1;
						while($row12=mysqli_fetch_array($query12))
						{ 
							?>	
							<?php if($row12['coins_type'] =='gift_coins') { $pp = 'Gift Coins'; } else { $pp = 'Game Coins';} ?>
							<tr>
								<td><?php echo htmlentities($cnt);?></td>
								<td><?php echo htmlentities($row12['user_coins']);?></a></td>
								<td><?php echo $pp;?></td>
								<td><?php echo $row12['reason_mode_of_coins'];?></td>
								<td><?php echo htmlentities($row12['create_date']);?></td>
							</tr>					
							<?php $cnt=$cnt+1; } ?>				
						</tbody>				
					</table> 
				</div>	
				<!-- already-registered-login -->		
			</div>			
		</div>
		<!-- panel-body  -->
	</div><!-- row -->
</div>
<!-- checkout-step-03  -->
<div class="panel panel-default checkout-step-03">
	<div class="panel-heading">
		<h4 class="unicase-checkout-title">
			<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseThree">
				<span>3</span>Shipping Address
			</a>
		</h4>
	</div>
	<div id="collapseThree" class="panel-collapse collapse">
		<div class="panel-body">
			<form class="register-form1 coin-balance" name="shippinginfo" id="shippinginfo" role="form" method="post">
				<div class="row col-md-12 form-group">
					<div class="col-md-4">
						<label class="info-title" for="Shipping Address">Shipping Address<span>*</span></label>
					</div>
					<div class="col-md-8">
						<textarea class="form-control unicase-form-control text-input" " name="shippingaddress"><?php echo $row['shippingAddress'];?></textarea>
						<span class="help-block"></span>
					</div>
				</div>	
				<div class="row col-md-12 form-group">
					<div class="col-md-4">
					</div>
					<div class="col-md-8">
					</div>
				</div>
				<div class="row col-md-12 form-group">
					<div class="col-md-4">
						<label class="info-title" for="Billing State ">Shipping State  <span>*</span></label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control unicase-form-control text-input" id="shippingstate" name="shippingstate" value="<?php echo $row['shippingState'];?>" >
						<span class="help-block"></span>
					</div>
				</div>	
				<div class="row col-md-12 form-group">
					<div class="col-md-4">
						<label class="info-title" for="Billing City">Shipping City <span>*</span></label>
					</div>
					<div class="col-md-8"><input type="text" class="form-control unicase-form-control text-input" id="shippingcity" name="shippingcity" required="required" value="<?php echo $row['shippingCity'];?>" >
						<span class="help-block"></span>
					</div>
				</div>	
				<div class="row col-md-12 form-group">
					<div class="col-md-4"><label class="info-title" for="Billing Pincode">Shipping Pincode <span>*</span></label>
					</div>
					<div class="col-md-8"><input type="text" class="form-control unicase-form-control text-input" id="shippingpincode" name="shippingpincode" required="required" value="<?php echo $row['shippingPincode'];?>" >
						<span class="help-block"></span>
					</div>
				</div>	
				<?php $_SESSION["csrf_token_3"] = md5(rand(0,10000000)).time(); ?>
				<input type="hidden" name="csrf_token_3" value="<?php echo htmlspecialchars($_SESSION["csrf_token_3"]);?>">
				<button type="submit" name="billupdate" class="btn-upper btn btn-primary checkout-page-button">Update</button>
				<button type="reset" class="btn-upper btn btn-primary checkout-page-button" value="Cancel">Cancel</button>
			</form>
			<?php //$_SESSION["csrf_token_2"] = md5(rand(0,10000000)).time(); ?>
					  <!--<input type="hidden" name="csrf_token_2" value="<?php //echo htmlspecialchars($_SESSION["csrf_token_2"]);?>">
					  	<button type="submit" name="shipupdate" class="btn-upper btn btn-primary checkout-page-button">Update</button>-->
					  	<!--</form>-->
					  </div>
					</div>
				</div>
<!-- checkout-step-04  -->
<!--
<div class="panel panel-default checkout-step-04">
	<div class="panel-heading">
		<h4 class="unicase-checkout-title">
			<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapsefour">
			<span>4</span>Game History
			</a>
		</h4>
	</div>
	<div id="collapsefour" class="panel-collapse collapse">
		<div class="panel-body">
			<div class="row">		
				<div class="col-md-12 col-sm-12 already-registered-login coin-balance">
					<div class="row col-md-12 form-group">
						<?php
						//date_default_timezone_set('UTC');// change according timezone
						//$currentTime = date( 'Y-m-d H:i:s', time () );
					?>
				</div>
				<style>
				.custom-table tr th{
					font-size: 14px;
				}
				.custom-table tr td{
					font-size: 14px;
					line-height:0 !important;
				}
			</style>
				<table id="example" class="table  data-table custom-table  table-striped"  cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Game Name</th>
							<th>Game Date</th>
							<th>Winning No</th>
							<th>Total Bids</th>
							<th>Payout Amount</th>
							<th>Total Coins Won</th>	
						</tr>
					</thead>
					<tbody>
						// <?php
						// $data = $user_obj->get_game_history();
						// while($res=mysqli_fetch_array($data)) {
								// $game_id = $res['id'];
								// $game_name = $res['game_name'];
								// $game_start_time = $res['game_start_time'];
								// $winn_no = $res['winning_no'];
								// $winn_no1 = $res['game_wining_number1'];
								// $winn_no2 = $res['game_wining_number2'];
								// $winn_no3 = $res['game_wining_number3'];
								// $user_id = $_SESSION['id'];
						// /*Fetch payout amount  of game on winning no*/
						// $payout_amount = $user_obj->get_payout_amount_OnWin_no($game_id,$winn_no);
						// $cnt=1;
						
								// $total_bids = $user_obj->total_bids_byuser_onwinno($game_id,$winn_no,$user_id);
								// if($total_bids=='')
								// {
									// $total_bids ="00";
								// }
								// $total_coins_won = $payout_amount*$total_bids;
						// ?>	
							<tr>
								<td><?php //echo $game_name;?></td>
								<td><?php //echo $game_start_time;?></td>
								<td><?php //echo $winn_no;?></td>
								<td><?php //echo $total_bids;?></td>
								<td><?php //echo $payout_amount;?></td>
								<td><?php //echo $total_coins_won;?></td>
							</tr>					
							<?php //$cnt=$cnt+1; } ?>				
						</tbody>				
					</table> 
				</div>		
			</div>			
		</div>
	</div>
</div>
-->
		<!-- checkout-step-05  -->
<div class="panel panel-default checkout-step-05">
	<!-- panel-heading -->
	<div class="panel-heading">
		<h4 class="unicase-checkout-title">
			<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapsefive">
			<span>5</span>Your Checkout Progress
			</a>
		</h4>
	</div>
	<!-- panel-heading -->
	<div id="collapsefive" class="panel-collapse collapse">
		<!-- panel-body  -->
		<div class="panel-body">
			<div class="row">		
		<div class="col-md-12 col-sm-12 already-registered-login coin-balance">
		<div class="checkout-progress-sidebar ">
		<h3><a href="order-history.php">Order History</a></h3>
		<h3><a href="pending-orders.php">Payment Pending Order</a></h3>	
	    </div> 
		</div>	
				<!-- already-registered-login -->		
			</div>			
		</div>
		<!-- panel-body  -->

	</div><!-- row -->
</div>

		<!-- checkout-step-06  -->
<div class="panel panel-default checkout-step-06">
	<!-- panel-heading -->
	<div class="panel-heading">
		<h4 class="unicase-checkout-title">
			<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapsesix">
			<span>6</span>Auto Play Games
			</a>
		</h4>
	</div>
	<!-- panel-heading -->
	<div id="collapsesix" class="panel-collapse collapse">
		<!-- panel-body  -->
		<div class="panel-body">
			<div class="row">
			<?php  $query_345=mysqli_query($con,"select * from tbl_user_robot where user_id='$uid'");?>
			  <?php  while($row=mysqli_fetch_array($query_345)) {
				  $id = $row['id'];
					$bid_0 = $row['bid_0'];
					$bid_1 = $row['bid_1'];
					$bid_2 = $row['bid_2'];
					$bid_3 = $row['bid_3'];
					$bid_4 = $row['bid_4'];
					$bid_5 = $row['bid_5'];
					$bid_6 = $row['bid_6'];
					$bid_7 = $row['bid_7'];
					$bid_8 = $row['bid_8'];
					$bid_9 = $row['bid_9'];
					$bid_10 = $row['bid_10'];
					$bid_11 = $row['bid_11'];
					$bid_12 = $row['bid_12'];
					$bid_13 = $row['bid_13'];
					$bid_14 = $row['bid_14'];
					$bid_15 = $row['bid_15'];
					$bid_16 = $row['bid_16'];
					$bid_17 = $row['bid_17'];
					$bid_18 = $row['bid_18'];
					$bid_19 = $row['bid_19'];
					$bid_20 = $row['bid_20'];
					$bid_21 = $row['bid_21'];
					$bid_22 = $row['bid_22'];
					$bid_23 = $row['bid_23'];
					$bid_24 = $row['bid_24'];
					$bid_25 = $row['bid_25'];
					$bid_26 = $row['bid_26'];
					$bid_27 = $row['bid_27'];
					$status = $row['status'];
				} ?>
				<?php if($status!='')
				{?>
			<div style="width:100%">
				<?php $stylepopular= ''; $stylenotpopular= '';?>
				<?php 
				if($status==0)
				{
					$stylepopular= "style= display:none";
				}
				
				if($status==1)
				{
					$stylenotpopular= "style= display:none";
				}
				
				 ?>
				
				<div style="width:50%;"><img id="imgnotpopular<?php echo $id; ?>" onclick="funisactive(<?php echo $id; ?>,1)" src='images/off.png' width='60' <?php echo $stylenotpopular;?> /></div>
				<div style="width:50%;"><img id="imgpopular<?php echo $id; ?>" onclick="funisactive(<?php echo $id; ?>,0)" src='images/on.png'  width='60' <?php echo $stylepopular;?> /></div>
			</div>
				<?php }?>
			<h4>Set your pre fixed bid amount for all games</h4>
			
								<div class="alert alert-danger alert-dismissible" id="msg" style="display:none;width:100%;">
									<button type="button" class="close" data-dismiss="alert">×</button>
									Auto bid has been Inactive successfully!!
								</div>
								<div class="alert alert-success alert-dismissible" id="suc_msg" style="display:none;width:100%;">
									<button type="button" class="close" data-dismiss="alert">×</button>
									Auto bid has been active successfully!!
								</div>
								
		
		<div class="widget-content nopadding" style="width=100%">
          <form action="" method="post" name="default_payout_update" id="default_payout_update" class="form-horizontal">
		  <div class="controls" style="float:left; width:50%;margin-left:0px;">
			<label class="label_digit digit_img">0</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input"  min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount0" id="payout_amount0" placeholder="Enter Bid Amount" value="<?php if($bid_0) { echo $bid_0; } else {echo '1';}?>" />
			</div>
			<label class="label_digit digit_img">1</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0"  pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount1" id="payout_amount1" placeholder="Enter Bid Amount" value="<?php if($bid_1) { echo $bid_1; } else {echo '3';}?>" />
			</div>
			<label class="label_digit digit_img">2</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount2" id="payout_amount2" placeholder="Enter Bid Amount" value="<?php if($bid_2) { echo $bid_2; } else {echo '6';}?>" />
			</div>
			<label class="label_digit digit_img">3</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount3" id="payout_amount3" placeholder="Enter Bid Amount" value="<?php if($bid_3) { echo $bid_3; } else {echo '10';}?>" />
			</div>
			<label class="label_digit digit_img">4</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount4" id="payout_amount4" placeholder="Enter Bid Amount" value="<?php if($bid_4) { echo $bid_4; } else {echo '15';}?>" />
			</div>
			<label class="label_digit digit_img">5</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0"  pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount5" id="payout_amount5" placeholder="Enter Bid Amount" value="<?php if($bid_5) { echo $bid_5; } else {echo '21';}?>" />
			</div>
			<label class="label_digit digit_img">6</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount6" id="payout_amount6" placeholder="Enter Bid Amount" value="<?php if($bid_6) { echo $bid_6; } else {echo '28';}?>" />
			</div>
			<label class="label_digit digit_img">7</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount7" id="payout_amount7" placeholder="Enter Bid Amount" value="<?php if($bid_7) { echo $bid_7; } else {echo '36';}?>" />
			</div>
			<label class="label_digit digit_img">8</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount8" id="payout_amount8" placeholder="Enter Bid Amount" value="<?php if($bid_8) { echo $bid_8; } else {echo '45';}?>" />
			</div>
			<label class="label_digit digit_img">9</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount9" id="payout_amount9" placeholder="Enter Bid Amount" value="<?php if($bid_9) { echo $bid_9; } else {echo '55';}?>" />
			</div>
			<label class="label_digit digit_img">10</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount10" id="payout_amount10" placeholder="Enter Bid Amount" value="<?php if($bid_10) { echo $bid_10; } else {echo '63';}?>" />
			</div>
			<label class="label_digit digit_img">11</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount11" id="payout_amount11" placeholder="Enter Bid Amount" value="<?php if($bid_11) { echo $bid_11; } else {echo '69';}?>" />
			</div>
			<label class="label_digit digit_img">12</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount12" id="payout_amount12" placeholder="Enter Bid Amount" value="<?php if($bid_12) { echo $bid_12; } else {echo '73';}?>" />
			</div>
			<label class="label_digit digit_img">13</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount13" id="payout_amount13" placeholder="Enter Bid Amount" value="<?php if($bid_13) { echo $bid_13; } else {echo '75';}?>" />
			</div>
			
			</div>
			<div class="controls" style="float:right; width:50%;margin-left:0px;">
			<label class="label_digit digit_img">14</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount14" id="payout_amount14" placeholder="Enter Bid Amount" value="<?php if($bid_14) { echo $bid_14; } else {echo '75';}?>" />
			</div>
			<label class="label_digit digit_img">15</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount15" id="payout_amount15" placeholder="Enter Bid Amount" value="<?php if($bid_15) { echo $bid_15; } else {echo '73';}?>" />
			</div>
			<label class="label_digit digit_img">16</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount16" id="payout_amount16" placeholder="Enter Bid Amount" value="<?php if($bid_16) { echo $bid_16; } else {echo '69';}?>" />
			</div>
			<label class="label_digit digit_img">17</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount17" id="payout_amount17" placeholder="Enter Bid Amount" value="<?php if($bid_17) { echo $bid_17; } else {echo '63';}?>" />
			</div>
			<label class="label_digit digit_img">18</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount18" id="payout_amount18" placeholder="Enter Bid Amount" value="<?php if($bid_18) { echo $bid_18; } else {echo '55';}?>" />
			</div>
			<label class="label_digit digit_img">19</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount19" id="payout_amount19" placeholder="Enter Bid Amount" value="<?php if($bid_19) { echo $bid_19; } else {echo '45';}?>" />
			</div>
			<label class="label_digit digit_img">20</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount20" id="payout_amount20" placeholder="Enter Bid Amount" value="<?php if($bid_20) { echo $bid_20; } else {echo '36';}?>" />
			</div>
			<label class="label_digit digit_img">21</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount21" id="payout_amount21" placeholder="Enter Bid Amount" value="<?php if($bid_21) { echo $bid_21; } else {echo '28';}?>" />
			</div>
			<label class="label_digit digit_img">22</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount22" id="payout_amount22" placeholder="Enter Bid Amount" value="<?php if($bid_22) { echo $bid_22; } else {echo '21';}?>" />
			</div>
			<label class="label_digit digit_img">23</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount23" id="payout_amount23" placeholder="Enter Bid Amount" value="<?php if($bid_23) { echo $bid_23; } else {echo '15';}?>" />
			</div>
			<label class="label_digit digit_img">24</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0"  pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount24" id="payout_amount24" placeholder="Enter Bid Amount" value="<?php if($bid_24) { echo $bid_24; } else {echo '10';}?>" />
			</div>
			<label class="label_digit digit_img">25</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount25" id="payout_amount25" placeholder="Enter Bid Amount" value="<?php if($bid_25) { echo $bid_25; } else {echo '6';}?>" />
			</div>
			<label class="label_digit digit_img">26</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount26" id="payout_amount26" placeholder="Enter Bid Amount" value="<?php if($bid_26) { echo $bid_26; } else {echo '3';}?>" />
			</div>
			<label class="label_digit digit_img">27</label>
			<div class="controls">
            <input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" maxlength="5" name="payout_amount27" id="payout_amount27" placeholder="Enter Bid Amount" value="<?php if($bid_27) { echo $bid_27; } else {echo '1';}?>" />
			</div>
			
			</div>
          
			<div class="controls"  style="float:left; width:100%;margin-left:550px;">
				<button type="subbtn" name="subbtn" id="btn" class="btn-upper btn btn-primary checkout-page-button">Update</button>
			</div>
		   <?php $_SESSION["csrf_token_1234"] = md5(rand(0,10000000)).time(); ?>
		   <input type="hidden" name="csrf_token_1234" value="<?php echo htmlspecialchars($_SESSION["csrf_token_1234"]);?>">
          </form>
		 
        </div>
		<?php //}?>
			</div>			
		</div>
		<!-- panel-body  -->

	</div><!-- row -->
</div>
			</div><!-- /.checkout-steps -->
		</div>
	</div><!-- /.row -->
</div><!-- /.checkout-box -->
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
<!-- Container Selection -->
<div id="dropDownSelect1"></div>
<div id="dropDownSelect2"></div>
<?php require_once('templates/common_js.php');?>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/additional-methods_new.js"></script>
<!-- jQuery Form Validation code -->
<script type="text/javascript"> 
	$(document).ready(function(){
		$.validator.addMethod('filesize', function (value, element, arg) {
            var minsize=1000; // min 1kb
            if((value>minsize)&&(value<=arg)){
            	return true;
            }else{
            	return false;
            }
        });
	$.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0; 
}, "No space please");
 // Setup form validation on the #register-form element
 $("#editprofile").validate({
 	submitHandler : function(e) {
 		$(form).submit();
 	},
        // Specify the validation rules
        rules : {
        	name : {
        		required : true
        	},
        	nick_name : {
				//required : true,
				noSpace: true
				/*remote: {
					url: "check-nickname.php",
					type: "post",
					data: {
						nick_name: function() {
							return $( "#nick_name" ).val();
						}
					}
				}*/
			},
			/*email : {
				required : true,
				email: true,
			},

			contactno : {
				minlength:10,
				maxlength:10,
				digits: true
			},*/
			user_image:{
                    //required:false,
                    accept:"image/jpg,image/jpeg,image/png"
					//filesize: 200000   //max size 200 kb

				}
			},
        // Specify the validation error messages
        messages: {
        	name : {
        		required : "Please enter name"
        	},
			/*nick_name : {
				remote : "Nick Name already exists"
			},*/
        	user_image:{

        		accept:"Please upload .jpg or .png or .jpeg file of notice."
                   // required:"Please upload file.",
					//filesize:" file size must be less than 200 KB."
				},
			/*email : {
				required : "Please enter email",
			},*/
		},
		errorPlacement : function(error, element) {
			$(element).closest('div').find('.help-block').html(error.html());
		},
		highlight : function(element) {
			$(element).closest('div').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).closest('div').removeClass('has-error').addClass('has-success');
			$(element).closest('div').find('.help-block').html('');
		}
	});
 /*Shiping info form validation*/
 $("#shippinginfo").validate({
 	submitHandler : function(e) {
 		$(form).submit();
 	},
        // Specify the validation rules
        rules : {
        	shippingaddress : {
        		required : true
        	},
        	shippingstate : {
        		required : true,

        	},
        	shippingcity : {
        		required : true,

        	},
        	shippingpincode : {
        		minlength:5,
        		digits: true
        	}
        },
        // Specify the validation error messages
        messages: {
        	shippingaddress : {
        		required : "Please enter shipping address"
        	},
        	shippingstate : {
        		required : "Please enter shipping state",
        	},
        	shippingcity : {
        		required : "Please enter shipping city",
        	},
        	shippingpincode : {
        		required : "Please enter shipping pincode",
        	},
        },
        errorPlacement : function(error, element) {
        	$(element).closest('div').find('.help-block').html(error.html());
        },
        highlight : function(element) {
        	$(element).closest('div').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
        	$(element).closest('div').removeClass('has-error').addClass('has-success');
        	$(element).closest('div').find('.help-block').html('');
        }
    });
});
</script>
<script  src="js/custome/allow_numbers.js"></script>
<script src="admin/js/jquery.dataTables.min.js"></script> 
<script src="admin/js/matrix.js"></script> 
<script src="admin/js/matrix.tables.js"></script>
<script>
	$(document).ready(function(){
		setTimeout(function() {
			$('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
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
							jq("#msg").html(data);
						 window.setTimeout(function(){location.reload()},3000);
					}
				});		
			});
	});
</script>
<script>
	//var jt = $.noConflict();
function funisactive(id,status)
{
	var uid= '<?php echo $uid?>';
	$.ajax({  
	 type: "POST",  
	 url: "change_active.php",  
	 data: "id=" + id + "& status=" + status + "& uid=" + uid,  
	 success: function(rr){  
	 //alert(rr);
		//success (not finished)
		if(status=='1')
		{
		document.getElementById('imgnotpopular'+id).style.display='none';
		document.getElementById('imgpopular'+id).style.display='block';
		}
		else
		{
		document.getElementById('imgnotpopular'+id).style.display='block';
		document.getElementById('imgpopular'+id).style.display='none';
		}
		if(rr=='0')
		{
		$('#msg').show();
		$('#suc_msg').hide();
		}
		if(rr=='1')
		{
		$('#suc_msg').show();
		$('#msg').hide();
		}
		//window.setTimeout(function(){location.reload()},1000);
		}  
	 });  
  return false;
}
</script>
</body>
</html>