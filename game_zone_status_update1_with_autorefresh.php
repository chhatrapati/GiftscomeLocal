<?php
session_start();
error_reporting(0);
include('includes/config.php');
$user_obj = new Cl_User();
$uid =$_SESSION['id'];
$next_game_id=$_POST['next_game_id'];
$curr_game_id=$_POST['curr_game_id'];
//$quer_new=mysqli_query($con,"select count(*) as current_games from tbl_game WHERE game_status='1'");
//$row_new=mysqli_fetch_array($quer_new);
//print_r($row_new);
//if($row_new['current_games']==1){
	$sql=mysqli_query($con, "UPDATE tbl_game SET game_status = '3' WHERE id='$curr_game_id'");
	$sql_12=mysqli_query($con, "UPDATE tbl_game SET game_status = '1' WHERE id='$next_game_id'");
//}	
//$result=mysqli_fetch_array($sql);
?>


<?php
$quer_new=mysqli_query($con,"select count(*) as UpdateGame from tbl_game WHERE (`game_status`=0 or `game_status`=1) and `game_start_time` < (UTC_TIMESTAMP - INTERVAL 3 HOUR_MINUTE)");
$row_new=mysqli_fetch_array($quer_new);
//print_r($row_new);
if($row_new['UpdateGame'] > 0){	
	$sql_12=mysqli_query($con, "update tbl_game set game_status = '3' WHERE (`game_status`=0 or `game_status`=1) and game_start_time < (UTC_TIMESTAMP - INTERVAL 3 HOUR_MINUTE)");	
}

?>

<?php
$quer_new12=mysqli_query($con,"select id from tbl_game where game_status=1");
$row_new12=mysqli_fetch_array($quer_new12);
$curr_game= $row_new12['id'];
?>
<table id="example" class="table data-table table-striped"  cellspacing="0" width="100%">
			  <!-- <table class="table"> -->
   		<thead class="u_g_h">						<tr>
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
						//date_default_timezone_set('UTC');
						//$timezone_offset_minutes = 330;
					    $timezone_offset_minutes=$_SESSION['tz'];
						$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);
						date_default_timezone_set($timezone_name);
						/*Fetch game history- winning no, total bids etc.*/
						
						$data = $user_obj->latest_games($uid);
						
						//print_r($data);
						$cnt=1;
						while($res=mysqli_fetch_array($data)) {
							//echo '<br/>';
							//echo 'row'+ $user_obj->milliseconds();
							   $game_id = $res['id'];
			                   $currentTime = date( 'Y-m-d H:i:s', time () );
			                  //echo 'Cureent time is: 	'.$currentTime = date( 'Y-m-d H:i:s', time () );
								$game_name = $res['game_name'];
								$game_start_time = $res['game_start_time'];
								$time = strtotime($game_start_time.' UTC');
								$dateInLocal = date("Y-m-d H:i:s", $time);
								$game_duration = $res['game_duration'];
								$winno = $res['winno'];
								$winn_no = $res['winning_no'];
								$winn_no1 = $res['game_wining_number1'];
								$winn_no2 = $res['game_wining_number2'];
								$winn_no3 = $res['game_wining_number3'];
								$game_status = $res['game_status'];
								$total_bids = $res['total_bids'];
								$total_bids_byall_onwin_no = $res['total_bids_byall_onwin_no'];
								$payout_amount_onwin_no = $res['payout_amount_onwin_no'];
								$total_bids_onwin_no = $res['total_bids_onwin_no'];
								
								/*Total bids on game*/
								$total_bids_on_game =  $res['total_bids_on_game'];
								//$total_bids_on_game = $user_obj->get_total_noof_bids($game_id);
									if($total_bids_on_game=='')
									{
										$total_bids_on_game='0';
									}
								
								//$payout_amount_onwin_no = $user_obj->get_payout_amount_OnWin_no($game_id,$winn_no);
								//$total_bids_onwin_no = $user_obj->total_bids_byuser_onwinno($game_id,$winn_no,$uid);
								$total_won_coins = $payout_amount_onwin_no*$total_bids_byall_onwin_no;
								$total_my_won = $payout_amount_onwin_no*$total_bids_onwin_no;
								if($total_won_coins=='')
								{
									$total_won_coins ="0";
								}
								if($total_bids=='')
								{
									$total_bids ="0";
								}
								if($total_my_won=='')
								{
									$total_my_won ="0";
								}
								//$total_my_bet = $user_obj->total_bids_ongame_byuser($game_id,$uid);
								$total_my_bet = $res['total_my_bet'];
								if($total_my_bet=='')
								{
									$total_my_bet='0';
								}
								if($game_status==0){ ?>	
								<tr>
								<td class="t_gz_f"><?php echo htmlentities($cnt);?></td>
								<td class="t_gz_f"><a href="play_game.php?game=<?php echo toPublicId($game_id);?>"><?php echo $game_name;?></a></td>
								<td class="t_gz_f">
								<?php echo date('d-M-y h:i',strtotime($dateInLocal)); //$create_date = $game_start_time; echo date('d-M-y h:i',strtotime($create_date));?></td>
								<td class="t_gz_f">
							     --
								</td>
								<td class="t_gz_f"><?php echo $total_bids_on_game;?></td>
								<td class="t_gz_f"><?php echo $total_my_bet;?></td>
								<td class="t_gz_f">0</td>
								<td class="t_gz_f">0</td>
								<td class="t_gz_f"><button  onClick="window.open('play_game.php?game=<?php echo toPublicId($game_id);?>','_self');" style="color:red;">
         							<i class="fa far  fa-spinner" aria-hidden="true" style="padding-right:10px "></i>Starting Soon</button></td>

							</tr>
						<?php }  if($game_status==1){
							//$create_date = $game_start_time; date('d-M-y h:i',strtotime($create_date));
							//$end_date = date('Y-m-d H:i:s',strtotime('+'.$game_duration.' minutes',strtotime($create_date)));
							$end_date = date('Y-m-d H:i:s',strtotime('+'.$game_duration.' minutes',strtotime($dateInLocal)));
							$curr_game_id = $game_id;
							//$end_date = date('h:i:s',strtotime($end_date));
									?>
								<tr>
								<td class="t_gz_c"><?php echo htmlentities($cnt);?></td>
								<td class="t_gz_c"><a href="play_game.php?game=<?php echo toPublicId($game_id);?>"><?php echo $game_name;?></a></td>
								<td class="t_gz_c">
								<?php echo date('d-M-y h:i',strtotime($dateInLocal));
								//$create_date = $game_start_time; echo date('d-M-y h:i',strtotime($create_date));?></td>
								<td class="t_gz_c">
								 --
								</td>
								<td class="t_gz_c"><div id="total_bids"><?php echo $total_bids_on_game;?></div></td>
								<td class="t_gz_c"><div id="my_bets"><?php echo $total_my_bet;?></div></td>
								<td class="t_gz_c">0</td>
								<td class="t_gz_c">0</td>
								<td class="t_gz_c"><button class="faa-pulse animated" onClick="window.open('play_game.php?game=<?php echo toPublicId($game_id);?>','_self');">
         							<i class="fa far fa-play" aria-hidden="true" style="margin-top:10px;" ></i>&nbsp;&nbsp;PLAY NOW</button><div class="clock" id="countdown1" style="height:6px;width:180px;left:115px;bottom:5px;"></div></td>
							</tr>
						<?php }  if($game_status==3){ ?>	

							<tr>
								<td class="t_gz"><?php echo htmlentities($cnt);?></td>
								<td class="t_gz"><a href="play_game.php?game=<?php echo toPublicId($game_id);?>"><?php echo $game_name;?></a></td>
								<td class="t_gz"><?php echo date('d-M-y h:i',strtotime($dateInLocal));//$create_date = $game_start_time; echo date('d-M-y h:i',strtotime($create_date));?></td>
								<td class="t_gz">
								<?php if($winno==''){?>
								<?php } else {?>
								<?php echo $winno;?>
								<?php }?>
								</td>
								<td class="t_gz"><?php echo $total_bids_on_game;?></td>
								<td class="t_gz"><?php echo $total_my_bet?></td>
								<td class="t_gz"><?php echo $total_won_coins;?></td>
								<td class="t_gz"><?php echo $total_my_won;?></td>
								<td class="t_gz"><i class="fa far  fa-trophy" aria-hidden="true" style="padding-right:10px "></i><a href="play_game.php?game=<?php echo toPublicId($game_id);?>">See Result</a></button></td>
							</tr>					
							<?php } 							
							$cnt=$cnt+1; 
						} //End While ?>				
						</tbody>
								</table>
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
<input type="hidden" name="start_time_game" id="start_time_game" class="form-control" value="<?php echo $start_time_game;?>" />  
<input type="hidden" name="next_game_id" id="next_game_id" class="form-control" value="<?php echo $id_game;?>" /> 
<input type="hidden" name="curr_game_id" id="curr_game_id" class="form-control" value="<?php echo $curr_game_id;?>" />
<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--<script  src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="nonymous"></script>-->
<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="js/jquery-1.11.1.min.js"></script>
<!-- jQuery Form Validation code -->
<script src="admin/js/jquery.dataTables.min.js"></script> 
<script src="admin/js/matrix.js"></script> 
<script src="admin/js/matrix.tables.js"></script>
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<script src='https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.js'></script>

<script type="text/javascript">
		var clock;
		$(document).ready(function() {
    // Set dates.
	var game_end_time = '<?php echo $end_date;?>';
    var futureDate  = new Date(game_end_time); //alert(futureDate);
    var currentDate = new Date('<?php echo $currentTime;?>');//alert(currentDate);
	var curr_game_id ='<?php echo $curr_game_id;?>';
	//var currentDate = '<?php //echo $currentTime;?>';
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
	clock = $('.clock').FlipClock(diff, {
    	clockFace: 'MinuteCounter',
    	countdown: true,
    	callbacks: {
    		stop: function() {
    		    $('#audioplayer').trigger('play');
    			//$('#alert-sound').show();
			    //window.location.reload(true);
				 //window.setTimeout(function(){location.reload(true)},2000);
					}
				}
			});
   
});

</script>
<style>
.flip-clock-wrapper ul li {position: absolute;left: 0;top: 0;width: 66%;height: 60%;line-height: 52px;text-decoration: none !important;}
.flip-clock-wrapper ul {width:30px !important;height:40px !important;background:none;margin:0px !important;}
.flip-clock-wrapper .flip {box-shadow:none;	}
.flip-clock-wrapper ul li a div div.inn {font-size: 15px !important;}
.flip-clock-dot.top {top: 11px;}
.flip-clock-dot.bottom {bottom:26px !important;}
.flip-clock-label {display:none;}
.flip-clock-wrapper {margin:0px !important;}
.flip-clock-wrapper ul li a div div.inn {color:#fff;}
</style>