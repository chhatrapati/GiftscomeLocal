<?php
session_start();
error_reporting(0);
include('includes/config.php');
$user_obj = new Cl_User();
$uid =$_SESSION['id'];
//date_default_timezone_set('UTC');
//$timezone_offset_minutes = 330;
$timezone_offset_minutes=$_SESSION['tz'];
$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);
date_default_timezone_set($timezone_name);
/*Fetch game history- winning no, total bids etc.*/
$data = $user_obj->latest_games();
//print_r($data);
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
	<meta http-equiv="pragma" content="no-cache" />
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
		<!-- panel-body  -->
		<div class="panel-body" style="padding:0 !important;">
			<div class="row">		
				<div class="col-md-12 col-sm-12 already-registered-login coin-balance">
				<div class="row col-md-12 form-group">	
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
			<div id="pp">
	<table id="example" class="table data-table table-striped"  cellspacing="0" width="100%">
			  <!-- <table class="table"> -->
   		<thead class="u_g_h">						
						<tr>
							<th>#</th>
							<th>Game Name</th>
							<th>Date</th>
							<th>Winning no</th>
							<th>Total Bets</th>
							<th>My Bets</th>
							<th>Total Won</th>
							<th>My Won</th>
							<th>Status</th>							
						</tr>
					</thead>
					<tbody class="text-left">
						<?php
						$cnt=1;
						while($res=mysqli_fetch_array($data)) {
							   $game_id = $res['id'];
			                   $currentTime = date( 'Y-m-d H:i:s', time () );
			                  //echo 'Cureent time is: 	'.$currentTime = date( 'Y-m-d H:i:s', time () );
								$game_name = $res['game_name'];
								$game_start_time = $res['game_start_time'];
								$time = strtotime($game_start_time.' UTC');
								$dateInLocal = date("Y-m-d H:i:s", $time);
								$game_duration = $res['game_duration'];
								$winn_no = $res['winning_no'];
								$winn_no1 = $res['game_wining_number1'];
								$winn_no2 = $res['game_wining_number2'];
								$winn_no3 = $res['game_wining_number3'];
								$game_status = $res['game_status'];
								$total_bids = $res['total_bids'];
								/*Total bids on game*/
								$total_bids_on_game = $user_obj->get_total_noof_bids($game_id);
									if($total_bids_on_game=='')
									{
										$total_bids_on_game='0';
									}
								
								$payout_amount_onwin_no = $user_obj->get_payout_amount_OnWin_no($game_id,$winn_no);
								$total_bids_onwin_no = $user_obj->total_bids_byuser_onwinno($game_id,$winn_no,$uid);
								$total_my_won = $payout_amount_onwin_no*$total_bids_onwin_no;
								
								if($total_bids=='')
								{
									$total_bids ="0";
								}
								if($total_my_won=='')
								{
									$total_my_won ="0";
								}
								$total_my_bet = $user_obj->total_bids_ongame_byuser($game_id,$uid);
								if($total_my_bet=='')
								{
									$total_my_bet='0';
								}
								if($game_status==0)
								{ 
							      $tdcls ='t_gz_f'; 
								} 
								else if($game_status==1)
								{ 
							      $tdcls ='t_gz_c';
								  $end_date = date('Y-m-d H:i:s',strtotime('+'.$game_duration.' minutes',strtotime($dateInLocal)));
							      $curr_game_id = $game_id;
								} 
								else if($game_status==3)
								{ 
							      $tdcls ='t_gz';
								  $winner_list = mysqli_query($con,"select user_id, SUM(bid_amount) as bid_amount, bid_no from tbl_userbids where game_id ='$game_id' AND bid_no ='$winn_no' AND bid_amount >0 GROUP BY user_id ");
									while($res=mysqli_fetch_array($winner_list)) {
									$user_id = $res['user_id'];
									$bid_amount = $res['bid_amount'];
									$bid_no = $res['bid_no'];
									$total_won = $bid_amount*$payout_amount_onwin_no;
									/*Check if user has alreday inserted in winner table*/
									$query_987 = "SELECT * FROM tbl_winners where game_id = '$game_id' and user_id ='$user_id'";
									$result_987 = mysqli_query($con, $query_987) or die(mysqli_error($con));
									$rowcount_987=mysqli_num_rows($result_987);
									//print_r($rowcount_987);
									/*Inser winning users into tbl_winners*/
									//$user_obj->insert_winners($game_id,$user_id,$bid_amount,$total_won);
									if($rowcount_987 ==0)
									{
									$query_142=mysqli_query($con, "insert into tbl_winners(game_id,user_id,total_bid_amount,total_won_coins) values('".$game_id."','$user_id','$bid_amount','$total_won')");
									$sql_478 = mysqli_query($con,"select * from user_points_supplement");
									$result=mysqli_fetch_array($sql_478); //print_r($result);			
									$points_by_game_won = $result['points_by_game_won'];
									//$user_obj->set_user_points($user_id,$points_by_game_won,'By Game Won');
									$query_11=mysqli_query($con, "insert into tbl_users_points(user_id,user_points,points_by) values('$user_id','$points_by_game_won','By Game Won')");
									//$user_obj->set_points_users($user_id);
									$sql1=mysqli_query($con, "update users set user_points= (select sum(user_points) from tbl_users_points where user_id='$user_id') where id='$user_id'");
									$sql_123=mysqli_query($con,"update users set gift_coins=gift_coins+'".$total_won."'  where id='".$user_id."'");
									}
									}
									$sql_563=mysqli_query($con, "update tbl_game set total_bids='".$total_bids_on_game."' where id='".$game_id."'");
									/*Total Won on game*/
											$sql_967 = mysqli_query($con,"select SUM(total_won_coins) as total_won_coins FROM tbl_winners WHERE game_id ='".$game_id."'");
											$result_967=mysqli_fetch_array($sql_967);
											$total_coins_won =$result_967['total_won_coins'];
											if($total_coins_won=='')
											{
												$total_coins_won ="0";
											}
											/*Update total won coins*/
									$sql_843=mysqli_query($con, "update tbl_game set total_won_coins='".$total_won_coins."' where id='".$game_id."'");	
								}
								?>
								
								<tr>
								<td class="<?php echo $tdcls;?>"><?php echo htmlentities($cnt);?></td>
								<td class="<?php echo $tdcls;?>"><a href="play_game.php?game=<?php echo toPublicId($game_id);?>"><?php echo $game_name;?></a></td>
								<td class="<?php echo $tdcls;?>">
								<?php echo date('d-M-y h:i',strtotime($dateInLocal)); //$create_date = $game_start_time; echo date('d-M-y h:i',strtotime($create_date));?>
								</td>
								<td class="<?php echo $tdcls;?>">
							    <?php  if($game_status==3){?>
								<?php echo $winn_no1;?> + <?php echo $winn_no2;?> + <?php echo $winn_no3;?> = <?php echo $winn_no;?>
								<?php } else { ?>
								-- 
								<?php }?>
								</td>
								<td class="<?php echo $tdcls;?>">
								<?php  if($game_status==0 || $game_status==3 ){?>
								<?php echo $total_bids_on_game;?>
								<?php } ?>
								<?php  if($game_status==1){?>
								<div id="my_bets"><?php echo $total_my_bet;?></div>
								<?php }?>
								</td>
								<td class="<?php echo $tdcls;?>">
								<?php  if($game_status==0 || $game_status==3){?>
								<?php echo $total_my_bet;?>
								<?php } ?>
								<?php  if($game_status==1){?>
								<div id="my_bets"><?php echo $total_my_bet;?></div>
								<?php } ?>
								</td>
								<td class="<?php echo $tdcls;?>"><?php if($game_status==3){?><?php echo $total_coins_won;?> <?php } else {?>0<?php }?></td>
								<td class="<?php echo $tdcls;?>"><?php if($game_status==3){?><?php echo $total_coins_won;?> <?php } else {?>0<?php }?></td>
								<td class="<?php echo $tdcls;?>">
								<?php  if($game_status==0){?>
								<button  onClick="window.open('play_game.php?game=<?php echo toPublicId($game_id);?>','_self');" style="color:red;">
         							<i class="fa far  fa-spinner" aria-hidden="true" style="padding-right:10px "></i>Starting Soon</button>
								<?php }?>
								<?php  if($game_status==1){?>
									<button class="faa-pulse animated" onClick="window.open('play_game.php?game=<?php echo toPublicId($game_id);?>','_self');">
         							<i class="fa far fa-play" aria-hidden="true" style="margin-top:10px;" ></i>&nbsp;&nbsp;PLAY NOW</button>
									<div class="clock" id="countdown1" style="height:6px;width:180px;left:115px;bottom:5px;"></div>
								<?php } ?>
								<?php  if($game_status==3){?>
								<i class="fa far  fa-trophy" aria-hidden="true" style="padding-right:10px "></i><a href="play_game.php?game=<?php echo toPublicId($game_id);?>">See Result</a></button>
								<?php }?>
							  </td>
							</tr>
						   <?php 
							//$create_date = $game_start_time; date('d-M-y h:i',strtotime($create_date));
							//$end_date = date('Y-m-d H:i:s',strtotime('+'.$game_duration.' minutes',strtotime($create_date)));
							//$end_date = date('Y-m-d H:i:s',strtotime('+'.$game_duration.' minutes',strtotime($dateInLocal)));
							//$curr_game_id = $game_id;
							//$end_date = date('h:i:s',strtotime($end_date));
									?>						
						<?php	$cnt=$cnt+1; 
						} //End While ?>				
						</tbody>
								</table>
								</div>
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
<?php if($_SESSION['sound_noti']==1)
{?>
<div id="alert-sound" style="display:none;">
<audio id="audioplayer" controls preload="none">
    <source src="sound/ping.mp3" type="audio/mpeg">
   <source src="sound/ping.ogg" type="audio/ogg">
</audio>
</div>
<?php }?>
</section>
<?php
/* Count all record from game table*/
$query345 = "select * from tbl_game WHERE is_active=1 and game_status=0 and game_start_time BETWEEN  (UTC_TIMESTAMP - INTERVAL 15 HOUR_MINUTE) AND (UTC_TIMESTAMP + INTERVAL 15 HOUR_MINUTE) order by id asc limit 1";
$result345 = mysqli_query($con, $query345) or die(mysqli_error($con));
$res_765=mysqli_fetch_array($result345);
//print_r($res_765);
/*Next game id to start*/
$id_game= $res_765['id'];
$start_time_game= $res_765['game_start_time'];
$time = strtotime($start_time_game.' UTC');
$start_time_game = date("Y-m-d H:i:s", $time);
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
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<script src='https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.js'></script>
<?php if($_SESSION['tz']!='') {?>
<script type="text/javascript">
$(document).ready(function() {
	var start_time_game ='<?php echo $start_time_game;?>';
	var next_game_id ='<?php echo $id_game;?>';
	var curr_game_id ='<?php echo $curr_game_id;?>';
	window.setInterval(function(){
	//alert(start_time_game);
	//alert(curr_game_id);
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
				//alert('hi');
				$.ajax({  
				type: "POST",
				dataType: "text",
				url: "game_zone_status_update1.php",
				cache: false,
				data: "next_game_id=" + next_game_id + "curr_game_id=" + curr_game_id,  
				success: function(tt){
					//alert(tt);
						//location.reload();
						//window.location.reload(true);
                        window.setTimeout(function(){location.reload()},2000);						
						},
				});
			}
				},
		});
        }, 1000);
});
</script>
<?php } ?>
<!--<script type="text/javascript">
$(document).ready(function() {
	var id_game ='<?php //echo $curr_game_id;?>';
	window.setInterval(function(){
	//alert(start_time_game);
	//alert(id_game);
	$.ajax({  
		type: "POST",
		dataType: "text",
		url: "total_bids_on_current_game.php",
		data: "id_game=" + id_game, 
		success: function(rr){
			var res = rr;
			$("#total_bids").html(res);
			var my_bets = $('<div />').append(res).find('.my_bets').html();
            $("#my_bets").text(my_bets);
			//alert(res);
			},
		});
        }, 5000);
});
</script>
-->
	<script type="text/javascript">
		var clock;
		$(document).ready(function() {
    // Set dates.
	var game_end_time = '<?php echo $end_date;?>';
    var futureDate  = new Date(game_end_time); //alert(futureDate);
    var currentDate = new Date('<?php echo $currentTime;?>');//alert(currentDate);
	var curr_game_id ='<?php echo $curr_game_id;?>';
	//var currentDate = '<?php echo $currentTime;?>';
	//alert(curr_game_id);
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
	
	clock = $('.clock').FlipClock(diff, {
    	clockFace: 'MinuteCounter',
    	countdown: true,
    	callbacks: {
    		stop: function() {
    		    $('#audioplayer').trigger('play');
    			//$('#alert-sound').show();
			    //window.location.reload(true);
				 window.setTimeout(function(){location.reload(true)},2000);
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