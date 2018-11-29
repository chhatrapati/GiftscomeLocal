<?php
session_start();
include('includes/config.php');
$user_obj = new Cl_User();
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
<meta name="keywords" content="">
<meta name="robots" content="all">
<title>Game History</title>
<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!-- Customizable CSS -->	
<?php require_once('templates/common_css.php');?>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/main.css">
<?php require_once('templates/datatable_css.php');?>
</head>
<body class="animsition" style="font-family:Poppins-regular!important;">
	<?php require_once('templates/header.php');?>
	<!-- ============================================== HEADER : END ============================================== -->
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
		<h2 style="color:#fff;">Game History</h2>
	</section>
	<section class="bgwhite">
		<div class="container">
			<div class="body-content outer-top-bd">
				<div class="container">
					<div class="checkout-box inner-bottom-sm">
						<div class="row">
							<div class="col-md-12">
								<div class="panel-group checkout-steps" id="accordion">
						
<!-- checkout-step-02  -->
<div class="panel panel-default checkout-step-02">
		<!-- panel-body  -->
		<div class="panel-body" style="padding:0!important;">
			<div class="row">		
				<div class="col-md-12 col-sm-12 already-registered-login coin-balance">
				
					
					<div class="row col-md-12 form-group">
						<?php
						date_default_timezone_set('UTC');// change according timezone
						$currentTime = date( 'Y-m-d H:i:s', time () );
					?>
					
				</div>
				<!---<table id="example" class="table  data-table custom-table "  cellspacing="0" width="100%">-->
				<table id="example" class="display nowrap"  cellspacing="0" width="100%">
					<thead class="u_g_h">
						<tr>
							<th>#</th>
							<th>Game Name</th>
							<th>Date</th>
							<th>Winning no</th>
							<th>Total Bids</th>
							<th>Total Coins Won</th>	
						</tr>
					</thead>
					<tbody>

						<?php
						/*Fetch game history- winning no, total bids etc.*/
						$data = $user_obj->get_game_history();
						$cnt=1;
						while($res=mysqli_fetch_array($data)) {
								$game_id = $res['id'];
								$game_name = $res['game_name'];
								$game_start_time = $res['game_start_time'];
								$winn_no = $res['winning_no'];
								$winn_no1 = $res['game_wining_number1'];
								$winn_no2 = $res['game_wining_number2'];
								$winn_no3 = $res['game_wining_number3'];
								$total_bids = $res['total_bids'];
								$toal_coins_won = $res['total_won_coins'];
								/*Fetch total no of bids on game*/
								if($total_bids=='')
								{
									$total_bids ="0";
								}
								if($toal_coins_won=='')
								{
									$toal_coins_won ="-";
								}
						?>	
							<tr>
								<td class="t_gz_h"><?php echo htmlentities($cnt);?></td>
								<td class="t_gz_h"><a href="users-game-history.php?game=<?php echo toPublicId($game_id);?>"><?php echo $game_name;?></a></td>
								<td class="t_gz_h"><?php $create_date = $game_start_time; echo date('d-M-y h:i',strtotime($create_date));?></td>
								<td class="t_gz_h">
								<?php if($winn_no!=''){?>
								<?php echo $winn_no1;?> + <?php echo $winn_no2;?> + <?php echo $winn_no3;?> = <?php echo $winn_no;?>
								<?php } else {?>
								-
								<?php }?>
								</td>
								<td class="t_gz_h"><?php echo $total_bids;?></td>
								<td class="t_gz_h"><?php echo $toal_coins_won;?></td>
							</tr>					
							<?php $cnt=$cnt+1; } ?>				
						</tbody>				
					</table> 
				</div>	
				<!-- already-registered-login -->		
			</div>			
		</div>
		<!-- panel-body  -->
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
<?php require_once('templates/datatable_js.php');?>
<script src="js/jquery-1.11.1.min.js"></script>
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