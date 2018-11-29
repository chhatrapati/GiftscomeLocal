<?php session_start();
include('includes/config.php');
//include('includes/function.php');
$user_obj = new Cl_User();
$game_id=toInternalId($_GET['game']);
if(strlen($_SESSION['login'])==0)
{   
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
	<title>Play Game</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once('templates/common_css.php');?>
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.css'>
	<style>
	@media only screen and (max-width: 768px) {
					.Medi{display:none;
					}
					}
	@media only screen and (min-width: 768px) {
	              #mySelect{display:none;
				  }
			   }	
	body, html {
		height: 100%;
		font-family: Poppins-bold !important;
	  font-weight: 400;	
	}
	.checkbox-inline+.checkbox-inline, .radio-inline+.radio-inline {
    margin-top: 0;
    margin-left: 10px;
}
input:checked {
    height: 13px;
    width: 13px;
    color: #08a6cc;
}
.btn-dng {
    color: #fff;
    background-color:#079992;
    border-color: #78e08f;
    height: 37px;
}
.btn-suc {
    color: #fff;
    background-color: #218838;
    border-color: #1e7e34;
	height:37px;
}
.button-main {
    /*position: absolute;
    top: 1px;
    left: 49px;*/
}
 .playgme{
  color:#08a6cc;
  font-family:Montserrat-bold;
  text-align:center;
  
 }
 
 .pay1{
	text-align: center;
    background-image: url(images/balls.png);
    background-size: 12%;
    background-repeat: no-repeat;
    background-position: center;
}
 }
 .pay{
	 text-align:center;
	
 }
 #freez_alert
 {
	position: absolute; z-index: 500; opacity: 0.9; display: none;color: #fff;background-color: #dc3545;border-color: #dc3545;padding:10px; 
 }
 .form-horizontal .controls {
        margin-left: 50px;
    margin-bottom: 10px;
	padding:0;
}
.digit_img
{
	margin-left: 0;
}
.col-md-3 {float:left;width:25%;}
.form-control {border: 1px solid rgba(0,0,0,.15) !important;border-radius:.25rem !important;}

</style>
</head>
<body class="animsition" onload="todo_new()">
	<?php require_once('templates/header.php');?>
	<!-- Title Page -->
	<!--<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
		<h2 class="l-text2 t-center">
			Game Zone
		</h2>
	</section>-->
	<!-- content page -->

<section class=" p-t-33 p-b-38" style="background-image:url(images/gamezone2.png); ">
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
			'<br/>Game Start time is: '.$game_start_time;
			$game_duration = $row['game_duration'];
			
			//set timezone
			//date_default_timezone_set('UTC');
			//set an date and time to work with
			//$start = '2014-06-01 14:00:00';
			//display the converted time
			$end_date = date('Y-m-d H:i:s',strtotime('+'.$game_duration.' minutes',strtotime($game_start_time)));
			'<br/>End time is: '.$end_date;
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

	<!-- panel-heading -->
	<div id="" class="col-md-12">
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
				<div class="col-md-12 col-sm-12 already-registered-login coin-balance">
					<div class="row col-md-12 form-group">
						<?php
						date_default_timezone_set('UTC');// change according timezone
						$currentTime = date( 'Y-m-d H:i:s', time () );
					?>
				</div>
				<!--</form>-->
				<style>
				.pay2 {
					color: #1f1f1e;
					font-size: 41px;
					
					background-color: #fff;
					border-radius: 20%;
					padding-left: 10px;
					padding-right: 10px;
					border:2px solid yellow;
				}
				.custom-table tr th{
					font-size: 14px;
				}
				.custom-table tr td{
					font-size: 14px;
					line-height:0 !important;
				}
				   input.num-product {
					   height:100%;
				   }
				@media only screen and (max-width: 700px) {
					input.num-product{
						height:30%;
					}
}
			</style>
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
									
									/*Previous game id*/
											$query1 = "SELECT * FROM tbl_game where game_status=3  and is_active =1 order by id desc limit 1";
											$result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
											$row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
											$id_pre_game = $row1['id'];
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
		 
			<h1 style="text-align:center;font-size:26px;padding-top:1%; color:#fff;">
				<?php if($currentTime < $game_start_time) {?>
				<?php echo $game_name;?> starts in
				<?php } ?>
				<?php if($currentTime >= $game_start_time  && $currentTime <= $end_date ) {?>
				<?php echo $game_name;?> ends in:-
				<?php } ?>
			</h1>
			<div class="clock" id="countdown1" style=" display: flex;justify-content: center;align-items: center; padding-top:15px;padding-bottom:1px"></div>
			<div id='loadingmessage' style='display:none;text-align: center;padding-top:15px;padding-bottom:1px'>
			 <img src='images/loading5.gif' style="position:absolute;z-index:10000;"/>
			</div>
			<div class="" id="message1" style=" display: flex;justify-content: center;align-items: center; padding-top:15px;padding-bottom:1px; color:#fff !important;"></div>
			<div class="alert alert-danger alert-dismissible" id="danger" style="display:none;width:50%;">
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
		</div></div>
		
		</div>
		<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" style="z-index:99999;">
  <div class="modal-dialog modal-lg" style="max-width:60%;">
<?php require_once('set-auto-bid-form.php');?>
  </div>
</div>
		
 <div class="row">
		        <div class="col-lg-10 col-sm-10 col-md-10 text-left Medi">
				    <button type="button" class="btn btn-warning bt" name="all_no" id="all_no" value="ALL">ALL</button>
					<button type="button" class="btn btn-success bt" name="odd_no" id="odd_no" value="ODD">ODD</button>
					<button type="button" class="btn btn-danger bt" name="even_no" id="even_no" value="EVEN">EVEN</button>
				
			         <button type="button" class="btn btn-info bt" id="middle_no">MIDDLE (10-17)</button>
					 <input type="hidden" name="pre_btn" class="bt" id="pre_btn" value=""/>
					 <button type="button" class="btn btn-info bt" id="side_no">SIDE (00-09,18-27)</button>
					 <button type="button" class="btn btn-info bt" id="small_no">SMALL (00-13)</button>
				    <button type="button" class="btn btn-info bt" id="big_no">BIG (14-27)</button>
				    
					<button type="button" class="btn btn-success bt" id="random_no">RANDOM</button>					
				 	<?php if($obj){?><button type="button" class="bt btn btn-info" id="last_bet_no">LAST BET</button>
				 <?php }?><button type="button" class="btn btn-warning bt" id="reverse_no">REVERSE BET</button>
				 <button type="button" class="btn btn-info btn" data-toggle="modal" data-target="#myModal" id="">Set Auto Bid</button>	
				 </div>
				
				<select id="mySelect"> 
						<option value="" selected="selected">Select Bet Options</option> 
						<option class="btn btn-warning bt" name="all_no" id="all_no" value="ALL">ALL</option> 
						<option class="btn btn-success bt" name="odd_no" id="odd_no" value="ODD">ODD</option> 
						<option class="btn btn-danger bt" name="even_no" id="even_no" value="EVEN">EVEN</option>
						<option class="btn btn-info bt" id="middle_no">MIDDLE (10-17)</option> 
						<option class="btn btn-info bt" id="side_no">SIDE (00-09,18-27)</option> 
						<option class="btn btn-info bt" id="small_no">SMALL (00-13)</option>
                        <option class="btn btn-info bt" id="big_no">BIG(14-27)</option>			
						<option class="btn btn-info bt" id="random_no">RANDOM</option>
                        <?php if($obj){?><option class="btn btn-info bt" id="last_bet_no">LAST BET</option>  <?php }?>
						<option class="btn btn-info bt" id="reverse_no">REVERS BET</option>   						
				</select>
							<select id="mySelect"> 
						<option value="" selected="selected">Multiplier</option> 
						<option class="btn btn-basic btn_mul " disabled>Multiply Your Bids<i class=" fa fa-hand-o-right"></i></option> 
						<option class="btn btn-default bt2" id="half_mb">0.5<i class="fa fa-window-close" aria-hidden="true"></i></option> 
						<option class="btn btn-default bt2" id="onendhalf_mb">1.5<i class="fa fa-window-close" aria-hidden="true"></i></option>
						<option class="btn btn-default bt2" id="double_mb">2<i class="fa fa-window-close" aria-hidden="true"></i></option> 
						<option class="btn btn-default bt2" id="five_mb">5<i class="fa fa-window-close" aria-hidden="true"></i></option> 
						<option class="btn btn-default bt2" id="ten_mb">10<i class="fa fa-window-close" aria-hidden="true"></i></option>
                        <option class="btn btn-default bt2" id="fifteen_mb">15<i class="fa fa-window-close" aria-hidden="true"></i></option>			
						<option class="btn btn-default bt2" id="twenty_mb">20<i class="fa fa-window-close" aria-hidden="true"></i></option>
                        <option class="btn btn-default bt2" id="twentyfive_mb">25<i class="fa fa-window-close" aria-hidden="true"></i></option> 					
				</select>
				<div class="col-lg-2 col-sm-2 col-md-2 text-left"> 
				 
					<div class="text-right">
						<input type="hidden" class="" id="prev_bets" value="<?php echo $total_bets;?>">
						<label style="padding-top:7px; color:#fff;">Current Bet :</label><input type="text" class="width-dynamic proba dva text-center" min="0" name="total_bids_" id="total_bids" value="" style="align-self: center;min-width: 100px;width: 41px;margin-left: 10px;" disabled>
						<label style="padding-top:7px; color:#fff;">Coin Balance :</label><input type="text" class="width-dynamic proba dva text-center" min="0" name="gift_coins" id="gift_coins" value="<?php echo $_SESSION['gift_coins'];?>" style="align-self: center;min-width: 100px;margin-left: 10px;width: 49px;" disabled>
					<input type="hidden" id="rem_coins" name="rem_coins" value="">
					<input type="hidden" id="gift_coins_bal_final" name="gift_coins_bal_final" value="<?php echo $_SESSION['gift_coins'];?>">
			</div>
			</div>
		 </div>
	   <br>
	<div class="" style="padding-bottom: 3px;">
		<div class="row" > 
		<div class="col-lg-7 Medi" style="padding-left:25px; ">
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
		          <div class="col-lg-5 text-right ">
				<!--<label style="padding-top:7px; color:#fff;">Total Bets :</label><input type="text" class="width-dynamic proba dva text-center" min="0" name="total_bids" id="total_bids" value="<?php //echo $total_bets;?>" style="align-self:center;min-width: 100px; max-width: 500px; margin-left:10px;" disabled>-->
		        <button type="button" id="clear" class="btn btn-warning btn_act">Clear All</button>
				<button type="button" id="subbtn" class="btn btn-success btn_act"">Submit</button>		
				<button type="button" name="" id="cnl_btn" class="btn btn-danger btn_act" value="cancel" onClick="return confirm('Are you sure you want to cancel your bet?')">Cancel Bet</button>
				</div>
		</div>
	</div>
					<div class="row">
						<div class="col-lg-6">
							<form name="" method="post" action="" id="game_zone">
								<div class="block1 hov-img-zoom pos-relative m-b-30" style="border-bottom:1px solid #08a6cc;">
									<h1 class="list-heading">
										<div class="row">
											<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">NUMBER</div>
											<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">PREVIOUS PAYOUT <img src="images/logo-2.png" class="gift"></div>
											<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">CURRENT PAYOUT<img src="images/logo-2.png" class="gift"></div>
											<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">YOUR BID</div>
										</div>
									</h1>
									<div>
										<ul class="heading">
											<?php
											$query=mysqli_query($con,"select * from tbl_game_payout where game_id = '$id' LIMIT 14");
											$no=0;while($row=mysqli_fetch_array($query)) {

												$payout_digit = $row['payout_digit'];
												$sql22 = mysqli_query($con,"select payout_amount FROM tbl_game_payout WHERE game_id ='$id_pre_game' AND payout_digit ='$payout_digit' ;");
												$result=mysqli_fetch_array($sql22);
												$pre_payout_amt =$result['payout_amount'];
												?>
												
												<li>
													<div class="row">
														<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 size8 gz_digit"><div class="back-img"><?php echo $row['payout_digit'];?></div></div>
														<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 size8">
															<div class="row">											
																<div class="col-md-12"><?php echo $pre_payout_amt;?> </div>
															</div>
														</div>
														<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 size8">
															<div class="row">
																<div class="col-md-12"><?php echo $row['payout_amount'];?> </div>
															</div>
														</div>														
														<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 size8 ">
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
																	<div class="">
																
																	<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2 btn btn-dng d-inline-block" id="minus<?php echo $row['payout_digit'];?>" >
																		<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
																	</button>
																	
																	<input class="size8 m-text18 t-center num-product d-inline-block" type="number" pattern="[0-9]" name="payout_amount<?php echo $row['payout_digit'];?>" id="payout_amount<?php echo $row['payout_digit'];?>" value="<?php echo $bid_amount_on_digit;?>" maxlength="5" onkeypress="return AllowOnlyNumbers(event);" onkeyup="todo_new()">
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
									<div class="block1 hov-img-zoom pos-relative m-b-30" style="border-bottom:1px solid #08a6cc;">
										<h1 class="list-heading">

											<div class="row">
											<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">NUMBER</div>
											<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">PREVIOUS PAYOUT <img src="images/logo-2.png" class="gift"></div>
											<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">CURRENT PAYOUT<img src="images/logo-2.png" class="gift"></div>
											<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">YOUR BID</div>
											</div>
										</h1>
										<div>
											<ul class="heading">
												<?php $query=mysqli_query($con,"select * from tbl_game_payout where game_id = '$id' LIMIT 14 OFFSET 14");
												$no =14; while($row=mysqli_fetch_array($query)) { 
													$payout_digit = $row['payout_digit'];
													$sql33 = mysqli_query($con,"select payout_amount FROM tbl_game_payout WHERE game_id ='$id_pre_game' AND payout_digit ='$payout_digit' ;");
													$result33=mysqli_fetch_array($sql33);
													$pre_payout_amt =$result33['payout_amount'];
													?>
													<li>
														<div class="row">
															<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 size8"><div class="back-img"><?php echo $row['payout_digit'];?></div></div>
															<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 size8">
																<div class="row">


																	<div class="col-md-12">
																		<?php echo $pre_payout_amt;?>
																	</div>
																</div>
															</div>
															<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 size8">
																<div class="row">

																	<div class="col-md-12">
																		<?php echo $row['payout_amount'];?>
																	</div>
																</div>
															</div>															
															<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 size8">
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

																	<div class="">
																		<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2 btn btn-dng d-inline-block"  id="minus<?php echo $row['payout_digit'];?>" >
																			<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
																		</button>
																		<input class="size8 m-text18 t-center num-product d-inline-block"  pattern="[0-9]" name="payout_amount<?php echo $row['payout_digit'];?>" type="number" id="payout_amount<?php echo $row['payout_digit'];?>"  min="0" maxlength="5" value="<?php echo $bid_amount_on_digit;?>" onkeypress="return AllowOnlyNumbers(event);" onkeyup="todo_new()">
																	
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
			
								<!-- <li>
									<div class="row">
										<div class="col-lg-5"></div>
										<div class="col-lg-1" style="padding:10px" ><button type="button" id="subbtn" class="btn btn-success">Submit</button></div>
										<div class="col-lg-1" style="padding:10px"><button type="button" name="cancel" id="cnl_btn" class="btn btn-danger" value="cancel" onClick="window.location='game_zone.php';" />Cancel</button></div>
										<div class="col-lg-5"></div>
									</div>
								</li> -->
							</div>
						</form>
					</div>
				</div><?php }?>
			</section>
			<?php require_once('templates/footer.php');?>
			<?php require_once('templates/common_js.php');?>
			<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
			<script src='https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.min.js'></script>
			<script src='https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.js'></script>

			<script>
				$(document).ready(function() {

				});
			</script>


			<?php if($currentTime < $game_start_time) {?>
			<script type="text/javascript">
				var clock;

				$(document).ready(function() {
				
    // Set dates.
    var game_start_time = '<?php echo $game_start_time;?>';
    var futureDate  = new Date(game_start_time); //alert(futureDate);
    var currentDate = new Date('<?php echo $currentTime;?>');//alert(currentDate);
	//var currentDate = '<?php echo $currentTime;?>';
	//alert(currentDate);
	

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

    /*if (currentDate== futureDate) {
		alert('hi');
		window.setTimeout(function(){location.reload()},100);
	}*/

    // Instantiate a coutdown FlipClock
    clock = $('.clock').FlipClock(diff, {
     //clockFace: 'MinuteCounter',
     countdown: true,
     callbacks: {
     	stop: function() {
						//alert('hi');
						//location.reload();
						window.setTimeout(function(){location.reload()},2000);
					}
				}
			});


	/* window.setInterval(function(){
	var currentDate2 = new Date(Date.now());	
	var diff2 =  ((currentDate2.getTime() - 19800857) - futureDate.getTime()) / 1000;
		  /// call your function here
		  // console.log("current date - "+ currentDate + " - " + currentDate.getTime());
		 //  console.log("current date2 - "+ currentDate2 + " - " + currentDate2.getTime());
		 //  console.log("future date - "+ futureDate + " - " + futureDate.getTime());
		//   console.log("difference - "+ diff2);	  
		  
		 if(diff2 >= 0){
		   location.reload();
		 }else{
		 }
		}, 2000);*/

	});




</script>
<?php } ?>
<?php if($currentTime == $game_start_time){?>
<script type="text/javascript">
//alert('hi');
		//window.setTimeout(function(){location.reload()},100);
</script>
<?php }?>
	<?php if($currentTime > $game_start_time && $currentTime < $end_date)  {
	     $game_status = $user_obj->game_status($game_id);
	 if($game_status !='1')
	 {
     $user_obj->game_status_update($game_id,'1');
	 }
		?>
	<script type="text/javascript">
		$(document).ready(function() {
			window.setInterval(function(){
	$.ajax({  
		type: "POST",
		dataType: "text",
		url: "update_game_payout.php",
		data: "game_id=" + game_id,  
		success: function(rr){
				 //alert(rr);
				  //alert("Record successfully updated");
				  $("#message1").html(rr);
				},
				error:function(jqXHR, textStatus, errorThrown){
				//alert("Error type" + textStatus + "occured, with value " + errorThrown);
			}
		});
       /// call your function here
      //random_no();
}, 10000);  // Change Interval here to test. For eg: 5000 for 5 sec
		});
	</script>
	<?php }?>
	<?php if($currentTime > $game_start_time && $currentTime < $end_date)  { ?>
	<script type="text/javascript">
		var clock;
		var game_id = '<?php echo $id ?>';
		$(document).ready(function() {
    // Set dates.
	var game_end_time = '<?php echo $end_date;?>';//alert(game_start_time);
    var futureDate  = new Date(game_end_time); //alert(futureDate);
    var currentDate = new Date('<?php echo $currentTime;?>');
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
	
	if(diff < 50) {
		//alert('hi');
    	document.getElementById("subbtn").disabled = true;
		document.getElementById("cnl_btn").disabled = true;
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
			//window.setInterval(function(){
				var game_id = '<?php echo $id ?>';
				var user_id = '<?php echo $uid ?>';
				//var rem_coins = document.getElementById("rem_coins").value;
				$.ajax({  
								type: "POST",
								dataType: "text",
								url: "game_winning_no.php",
								data: "game_id=" + game_id + "& user_id=" + user_id, 
								success: function(rr){
							 //alert(rr);
							  //alert("Record successfully updated");
							  $("#message1").html(rr);
							  //location.reload();
							 // window.setTimeout(function(){location.reload()},500);
							},
							error:function(jqXHR, textStatus, errorThrown){
							//alert("Error type" + textStatus + "occured, with value " + errorThrown);
						}
					});
//}, 5000);  // Change Interval here to test. For eg: 5000 for 5 sec
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
							 //alert(rr);
							  //alert("Record successfully updated");
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
	//alert(freeze_bid_time);
	$.ajax({  
		type: "POST",
		dataType: "text",
		url: "game_freeze.php",
		data: "name=" + name,  
		success: function(rr){
			var res = rr;
			//alert(res);
			if(freeze_bid_time < res)
			{
				$("#subbtn").css("display", "none");
				$("#cnl_btn").css("display", "none");
				//alert("Your bet can't be placed");
				  $("#freez_alert").show();
				
			}
				},
		});
        }, 2000);  // Change Interval here to test. For eg: 5000 for 5 sec
});
</script>
<script  src="js/custome/increment_bids.js"></script>
<script  src="js/custome/auto-bid-quick-options.js"></script>
<?php require_once('js/custome/ajax_submit_bid_js.php');?>
<script  src="js/custome/allow_numbers.js"></script>
<script  src="js/index.js"></script>
</body>
</html>