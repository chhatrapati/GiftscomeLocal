<?php session_start();
include('includes/config.php');
require_once('app/config.php');
require_once('app/setting.php');
$query1 = "SELECT * FROM `".$config['db']['pre']."users` where id = '".$sesId."'";
$result1 = $con->query($query1);
$row1 = mysqli_fetch_assoc($result1);
$string = $row1['username'];
$picname = $row1['user_picture'];
$ses_picname = ($picname == "")? "avatar_default.png" : $picname;
$user_obj = new Cl_User();
$game_id=toInternalId($_GET['game']);
if(strlen($_SESSION['login'])==0)
{   
	$_SESSION['url'] = $_SERVER['REQUEST_URI'];
	header('location:login.php');
}
$dataresult = $user_obj->get_winno_by_gameid($game_id);
$game_name =$dataresult['game_name'];
$winning_no =$dataresult['winning_no'];
$uid =$_SESSION['id'];
$total_bets = $user_obj->total_bids_ongame_byuser($game_id,$uid);
if($total_bets=='')
{
	$total_bets='0';
}
?>
<!DOCTYPE html>
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="">
	<meta http-equiv="pragma" content="no-cache">
	<meta name="robots" content="all">
	<title>Play Game</title>
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	<?php require_once('templates/common_css.php');?>
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.css'>
	<link rel='stylesheet' href='css/play-game.css'>
</head>
<body class="animsition" onload="todo_new()">
<?php require_once('templates/header.php');?>
<section class="p-t-33 p-b-38" style="background-image:url(images/gamezone2.jpg); ">
<?php
			date_default_timezone_set('UTC');// change according timezone
			$currentTime = date( 'Y-m-d H:i:s', time () );
			'Cureent time is: 	'.$currentTime = date( 'Y-m-d H:i:s', time () );
			$query = "SELECT * FROM tbl_game where id = '$game_id' and is_active =1";
			$result = mysqli_query($con, $query) or die(mysqli_error($con));
			//$rowcount=mysqli_num_rows($result);//print_r($rowcount);
			$row = mysqli_fetch_array($result, MYSQLI_BOTH);
			$id = $row['id'];
			$game_name = $row['game_name'];
			$game_start_time = $row['game_start_time'];
			$game_duration = $row['game_duration'];
			//display the converted time
			$end_date = date('Y-m-d H:i:s',strtotime('+'.$game_duration.' minutes',strtotime($game_start_time)));
			$stop_bid_time = date('Y-m-d H:i:s',strtotime('-15 seconds',strtotime($end_date)));
			$freeze_bid_time = date('Y-m-d H:i:s',strtotime('-30 seconds',strtotime($end_date)));
			$res_declare = date('Y-m-d H:i:s',strtotime('+5 seconds',strtotime($end_date)));
			$End_date_extend = date('Y-m-d H:i:s',strtotime('+1 minutes',strtotime($end_date)));
			//echo '<br/>Result Declare time is: '.$res_declare;
?>
<?php
/*Winning no of current game*/
$sql12=mysqli_query($con, "select * from tbl_game where id='$game_id'");
$row_12 = mysqli_fetch_array($sql12, MYSQLI_BOTH); //print_r($row_12);
$winning_no = $row_12['winning_no'];
$winn_no01 = $row_12['game_wining_number1'];
$winn_no02 = $row_12['game_wining_number2'];
$winn_no03 = $row_12['game_wining_number3'];
$sql678=mysqli_query($con, "select game_status from tbl_game  WHERE id= '$game_id'");
$result_78=mysqli_fetch_array($sql678); 
//print_r($result_78);
$game_status =$result_78['game_status'];
if($game_status==3) { 
/*Fetch users list - by winning no on game.*/					
$qq = $user_obj->get_game_statics($game_id);
$payout_amount_onwin_no = $user_obj->get_payout_amount_OnWin_no($game_id,$winning_no);
$total_bids_onwin_no = $user_obj->total_bids_byuser_onwinno($game_id,$winning_no,$uid);
$total_coins_won = $payout_amount_onwin_no*$total_bids_onwin_no;
?>
<!-- User Bids -->
<div class="container">
<div class="row">
	<!-- panel-heading -->
	<div id="" class="col-md-12 p-0">
		<!-- panel-body  -->
		<div class="panel-body">
			<div class="row">
			 <div class="text-center">
			 <?php if(!empty($_SESSION['msg'])){?>
								<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
								</div>
								<?php } ?>
				
				</div>
				<div class="res_sec">
				<?php if($winning_no!=''){?>
				<strong class="white res-text">Winning number of <span style="color:yellow"><?php echo $game_name;?></span> <br> <?php echo $winn_no01;?> + <?php echo $winn_no02;?> + <?php echo $winn_no03;?> <br> <span class="pay2" ><?php echo $winning_no;?></span><a href="users-game-history.php?game=<?php echo toPublicId($game_id);?>"> <br> <b style="color:#fff;"><span class="see-winners"><i class="fa fa-trophy" style="color:gold;"></i></span><span class="white see-win-link">See Winners</span></b></a></strong><br/>
				<strong class="white"><a class="white see-win-link" href="game_zone.php">Back To Game Zone</a></strong>
				<strong class="white total_won-txt">Total Bets:  <?php echo $total_bets;?></strong>
				<strong class="white total_won-txt">Total Coins Won: <?php echo $total_coins_won;?></strong>
				<?php }?>
				</div>
				<div class="col-md-12 col-sm-12 p-0 already-registered-login coin-balance">
					<div class="row col-md-12 form-group">
						<?php
						date_default_timezone_set('UTC');// change according timezone
						$currentTime = date( 'Y-m-d H:i:s', time () );
					?>
				</div>
				<!--</form>-->
				<table id="example" class="table data-table custom-table table-striped dataTable bgwhite"  cellspacing="0" width="100%">
					<thead>
						<tr>
							<th class="playgme">Number</th>
							<th class="playgme">Payout</th>
							<th class="playgme">Your Bid</th>
							<th class="playgme">Overall Bids</th>
							<th class="playgme">Total Won Coins</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$cnt=1;
						while($rr=mysqli_fetch_array($qq)) {
							$pay_digit = $rr['payout_digit'];
							$pay_amt = $rr['payout_amount'];
							$user_total_bid = $user_obj->users_total_bids_on_no($game_id,$pay_digit,$uid);
							if($user_total_bid=='')
							{
								$user_total_bid='0';
							}
							$total_bid = $user_obj->total_bids_On_no($game_id,$pay_digit,$uid);
							if($total_bid=='')
							{
								$total_bid='0';
							}	
						?>	
							<tr <?php if($pay_digit==$winning_no){ ?> style="background-color:#f1c40f;" <?php }?>>
								<td class="pay1"><?php echo $pay_digit;?></td>
								<td style="text-align:center;"><?php echo $pay_amt?></td>
								<td style="text-align:center;"><?php echo $user_total_bid;?></td>
								<td style="text-align:center;"><?php echo $total_bid;?></td>
								<td style="text-align:center;"><?php if($pay_digit==$winning_no){ echo $total_coins_won;} else {echo '-';}?></td>
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
</div>
<?php } else { ?>
						<div class="container-fluid  Gamezone_tab">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-12 m-l-r-auto">
									<div class="col-lg-12">
									<?php
											/*Fetch user's bid on last game*/
											$game_id_last_bet = $user_obj->last_game_bet_by_user($uid);
											$last_game_bid = $user_obj->last_bet_by_user($game_id_last_bet,$uid);
											while($result_new=mysqli_fetch_array($last_game_bid)) {
												//print_r($result_new);
												 $table_data[]= array(bid_no=>$result_new['bid_no'],bid_amount=>$result_new['bid_amount']);
												//$table_data[]= array($result_new['bid_no'],$result_new['bid_amount']);
											}
											$ar = json_encode($table_data);
											$obj=  json_decode($ar,true);
											//print_r($obj);
									?>
		 
			<h1 class="my-1" style="text-align:center;font-size:26px;padding-top:1%; color:#fff;">
				<?php if($currentTime < $game_start_time) {?>
				<?php echo $game_name;?> starts in
				<?php } ?>
				<?php if($currentTime >= $game_start_time  && $currentTime <= $end_date ) {?>
				<?php echo $game_name;?> ends in:-
				<?php } ?>
			</h1>
			<div class="clock d-flex justify-content-center" id="countdown1"></div>
			<div id='loadingmessage' class="loadingmessage">
			 <img src='images/loading5.gif' class="loadingimg"/>
			</div>
			<div class="message1" id="message1"></div>
			<div class="alert alert-danger alert-dismissible" id="danger">
			<strong>Your coins balance is low!</strong> Please reset your bets or <a href="package.php" style="color:red;font-size:18px;font-weight:bold;">purchase </a> more coins.
		    </div>	
		</div>
		<div class="row">
		<div class="col-lg-3"></div>
		<div class="col-lg-6" id="message"></div>
		<div class="col-lg-3"></div>
		</div>
		<div class="row">
		<div class="col-lg-3"></div>
		<div class="col-lg-9" id="message">
		<div class="col-lg-6 text-center" id="freez_alert">
		Sorry, Game bet time is over, try next game.
		</div>
		</div>
		</div>
		<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" style="z-index:99999;">
  <div class="modal-dialog modal-lg" style="max-width:60%;">
<?php require_once('set-auto-bid-form.php');?>
  </div>
</div>
 <div class="row">
		        <div class="col-10 text-left Medi">
				    <button type="button" class="btn btn-warning bt" id="all_no" value="ALL">ALL</button>
					<button type="button" class="btn btn-success bt" id="odd_no" value="ODD">ODD</button>
					<button type="button" class="btn btn-danger bt" id="even_no" value="EVEN">EVEN</button>

			         <button type="button" class="btn btn-info bt" id="middle_no">MIDDLE (10-17)</button>
					 <input type="hidden" name="pre_btn" class="bt" id="pre_btn" value=""/>
					 <button type="button" class="btn btn-info bt" id="side_no">SIDE (00-09,18-27)</button>
					 <button type="button" class="btn btn-info bt" id="small_no">SMALL (00-13)</button>
				     <button type="button" class="btn btn-info bt" id="big_no">BIG (14-27)</button>
				     <button type="button" class="btn btn-success bt" id="random_no">RANDOM</button>					
				 	<?php if($obj){?><button type="button" class="bt btn btn-info" id="last_bet_no">LAST BET</button><?php }?>
					<button type="button" class="btn btn-warning bt" id="reverse_no">REVERSE BET</button>
				    <button type="button" class="btn btn-info bt" data-toggle="modal" data-target="#myModal" id="">Set Auto Bid</button>	
				</div>
				
				<select id="mySelect"> 
						<option value="" selected="selected">Select Bet Options</option> 
						<option class="btn" name="all_no" id="bt_all_no" value="All">All</option> 
						<option class="btn btn-success bt" name="odd_no" id="bt_odd_no" value="ODD">ODD</option> 
						<option class="btn btn-danger bt" name="even_no" id="bt_even_no" value="EVEN">EVEN</option>
						<option class="btn btn-info bt" name="middle_no" id="bt_middle_no">MIDDLE (10-17)</option> 
						<option class="btn btn-info bt" name="side_no" id="bt_side_no">SIDE (00-09,18-27)</option> 
						<option class="btn btn-info bt" name="small_no" id="bt_small_no">SMALL (00-13)</option>
                        <option class="btn btn-info bt" name="big_no" id="bt_big_no">BIG(14-27)</option>			
						<option class="btn btn-info bt" name="random_no" id="bt_random_no">RANDOM</option>
                        <?php if($obj){?><option class="btn btn-info bt" name="last_bet_no" id="bt_last_bet_no">LAST BET</option>  <?php }?>
						<option class="btn btn-info bt" name="reverse_no" id="bt_reverse_no">REVERS BET</option>   						
				</select>
							<select id="mySelect1"> 
						<option value="" selected="selected">Multiplier</option> 
						<option class="btn btn-basic btn_mul " disabled>Multiply Your Bids<i class=" fa fa-hand-o-right"></i></option> 
						<option class="btn btn-default bt2" name="half" id="half_mb">0.5<i class="fa fa-window-close" aria-hidden="true"></i></option> 
						<option class="btn btn-default bt2" name="onendhalf" id="onendhalf_mb">1.5<i class="fa fa-window-close" aria-hidden="true"></i></option>
						<option class="btn btn-default bt2" name="double" id="double_mb">2<i class="fa fa-window-close" aria-hidden="true"></i></option> 
						<option class="btn btn-default bt2" name="five" id="five_mb">5<i class="fa fa-window-close" aria-hidden="true"></i></option> 
						<option class="btn btn-default bt2" name="ten" id="ten_mb">10<i class="fa fa-window-close" aria-hidden="true"></i></option>
                        <option class="btn btn-default bt2" name="fifteen" id="fifteen_mb">15<i class="fa fa-window-close" aria-hidden="true"></i></option>			
						<option class="btn btn-default bt2" name="twenty" id="twenty_mb">20<i class="fa fa-window-close" aria-hidden="true"></i></option>
                        <option class="btn btn-default bt2" name="twentyfive" id="twentyfive_mb">25<i class="fa fa-window-close" aria-hidden="true"></i></option> 					
				</select>
				<div class="col-sm-2 text-left"> 
					<div class="text-right">
						<input type="hidden" class="" id="prev_bets" value="<?php echo $total_bets;?>">
						<p><label class="curr_bet_label">Current Bet :</label><br><input type="text" class="width-dynamic proba dva text-center curr_bet_txt" min="0" name="total_bids_" id="total_bids" value="" disabled></p>
                        <p><label class="coin_balance_label">Coin Balance :</label><br><input type="text" class="width-dynamic proba dva text-center coin_balance_txt" min="0" name="gift_coins" id="gift_coins" value="<?php echo $_SESSION['gift_coins'];?>" disabled></p>
					<input type="hidden" id="rem_coins" name="rem_coins" value="">
					<input type="hidden" id="gift_coins_bal_final" name="gift_coins_bal_final" value="<?php echo $_SESSION['gift_coins'];?>">
				    </div>
			  </div>
		 </div>
	   <br>
	<div class="" style="padding-bottom: 10px;">
		<div class="row" > 
		<div class="col-lg-7 py-1 Medi" style="padding-left:25px; ">
					<div class="row">					
				    <button type="button" class="btn btn-basic btn_mul " disabled>Multiply Your Bids<i class=" fa fa-hand-o-right"></i></button> 
				     <button type="button" class="btn btn-default bt2" id="half">0.5<i class="fa fa-window-close" aria-hidden="true"></i></button>
					<button type="button" class="btn btn-default bt2" id="onendhalf">1.5<i class="fa fa-window-close" aria-hidden="true"></i></button> 
					<button type="button" class="btn btn-default bt2" id="double">2<i class="fa fa-window-close" aria-hidden="true"></i></button> 
					<button type="button" class="btn btn-default bt2" id="five">5<i class="fa fa-window-close" aria-hidden="true"></i></button> 
			        <button type="button" class="btn btn-default bt2" id="ten">10<i class="fa fa-window-close" aria-hidden="true"></i></button>
				    <button type="button" class="btn btn-default bt2" id="fifteen">15<i class="fa fa-window-close" aria-hidden="true"></i></button>
			        <button type="button" class="btn btn-default bt2" id="twenty">20<i class="fa fa-window-close" aria-hidden="true"></i></button> 
				    <button type="button" class="btn btn-default bt2" id="twentyfive">25<i class="fa fa-window-close" aria-hidden="true"></i></button> 
					 </div></div>
		          <div class="col-lg-5 py-1 text-right ">
				    <button type="button" id="clear" class="btn btn-warning btn_act">Clear All</button>
					<button type="button" id="subbtn" class="btn btn-success btn_act">Submit</button>		
					<button type="button" name="" id="cnl_btn" class="btn btn-danger btn_act" value="cancel" onClick="return confirm('Are you sure you want to cancel your bet?')">Cancel Bet</button>
				 </div>
		</div>
	</div>
					<div class="row">
						<div class="col-lg-6">
							<form name="" method="post" action="" id="game_zone">
								<div class="block1 hov-img-zoom pos-relative m-b-30" >
									<h1 class="list-heading">
										<div class="row">
											<div class="col-3">NUMBER</div>
											<div class="col-4">PAYOUT RATE <img src="images/logo-2.png" class="gift"> </div>
											<div class="col-5">BET</div>
										</div>
									</h1>
									<div>
										<ul class="heading py-1">
											<?php
											$query=mysqli_query($con,"select * from tbl_game_payout where game_id = '$id' LIMIT 14");
											$no=0;while($row=mysqli_fetch_array($query)) {
											$payout_digit = $row['payout_digit'];										
												?>
												
												<li>
													<div class="row">
														<div class="col-3 size8 gz_digit"><div class="back-img"><?php echo $row['payout_digit'];?></div></div>
														<div class="col-4  size8">
															<div class="row">
																<div class="col-md-12"><?php echo $row['payout_amount'];?> </div>
															</div>
														</div>														
														<div class="col-5 size8 ">
															<div class="">
																<?php
																    $digit = $no;
																	$bid_amount_on_digit = $user_obj->users_total_bids_on_no($id,$digit,$uid);
																	$default_bids_on_digit = $user_obj->default_bids_by_no($digit);
																	
																	if($bid_amount_on_digit=='')
																	{
																		$bid_amount_on_digit='00';
																	}
																	
																?>
																<div class="d-flex justify-content-center">
																
																	<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2 btn btn-dng d-inline-block" id="minus<?php echo $row['payout_digit'];?>" >
																		<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
																	</button>
																	
																	<input class="size8 m-text18 t-center num-product d-inline-block" type="number" min="0" pattern="[0-9]" name="payout_amount<?php echo $row['payout_digit'];?>" id="payout_amount<?php echo $row['payout_digit'];?>" value="<?php echo $bid_amount_on_digit;?>" maxlength="5" onkeypress="return AllowOnlyNumbers(event);" onkeyup="todo_new()">
										                            <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2 btn btn-suc d-inline-block" id="plus<?php echo $row['payout_digit'];?>" >
																		<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
																	</button>
																</div>
																<input class="" type="hidden" pattern="" name="default_bid<?php echo $row['payout_digit'];?>" id="default_bid<?php echo $row['payout_digit'];?>" value="<?php echo $default_bids_on_digit;?>" maxlength="5">
																	
															</div>
														</div>
													</div>
												</li>
												<?php $no++;}?>
											</ul>
										</div>
									</div><!-- end block1 -->
								</div><!-- end of col-lg-6- -->
								<div class="col-lg-6">
									<div class="block1 hov-img-zoom pos-relative m-b-30" >
										<h1 class="list-heading">

											<div class="row">
											<div class="col-3">NUMBER</div>
											<div class="col-4">PAYOUT RATE<img src="images/logo-2.png" class="gift"></div>
											<div class="col-5">BET</div>
											</div>
										</h1>
										<div>
											<ul class="heading py-1">
												<?php $query=mysqli_query($con,"select * from tbl_game_payout where game_id = '$id' LIMIT 14 OFFSET 14");
												$no =14; while($row=mysqli_fetch_array($query)) { 
													$payout_digit = $row['payout_digit'];													
													?>
													<li>
														<div class="row">
															<div class="col-3 size8"><div class="back-img"><?php echo $row['payout_digit'];?></div></div>
															<div class="col-4 size8">
																<div class="row">

																	<div class="col-12">
																		<?php echo $row['payout_amount'];?>
																	</div>
																</div>
															</div>															
															<div class="col-5 size8">
																<div class="">
																<?php
																    $digit = $no;
																	$bid_amount_on_digit = $user_obj->users_total_bids_on_no($id,$digit,$uid);
																	$default_bids_on_digit = $user_obj->default_bids_by_no($digit);
																	
																	
																	if($bid_amount_on_digit=='')
																	{
																	  $bid_amount_on_digit='00';
																	}
																	
																?>
																	<div class="d-flex justify-content-center">
																		<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2 btn btn-dng d-inline-block"  id="minus<?php echo $row['payout_digit'];?>" >
																			<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
																		</button>
																		<input class="size8 m-text18 t-center num-product d-inline-block"  min="0" pattern="[0-9]" name="payout_amount<?php echo $row['payout_digit'];?>" type="number" id="payout_amount<?php echo $row['payout_digit'];?>"  min="0" maxlength="5" value="<?php echo $bid_amount_on_digit;?>" onkeypress="return AllowOnlyNumbers(event);" onkeyup="todo_new()">
																	
																		<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2 btn btn-suc d-inline-block" id="plus<?php echo $row['payout_digit'];?>" >
																			<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
																		</button>
																			<input class="" type="hidden" pattern="" name="default_bid<?php echo $row['payout_digit'];?>" id="default_bid<?php echo $row['payout_digit'];?>" value="<?php echo $default_bids_on_digit;?>" maxlength="5">
																	</div>
																</div>
															</div>
														</div>
													</li>

													<?php $no++;}?>
												</ul>
											</div>
										</div><!-- end block1 -->
									</div><!-- end of col-lg-6- -->

								</div><!-- end of row -->
							</div>
						</form>
					</div>
				</div><?php }?>
			</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
<?php if($game_status!=3) {?>
<script type="text/javascript" src="chat/assets/js/jquery.min.js"></script>
<?php }?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.js'></script>
<?php if($currentTime < $game_start_time) {?>
<script type="text/javascript">
var clock;
$(document).ready(function() {
	// Set dates.
	var game_start_time = '<?php echo $game_start_time;?>';
	var futureDate  = new Date(game_start_time); //alert(futureDate);
	var currentDate = new Date('<?php echo $currentTime;?>');//alert(currentDate);
	// Calculate the difference in seconds between the future and current date
	var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000; //alert(diff);
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
	clock = jQuery('.clock').FlipClock(diff, {
		//clockFace: 'MinuteCounter',
		countdown: true,
		callbacks: {
		stop: function() {
				window.setTimeout(function(){location.reload()},2000);
			}
		}
	});
});
</script>
<?php } ?>
<?php if($currentTime == $game_start_time){?>
<script type="text/javascript">
//alert('hi');
		//window.setTimeout(function(){location.reload()},100);
</script>
<?php }?>
<?php if($currentTime > $game_start_time && $currentTime < $end_date)
    {
	     $game_status = $user_obj->game_status($game_id);
			 if($game_status !='1')
			 {
			 $user_obj->game_status_update($game_id,'1');
			 }
    } ?>
<?php if($currentTime > $game_start_time && $currentTime < $end_date)  { ?>
<script type="text/javascript">
		var clock;
		var game_id = '<?php echo $id ?>';
		$(document).ready(function() {
    // Set dates.
	var game_end_time = '<?php echo $end_date;?>';//alert(game_start_time);
    var futureDate  = new Date(game_end_time); //alert(futureDate);
    var currentDate = new Date('<?php echo $currentTime;?>');
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
	
	if(diff < 50) {
		//alert('hi');
    	document.getElementById("subbtn").disabled = true;
		document.getElementById("cnl_btn").disabled = true;
	}
	if(diff < 0) {
    	diff = 0;
	}
	
		 // Instantiate a coutdown FlipClock
    clock = jQuery('.clock').FlipClock(diff, {
    	clockFace: 'MinuteCounter',
    	countdown: true,
    	callbacks: {
    		stop: function() {
    			document.getElementById("subbtn").disabled = true;
				 document.getElementById("cnl_btn").disabled = true;
				 window.setTimeout(function(){location.reload()},2000);
						//$('#countdown1').hide();
					}
				}
			});
});

</script>
<?php }?>
<?php if($currentTime >= $stop_bid_time) {
$game_status = $user_obj->game_status($game_id);
if($game_status !='3')
{
$user_obj->game_status_update($game_id,'3');
}
?>
<?php if($_SESSION['sound_noti']==1)
{?>
<div id="alert-sound">
<audio id="audioplayer" autoplay=true>
    <source src="sound/ping.mp3" type="audio/mpeg">
   <source src="sound/ping.ogg" type="audio/ogg">
</audio>
</div>
<?php }?>
<script type="text/javascript">
		$(document).ready(function() {
				var game_id = '<?php echo $id ?>';
				var user_id = '<?php echo $uid ?>';
				$.ajax({  
								type: "POST",
								dataType: "text",
								url: "game_winning_no.php",
								data: "game_id=" + game_id + "& user_id=" + user_id, 
								success: function(rr){
								$("#message1").html(rr);
								  //location.reload();
								 // window.setTimeout(function(){location.reload()},500);
							},
							error:function(jqXHR, textStatus, errorThrown){
							//alert("Error type" + textStatus + "occured, with value " + errorThrown);
						}
					});
	});
</script>
<?php }?>
<script>
/*For Bet on last game bet*/
$('#last_bet_no').click(function(){
	 	 //var pp ='<?php echo json_encode($table_data);?>';
		 <?php foreach ($obj as $character) {?>
			  var pay_amt ='<?php echo $character['bid_no'];?>';
		      var FinalValue = '<?php echo $character['bid_amount'];?>';
		     document.getElementById("payout_amount"+ pay_amt).value =FinalValue;
		 <?php } ?>		 
		 todo();
});
</script>
<script>
	  $('#cnl_btn').click(function(){
		  var game_id = '<?php echo $id ?>';
		  var user_id = '<?php echo $uid ?>';
		  var rem_coins = document.getElementById("rem_coins").value;
		  $.ajax({  
								type: "POST",
								dataType: "text",
								url: "cancel_bid.php",
								data: "game_id=" + game_id + "& user_id=" + user_id + "& rem_coins=" + rem_coins,
								success: function(tt){
							     $("#message1").html(tt);
							     window.setTimeout(function(){location.reload()},1000);
							},
							error:function(jqXHR, textStatus, errorThrown){
							//alert("Error type" + textStatus + "occured, with value " + errorThrown);
						}
					});
		  
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	var freeze_bid_time ='<?php echo $freeze_bid_time;?>';
	window.setInterval(function(){
	$.ajax({  
		type: "POST",
		dataType: "text",
		url: "game_freeze.php",
		data: "name=" + name,  
		success: function(rr){
			var res = rr;
			if(freeze_bid_time < res)
			{
				$("#subbtn").css("display", "none");
				$("#cnl_btn").css("display", "none");
				  $("#freez_alert").show();
				
			}
				},
		});
        }, 2000);
});
</script>
<script  src="js/custome/increment_bids.js"></script>
<script  src="js/custome/auto-bid-quick-options.js"></script>
<?php require_once('js/custome/ajax_submit_bid_js.php');?>
<script  src="js/custome/allow_numbers.js"></script>
<script  src="js/index.js"></script>
<!-- Code for chat box -->
<script>
    var siteurl = '<?php echo $config['site_url']; ?>';
    var session_uname = '<?php echo $sesUsername; ?>';
    var session_img = '<?php echo $ses_picname; ?>';
</script>
<!--ZeChat Box CSS-->
<link type="text/css" rel="stylesheet" media="all" href="app/includes/chatcss/chat.css" />
<!--ZeChat Box CSS-->
<script type="text/javascript" src="chat/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- Media Uploader -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<!-- Zechat js -->
<script type="text/javascript" src="app/plugins/smiley/js/emojione.min.js"></script>
<script type="text/javascript" src="app/plugins/smiley/smiley.js"></script>
<script type="text/javascript" src="app/includes/chatjs/lightbox.js"></script>
<script type="text/javascript" src="app/includes/chatjs/chat.js"></script>
<script type="text/javascript" src="app/includes/chatjs/custom.js"></script>
<script type="text/javascript" src="app/plugins/uploader/plupload.full.min.js"></script>
<script type="text/javascript" src="app/plugins/uploader/jquery.ui.plupload/jquery.ui.plupload.js"></script>
<?php require_once('contact-list.php');?>
<!-- End Code for chat box -->
<script>
    $(window).load(function() {
        $('.Dboot-preloader').addClass('hidden');
    });
</script>
</body>
</html>