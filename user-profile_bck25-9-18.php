<?php
session_start();
//error_reporting(0);
include('includes/config.php');
$user_obj = new Cl_User();
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
       <title>User Profile</title>
	   <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<?php require_once('templates/common_css.php');?>	
<!--===============================================================================================-->
       <!-- Customizable CSS -->
	    <link rel="stylesheet" href="assets/css/main.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
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
span.DataTables_sort_icon.css_right.ui-icon {height:0 !important;}
a.fg-button.ui-button.ui-state-default.ui-state-disabled {opacity:1.0 !important;}
.badge-warning {color: #111!important; background-color: #ffc107!important;}
.badge-info { color: #fff!important; background-color: #17a2b8!important;}
.dataTables_length {
    color: #878787;
    margin: 20px 14px 5px 0;
    position: relative;
    left: 5px;
    width: 50%;
    top: 0px;
}
.badge-success { color: #fff; background-color: #28a745 !important;}
</style>
</head>
<body class="animsition">
<?php require_once('templates/header.php');?>
<!-- ============================================== HEADER : END ============================================== -->
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
		<h2 class="l-text2 t-center">
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
				
		
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	<!-- panel-heading -->
		<div class="panel-heading">
    	<h4 class="unicase-checkout-title">
	        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
	          <span>1</span>Profile
	        </a>
	     </h4>
    </div>
    <!-- panel-heading -->

	<div id="collapseOne" class="panel-collapse collapse show">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">

<h4>Personal info</h4>
				<div class="col-md-12 col-sm-12 already-registered-login">

				 <table class="table table-bordered"  cellspacing="0" width="100%">
              <thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Profile Picture</th>
											<th>Gift Coins</th>
										</tr>
			</thead>
              <tbody>
									<?php
                                    $uid=toInternalId($_GET['user']);
									if($_GET['user'])
									{
									$query=mysqli_query($con,"select * from users where id = '".$uid."'");
									}
									/*When user comes from chat box user link*/
									else if($_GET['uname'])
									{
									$uname = $_GET['uname'];
									$qu=mysqli_query($con,"select id from users where username = '".$uname."'");
									$res_data=mysqli_fetch_array($qu);
									$uid = $res_data['id'];
									$query=mysqli_query($con,"select * from users where id = '".$uid."'");
									}
									/*End When user comes from chat box user link*/
									$cnt=1;
									while($row=mysqli_fetch_array($query))
									{//echo '<pre>';print_r($row);
										
									?>
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											
											<td><?php echo htmlentities($row['name']);?></td>
											<td>
											<?php if($row['social_id']!=''){?>
											<img src="<?php echo $row['user_picture'];?>"  width="100px" height="100px">
											<?php } else {
												if($row['user_picture'] == ""){ ?>
												<img src="users-images/user.png" width="100px" height="100px">
												<?php }else {?>
												<img src="users-images/<?php echo $row['user_picture'];?>" width="100px" height="100px">
												<?php  $_SESSION['login_userpic']=$row['user_picture'];?>
												<?php }}?>
											</td>									
											<td><?php echo number_format(htmlentities($row['gift_coins']));?></td>
										<?php $cnt=$cnt+1; } ?>
										</tr>
										
				</tbody>			
            </table>	
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
	        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
	          <span>2</span>Coins Transactions
	        </a>
	     </h4>
    </div>
    <!-- panel-heading -->
	<div id="collapseTwo" class="panel-collapse collapse">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		
				<div class="col-md-12 col-sm-12 already-registered-login">
					
					<table id="example" class="table table-bordered data-table"  cellspacing="0" width="100%">
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
									<?php //$uid=$_GET['id']; 
									$query12=mysqli_query($con,"select * from user_wallet where user_id='$uid' ");
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
<div class="panel panel-default checkout-step-04">
	<!-- panel-heading -->
	<div class="panel-heading">
		<h4 class="unicase-checkout-title">
			<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapsefour">
			<span>3</span>Game History
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
				<table id="example" class="table table-bordered data-table"  cellspacing="0" width="100%">
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
						//$data = $user_obj->get_game_history();
						$data12=mysqli_query($con, "SELECT game_id FROM tbl_userbids WHERE user_id='$uid' group by game_id");
						while($res_12=mysqli_fetch_array($data12)) {
							$id_game =$res_12['game_id'];
						$data=mysqli_query($con, "select * from tbl_game  WHERE game_status ='3' AND id='$id_game' order by id desc limit 100");
						while($res=mysqli_fetch_array($data)) {
								$game_id = $res['id'];
								$game_name = $res['game_name'];
								$game_start_time = $res['game_start_time'];
								$winn_no = $res['winning_no'];
								$winn_no1 = $res['game_wining_number1'];
								$winn_no2 = $res['game_wining_number2'];
								$winn_no3 = $res['game_wining_number3'];
								$user_id =  $uid;
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
						<?php $cnt=$cnt+1; }} ?>				
						</tbody>				
					</table> 
				</div>	
				<!-- already-registered-login -->		
			</div>			
		</div>
		<!-- panel-body  -->
	</div><!-- row -->
</div>
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
<?php require_once('templates/chat_script_forconflict.php');?>
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
</body>
</html>