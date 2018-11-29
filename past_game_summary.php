<!-- User Bids -->
<div class="container">
<div class="row">
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