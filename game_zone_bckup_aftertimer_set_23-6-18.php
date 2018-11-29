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
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.css'>
	
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
			<a data-toggle="collapse" class="collapsed in" data-parent="#accordion">
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
	<table id="example" class="table table-striped"  cellspacing="0" width="100%">
			  <!-- <table class="table"> -->
   		<thead class="u_g_h">						<tr>
							<th>#</th>
							<th>Game Name</th>
							<th>Date</th>
							<th>Winning no</th>
							<th>Total Bids</th>
							<th>Total Coins Won</th>
							<th>Status</th>							
						</tr>
					</thead>
					<tbody class="text-left">

						<?php
						date_default_timezone_set('UTC');
						/*Fetch game history- winning no, total bids etc.*/
						$data = $user_obj->latest_games();
						//print_r($data);
						$cnt=1;
						while($res=mysqli_fetch_array($data)) {
								$game_id = $res['id'];
								
			                 $currentTime = date( 'Y-m-d H:i:s', time () );
			//echo 'Cureent time is: 	'.$currentTime = date( 'Y-m-d H:i:s', time () );
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
								<td class="t_gz_f"><?php echo $toal_coins_won;?></td>
								<td class="t_gz_f"><button  onClick="window.open('play_game.php?game=<?php echo toPublicId($game_id);?>','_self');" style="color:red;">
         							<i class="fa far  fa-spinner" aria-hidden="true" style="padding-right:10px "></i>Starting Soon</button></td>

							</tr>
						<?php }  if($game_status==1){
							$create_date = $game_start_time; date('d-M-y h:i',strtotime($create_date));
							$end_date = date('Y-m-d H:i:s',strtotime('+'.$game_duration.' minutes',strtotime($create_date)));
							//$end_date = date('h:i:s',strtotime($end_date));
									?>
								<tr>
								<td class="t_gz_c"><?php echo htmlentities($cnt);?></td>
								<td class="t_gz_c"><a href="play_game.php?game=<?php echo toPublicId($game_id);?>"><?php echo $game_name;?></a></td>
								<td class="t_gz_c"><?php $create_date = $game_start_time; echo date('d-M-y h:i',strtotime($create_date));?></td>
								<td class="t_gz_c">
								 --
								</td>
								<td class="t_gz_c"><?php echo $total_bids;?></td>
								<td class="t_gz_c"><?php echo $toal_coins_won;?></td>
								<td class="t_gz_c"><button class="faa-pulse animated" onClick="window.open('play_game.php?game=<?php echo toPublicId($game_id);?>','_self');">
         							<i class="fa far fa-play" aria-hidden="true" style="margin-top:10px;" ></i>&nbsp;&nbsp;PLAY NOW</button><div class="clock" id="countdown1" style="height:6px;width:180px;left:115px;bottom:5px;"></div></td>
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
								<td class="t_gz"><i class="fa far  fa-trophy" aria-hidden="true" style="padding-right:10px "></i><a href="play_game.php?game=<?php echo toPublicId($game_id);?>">See Result</a></button></td>
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
$query345 = "select * from tbl_game WHERE is_active=1 and game_status=0 and game_start_time BETWEEN  (UTC_TIMESTAMP - INTERVAL 15 HOUR_MINUTE) AND (UTC_TIMESTAMP + INTERVAL 15 HOUR_MINUTE) order by id asc limit 1";
$result345 = mysqli_query($con, $query345) or die(mysqli_error($con));
$res_765=mysqli_fetch_array($result345);
//print_r($res_765);
$id_game= $res_765['id'];
$start_time_game= $res_765['game_start_time'];
$name_game= $res_765['game_name'];
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
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.js'></script>
<script type="text/javascript">
$(document).ready(function() {
	var start_time_game ='<?php echo $start_time_game;?>';
	var id_game ='<?php echo $id_game;?>';
	window.setInterval(function(){
	//alert(start_time_game);
	//alert(id_game);
	$.ajax({  
		type: "POST",
		dataType: "text",
		url: "game_zone_status_update.php",
		data: "name=" + name,  
		success: function(rr){
			var res = rr;
			//alert(res);
			if(start_time_game <= res)
			{
				$.ajax({  
				type: "POST",
				dataType: "text",
				url: "game_zone_status_update1.php",
				data: "id_game=" + id_game,  
				success: function(tt){
						location.reload();			
						},
				});
			}
				},
		});
        }, 1000);
});
</script>
	<script type="text/javascript">
		var clock;
		var game_id = '2738';
		$(document).ready(function() {
    // Set dates.
	var game_end_time = '<?php echo $end_date;?>';
    var futureDate  = new Date(game_end_time); //alert(futureDate);
    var currentDate = new Date('<?php echo $currentTime;?>');//alert(currentDate);
	//var currentDate = '<?php echo $currentTime;?>';
	//alert(currentDate);
	// Calculate the difference in seconds between the future and current date
    var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000; 
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
    	clockFace: 'MinuteCounter',
    	countdown: true,
    	callbacks: {
    		stop: function() {
    			
				 window.setTimeout(function(){location.reload()},2000);
						//$('#countdown1').hide();
					}
				}
			});
   

});

</script>
<style>
.flip-clock-wrapper ul li {

    position: absolute;
    left: 0;
    top: 0;
    width: 66%;
    height: 60%;
    line-height: 52px;
    text-decoration: none !important;
}
.flip-clock-wrapper ul
{
	width:30px !important;
	height:40px !important;
	background:none;
	margin:0px !important;
}
.flip-clock-wrapper .flip
{
box-shadow:none;	
}
.flip-clock-wrapper ul li a div div.inn {
    font-size: 15px !important;
}
.flip-clock-dot.top {
    top: 11px;
}
.flip-clock-dot.bottom {
bottom:26px !important;
}
.flip-clock-label
{
	display:none;
}
.flip-clock-wrapper
{
	margin:0px !important;
}
.flip-clock-wrapper ul li a div div.inn
{
	color:#fff;
}
</style>
</body>
</html>