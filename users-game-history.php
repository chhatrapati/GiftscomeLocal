<?php
session_start();
error_reporting(0);
include('includes/config.php');
$user_obj = new Cl_User();
$game_id=toInternalId($_GET['game']);
?>
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
	<title>Game History</title>
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	
	<!-- Customizable CSS -->
	
<?php require_once('templates/common_css.php');?>
<?php require_once('templates/datatable_css.php');?>
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
<body class="animsition" style="font-family:Poppins-regular!important;">
<?php require_once('templates/header.php');?>
<?php
/*Fetch winning no by game id.*/
$dataresult = $user_obj->get_winno_by_gameid($game_id);
$game_name =$dataresult['game_name'];
$winning_no =$dataresult['winning_no'];
?>
	<!-- ============================================== HEADER : END ============================================== -->
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
		<h2 style="color:#fff;">
			<?php echo $game_name;?>
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
						
<!-- checkout-step-02  -->
<div class="panel panel-default checkout-step-02">
	<!-- panel-heading -->
	<div class="panel-heading">
		<h4 class="unicase-checkout-title">
			<a data-toggle="collapse" class="collapsed in" data-parent="#accordion" href="#collapseOne">
			<span>1</span>Game History By Users
			</a>
		</h4>
	</div>
	<!-- panel-heading -->
	<div id="collapseOne" class="panel-collapse collapse in">
		<!-- panel-body  -->
		<div class="panel-body" style="padding:0!important">
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
				<table id="example" class="display nowrap"  cellspacing="0" width="100%">
					<thead class="u_g_h">
						<tr >
							<th>#</th>
							<th>Winning no</th>
							<th>User Name</th>
							<th>Total Bids</th>
							<th>Payout Amount</th>
							<th>Total Coins Won</th>	
						</tr>
					</thead>
					<tbody>

						<?php
						/*Fetch users list - by winning no on game.*/
						$data = $user_obj->get_users_by_winno($game_id,$winning_no);
						$rowcount=mysqli_num_rows($data);
						/*Fetch payout amount  of game on winning no*/
						$payout_amount = $user_obj->get_payout_amount_OnWin_no($game_id,$winning_no);
						if($rowcount<=0)
						{?>
							<tr>
								<td class="t_gz_h">1</td>
								<td class="t_gz_h"><?php echo $winning_no;?></td>
								<td class="t_gz_h">--</td>
								<td class="t_gz_h">0</td>
								<td class="t_gz_h"><?php echo $payout_amount;?></td>
								<td class="t_gz_h">0</td>
							</tr>	
							
						<?php } ?>
						<?php $cnt=1;
						while($res=mysqli_fetch_array($data)) {
								$user_id = $res['user_id'];
								$bid_amount = $res['bid_amount'];
								$bid_no = $res['bid_no'];
								/*Fetch total no of bids placed by user on winning no of game*/
								$total_bids = $user_obj->total_bids_byuser_onwinno($game_id,$winning_no,$user_id);
								$total_coins_won = $payout_amount*$total_bids;
								/*Fetch user name by user id*/
								$user_details = $user_obj->user_name_byid($user_id);
								$result52=mysqli_fetch_array($user_details); //print_r($result99);
								$user_name =$result52['name'];
								$nick_name =$result52['nick_name'];
						?>	
							<tr>
								<td class="t_gz_h"><?php echo htmlentities($cnt);?></td>
								<td class="t_gz_h"><?php echo $bid_no;?></td>
								<td class="t_gz_h"><?php echo $nick_name;?></td>
								<td class="t_gz_h"><?php echo $total_bids;?></td>
								<td class="t_gz_h"><?php echo $payout_amount;?></td>
								<td class="t_gz_h"><?php echo $total_coins_won;?></td>
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
<!-- jQuery Form Validation code -->
<?php require_once('templates/datatable_js.php');?>
<?php require_once('templates/chat_script_forconflict.php');?>
<script>
	$(document).ready(function(){
		setTimeout(function() {
			$('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
	});
</script>
</body>
</html>