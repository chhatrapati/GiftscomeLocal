<?php
session_start();
error_reporting(1);
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
	<meta name="keywords" content="MediaCenter, Template, eCommerce">
	<meta name="robots" content="all">
	<title>Game Zone</title>
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
}
 
</style>
</head>
<body class="animsition" style="font-family:Poppins-regular!important;">
	<?php require_once('templates/header.php');?>
	<!-- ============================================== HEADER : END ============================================== -->
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
		<h2 style="color:#fff;">
			Game Zone
		</h2>
	</section>
	<section class="bgwhite">
		<div class="container" style="padding:0px;">
			<div class="body-content outer-top-bd">
				<div class="container" style="padding:0px;">
					<div class="checkout-box inner-bottom-sm">
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="panel-group checkout-steps" id="accordion">
						
<!-- checkout-step-02  -->
<div class="panel panel-default checkout-step-02">
	<!-- panel-heading -->
	<div class="panel-heading">
		<h4 class="unicase-checkout-title">
			<a data-toggle="collapse" class="collapsed in" data-parent="#accordion" href="#collapseOne">
			<span>1</span>Game Zone
			</a>
		</h4>
	</div>
	<!-- panel-heading -->
	<div id="collapseOne" class="panel-collapse collapse in">
		<!-- panel-body  -->
		<div class="panel-body" style="padding:0 !important;">
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
	<table id="example" class="table data-table table-striped"  cellspacing="0" width="100%">
			  <!-- <table class="table"> -->
   		<thead class="u_g_h">						<tr>
							<th>#</th>
							<th>Game Name</th>
							<th>Date</th>
							<th>Winning no</th>
							<th>Total Bids</th>
							<th>Total Coins Won</th>	
						</tr>
					</thead>
					<tbody class="text-left">

						<?php
						/*Fetch game history- winning no, total bids etc.*/
						$data = $user_obj->latest_games();
						//print_r($data);
						$cnt=1;
						while($res=mysqli_fetch_array($data)) {
								$game_id = $res['id'];
								$game_name = $res['game_name'];
								$game_start_time = $res['game_start_time'];
								$game_duration = $res['game_duration'];
								$winn_no = $res['winning_no'];
								$winn_no1 = $res['game_wining_number1'];
								$winn_no2 = $res['game_wining_number2'];
								$winn_no3 = $res['game_wining_number3'];
								$game_status = $res['game_status'];
								$total_bids = $res['total_bids'];
								$toal_coins_won = $res['total_won_coins'];
								if($total_bids=='')
								{
									$total_bids ="0";
								}
								if($toal_coins_won=='')
								{
									$toal_coins_won ="-";
								}
								
								if($game_status==0){ 
									?>
									
								<tr>
								<td class="t_gz_f"><?php echo htmlentities($cnt);?></td>
								<td class="t_gz_f"><a href="play_game.php?game=<?php echo toPublicId($game_id);?>"><?php echo $game_name;?></a></td>
								<td class="t_gz_f"><?php $create_date = $game_start_time; echo date('d-M-y h:i',strtotime($create_date));?></td>
								<td class="t_gz_f">
							     --
								</td>
								<td class="t_gz_f"><?php echo $total_bids;?></td>
								<td class="t_gz_f"><button  onClick="window.open('play_game.php?game=<?php echo toPublicId($game_id);?>','_self');" style="color:red;">
         							<i class="fa far  fa-spinner" aria-hidden="true" style="padding-right:10px "></i>Starting Soon</button></td>

							</tr>
						<?php }  if($game_status==1){
									?>
								<tr>
								<td class="t_gz_c"><?php echo htmlentities($cnt);?></td>
								<td class="t_gz_c"><a href="play_game.php?game=<?php echo toPublicId($game_id);?>"><?php echo $game_name;?></a></td>
								<td class="t_gz_c"><?php $create_date = $game_start_time; echo date('d-M-y h:i',strtotime($create_date));?></td>
								<td class="t_gz_c">
								 --
								</td>
								<td class="t_gz_c"><?php echo $total_bids;?></td>
								<td class="t_gz_c"><button class="faa-pulse animated" onClick="window.open('play_game.php?game=<?php echo toPublicId($game_id);?>','_self');">
         							<i class="fa far fa-play" aria-hidden="true" style="padding-right:10px "></i>PLAYNOW</button></td>
							</tr>
						<?php }  if($game_status==3){ ?>	

							<tr>
								<td class="t_gz"><?php echo htmlentities($cnt);?></td>
								<td class="t_gz"><a href="play_game.php?game=<?php echo toPublicId($game_id);?>"><?php echo $game_name;?></a></td>
								<td class="t_gz"><?php $create_date = $game_start_time; echo date('d-M-y h:i',strtotime($create_date));?></td>
								<td class="t_gz">
								<?php if($winn_no==''){?>
								<?php } else {?>
								<?php echo $winn_no1;?> + <?php echo $winn_no2;?> + <?php echo $winn_no3;?> = <?php echo $winn_no;?>
								<?php }?>
								</td>
								<td class="t_gz"><?php echo $total_bids;?></td>
								<td class="t_gz"><?php echo $toal_coins_won;?></td>
							</tr>					
							<?php } 							
							$cnt=$cnt+1; 
						} //End While ?>				
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
<?php
/* Count all record from game table*/
$query345 = "SELECT * FROM tbl_game";
$result345 = mysqli_query($con, $query345) or die(mysqli_error($con));
$rowcount=mysqli_num_rows($result345);
?>
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
<script src="admin/js/jquery.dataTables.min.js"></script> 
<script src="admin/js/matrix.js"></script> 
<script src="admin/js/matrix.tables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	window.setInterval(function(){
	//alert(rowcount_old);
      location.reload();
        }, 30000);  // Change Interval here to test. For eg: 5000 for 5 sec
});
</script>
</body>
</html>