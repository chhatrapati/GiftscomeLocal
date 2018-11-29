<?php
session_start();
error_reporting(0);
include('includes/config.php');
$user_obj = new Cl_User();
if(strlen($_SESSION['login'])==0)
{   
	header('location:login.php');
}

if(isset($_POST['update']) && $_SESSION["csrf_token"] == $_POST['csrf_token'])
{
	$name=$_POST['name'];
	if($_POST['nick_name']!='') {$nick_name=$_POST['nick_name']; } else {$nick_name=$_POST['nick_name_old'];}
	$gender=$_POST['gender'];
	$email=$_POST['email'];
	$contactno=$_POST['contactno'];
	$user_picture = $_FILES['user_image']['name'];
	$tmp_user_picture = $_FILES['user_image']['tmp_name'];
	if(is_uploaded_file($tmp_user_picture))
	{
		move_uploaded_file($tmp_user_picture,"./users-images/$user_picture");
		$query=mysqli_query($con,"update users set name='$name',gender='$gender',email='$email',nick_name='$nick_name',contactno='$contactno',user_picture='$user_picture' where id='".$_SESSION['id']."'");
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

	/*if(isset($_POST['req_to_admin']) && $_SESSION["csrf_token_1"] == $_POST['csrf_token_1']){
		//echo 'ppp'; die();
			$user_obj->coins_by_request_to_admin();
			 $_SESSION['msg'] ='You have received coins';
			}*/
			if(!isset($_SESSION['counter'])) {
				$_SESSION['counter'] = 0;
			}
			if(isset($_POST['req_to_admin'])){
				++$_SESSION['counter'];
				if($_SESSION['counter']=='5')
				{
					echo 'hi';
				}
		//echo 'ppp'; die();
			//$user_obj->coins_by_request_to_admin();
			 //$_SESSION['msg'] ='You have received coins';
			}

date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

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
								<div class="" id="msg" style="font-color:red;">
								</div>

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
														$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
$row = mysqli_fetch_array($query); //echo '<pre>'; print_r($row);
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
		<?php  $_SESSION['login_userpic']=$row['user_picture'];?>
		</div>
		<div class="col-md-8">
			<span class="help-block"></span>
			<?php  $pic = $row['user_picture'];
			      if (strpos($pic, 'https') !== false) {?>
						<img src="<?php echo $row['user_picture'];?>"  width="100px" height="100px">
			<?php } else {?>
			<img src="users-images/<?php echo $row['user_picture'];?>"  width="100px" height="100px">
			<?php }?>
			<?php if($row['user_picture'] == ""){ ?>
				<img src="users-images/user.png" width="100px" height="100px">
				<?php //echo $_SESSION['login_userpic']=$row['user_picture'];?>
				<?php }?><br>
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
						$ss=  mysqli_query($con,"SELECT COUNT(1) FROM user_wallet  WHERE create_date >= DATE_SUB(NOW(), INTERVAL 1 DAY) AND user_id='$id'");
						$result_data = mysqli_fetch_assoc($ss);
						$no_of_login = $result_data['COUNT(1)'];
					//echo '<pre>';print_r($result_data); echo $no_of_login; if($no_of_login > 1) {echo 'greater';} else { echo 'no';}die();
						$sql12=  mysqli_query($con,"select * from coins_supplement where user_type='$user_type'")or die(mysqli_error());
					$data123=mysqli_fetch_array($sql12,MYSQLI_ASSOC); //echo '<pre>';print_r($data123); 
					$minimum_gift_coins_value = $data123['minimum_gift_coins_value'];
					?>
					<?php if(($gift_coins_balance >= $minimum_gift_coins_value) AND ($no_of_login < 1) ) {?>
					<p>You can request gift coins 5 times a day.</p>
					<button type="submit" id="addMe" name="req_to_admin" class="btn-upper btn btn-primary checkout-page-button">Request Coin Supplement</button>

					<?php $_SESSION["csrf_token_1"] = md5(rand(0,10000000)).time(); ?>
					<input type="hidden" name="csrf_token_1" value="<?php echo htmlspecialchars($_SESSION["csrf_token_1"]);?>">
					<div id="theCount"></div>
					<input type="hidden" id="hiddenVal" value="0">
					<?php } else { ?>
					<p>Note: To claim supplement coins your gift coins must be less than <b><?php echo $minimum_gift_coins_value;?> </b></p>
					<p>Note: You can claim gift coins only once in a day after login to your account.</p>
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
<div class="panel panel-default checkout-step-04">
	<!-- panel-heading -->
	<div class="panel-heading">
		<h4 class="unicase-checkout-title">
			<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapsefour">
			<span>4</span>Game History
			</a>
		</h4>
	</div>
	<!-- panel-heading -->
	<div id="collapsefour" class="panel-collapse collapse">
		<!-- panel-body  -->
		<div class="panel-body">
			<div class="row">		
				<div class="col-md-12 col-sm-12 already-registered-login coin-balance">
				
					
					<div class="row col-md-12 form-group">
						<?php
						date_default_timezone_set('UTC');// change according timezone
						$currentTime = date( 'Y-m-d H:i:s', time () );
					?>
					
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
							<th>Game Name</th>
							<th>Game Date</th>
							<th>Winning No</th>
							<th>Total Bids</th>
							<th>Payout Amount</th>
							<th>Total Coins Won</th>	
						</tr>
					</thead>
					<tbody>

						<?php
						$data = $user_obj->get_game_history();
						while($res=mysqli_fetch_array($data)) {
								$game_id = $res['id'];
								$game_name = $res['game_name'];
								$game_start_time = $res['game_start_time'];
								$winn_no = $res['winning_no'];
								$winn_no1 = $res['game_wining_number1'];
								$winn_no2 = $res['game_wining_number2'];
								$winn_no3 = $res['game_wining_number3'];
								$user_id = $_SESSION['id'];
						
						
						/*Fetch payout amount  of game on winning no*/
						$payout_amount = $user_obj->get_payout_amount_OnWin_no($game_id,$winn_no);
						$cnt=1;
						
								$total_bids = $user_obj->total_bids_byuser_onwinno($game_id,$winn_no,$user_id);
								if($total_bids=='')
								{
									$total_bids ="00";
								}
								$total_coins_won = $payout_amount*$total_bids;
								
								
						?>	
							<tr>
								
								<td><?php echo $game_name;?></td>
								<td><?php echo $game_start_time;?></td>
								<td><?php echo $winn_no;?></td>
								<td><?php echo $total_bids;?></td>
								<td><?php echo $payout_amount;?></td>
								<td><?php echo $total_coins_won;?></td>
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

		$("#addMe").click(function(){
			var counter = parseInt($("#hiddenVal").val());
			counter++;
			$("#hiddenVal").val(counter);
			$("#theCount").text(counter);
				//var name = $("#name").val();
				//var email = $("#email").val();
				var name = 'preet';
				var name1= 'mtharu';
				var dataString = 'name='+ name + '&name1='+ name1;
				if(counter=='5')
				{
					$.ajax({
						url : 'coins_supplement.php', 
						type : 'post',
						data: dataString,
						success : function(data){
							$("#msg").html(data);
						//(#successMessage).html(data);
						//$_SESSION['msg'] ='You have received coins';
						//document.getElementById("successMessage").innerHTML  = 'You have received coins';
						
					}
				});
					document.getElementById("addMe").disabled = true;


				}
			});

	});
</script>
</body>
</html>