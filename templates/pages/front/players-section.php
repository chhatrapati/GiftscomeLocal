<section class="newproduct bgwhite p-t-45 p-b-105">
<div class="container">
<div class="sec-title p-b-60">
<h1 class="m-text5 t-center" style="text-align:center">Top Players</h1>
</div>
<div class="row">
<!-- *******************************************Players Of Month************************************************** -->
<div class="col-sm-4 col-md-4 col-lg-3 text-center plm" style="border:2px solid #08a6cc">
 <div class="item-slick2 p-l-15 p-r-15">
	<h5 style="padding-top:20px;padding-bottom:5px;text-align:center;font-family:poppins-bold">Player of the month</h5>
	<hr>
	<!-- Block2 -->
	<div class="block2">
	<?php
	$sql_09 = $user_obj->player_of_month($id_user);
	$result_09=mysqli_fetch_array($sql_09);
	$id_user= $result_09['user_id'];
	$total_bid_amount= $result_09['total_bid_amount'];
	$total_won= $result_09['total_won'];
	$details_user = $user_obj->user_detail_byid($id_user);
	$user_type = $details_user['user_type'];
	//print_r($result_09);?>
	   <div class="block2-img wrap-pic-w of-hidden pos-relative <?php if($user_type=='vip'){?>block2-labelnew <?php }?>">
	   <?php if($details_user['social_id']!=''){ if (strpos($pic, 'https') !== false) {?>
     <img src="<?php echo $details_user['user_picture'];?>"  alt="Player of month" class="plm-user-img" style="text-align:center">
	 <?php }}	if($details_user['user_picture'] == ""){ ?>	
	 <img src="users-images/user.png" alt="Player of month" class="plm-user-img" style="text-align:center">
     <?php }else {?>
	 <img src="users-images/<?php echo $details_user['user_picture'];?>"  alt="Player of month" class="plm-user-img" style="text-align:center">
	 <?php }?>
		  <div class="block2-overlay trans-0-4">
			<!-- <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
			 <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
			 <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
			 </a>-->
			 
		  </div>
	   </div>
	   <div class="block2-txt p-t-20">
		  <a href="user-profile.php?user=<?php echo toPublicId($id_user);?>" class="block2-name dis-block s-text3 p-b-5">
			 <h5><?php echo $details_user['name'];?></h5>
		  </a>
		  <span class="block2-price  p-r-5">
			 <div style="color:#666;">Total Bids: <span style="color:#0daacf"><img alt="Game Coins" src="images/icons/bid.png" width="20" height="20"> <?php echo $total_bid_amount;?></span></div>
			 <div style="color:#666;">Total Wons: <span style="color:#e82a1b"><img alt="Game Coins" src="images/icons/won.png" width="20" height="20"><?php echo $total_won;?></span></div>
		  </span>
	   </div>
	</div>
 </div>
</div>
<div class="col-sm-8 col-md-8 col-lg-9">
 <section id="tabs">
	<div class="container-fluid">
	   <div class="row">
		  <div class="col-xs-12 ">
			 <nav>
				<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
				   <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Top Players</a>
				   <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">New Player</a>
				   <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Top Rated</a>
				   <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Most Popular</a>
				</div>
			 </nav>
			 <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
				<!--********* ***********************Top Players******************************************************* -->
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				   <div class="row">
					  <?php $winners = $user_obj->get_winners(12);
						 $i = 0;	
						 while ($winner = mysqli_fetch_array($winners)){
							 $user_id = $winner['user_id'];
							 $total_bids = $winner['total_bid_amount'];
							 $total_won = $winner['total_won'];
							 $win_date = $winner['create_date'];
							 /*Get user detail by id*/
							 $user_detail = $user_obj->user_detail_byid($user_id);
							$i ++; 
							if ($total_bids=='')
							{
								$total_bids ='0000';
							}
							$total_won = $user_obj->total_coins_won($user_id);
							if ($total_won=='')
							{
								$total_won ='0000';
							}
						  if($i==6) 
						  {
							echo '<div class="col-sm-2" style="display:none"></div>';
							$i = 0;
						  }
							?>
					  <div class="col-sm-4 col-xs-6 col-md-3 col-lg-2 win_img text-center">
						 <?php if($user_detail['social_id']!=''){
							if (strpos($pic, 'https') !== false)
							{?>
						 <img src="<?php echo $user_detail['user_picture'];?>"  width="100px" height="100px">
						 <?php }
							}if($user_detail['user_picture'] == ""){ ?>
						 <img src="users-images/user.png" width="100px" height="100px">
						 <?php }else {?>
						 <img src="users-images/<?php echo $user_detail['user_picture'];?>" width="100px" height="100px">
						 <?php }?>
						 <h6 class="topname text-center" style="margin:0;"><a class="name-player" href="user-profile.php?user=<?php echo toPublicId($user_id);?>"><?php echo $user_detail['name'];?></a></h6>
						 <div class="coin_display text-center">
							<div class="total_b">Total Bids: <span style="color:#0daacf"> 
							   <?php echo $total_bids;?></span>
							</div>
							<div class="total_b">Total Wons: <span style="color:#e82a1b"> 
							   <?php echo $total_won;?></span>
							</div>
						 </div>
					  </div>
					  <?php }?>
				   </div>
				</div>
				<!--*********************************New Playe******************************************************* -->
				<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				   <div class="row">
					  <?php $data = $user_obj->get_new_user();	
						 while($row=mysqli_fetch_array($data)){	
							$user_id =$row['id'];
							$total_bids = $user_obj->total_bids_byuser_byallgames($user_id);
							if ($total_bids=='')
							{
								$total_bids ='0000';
							}
							$total_won = $user_obj-> total_coins_won($user_id);
							if ($total_won=='')
							{
								$total_won ='0000';
							}
							?>	
					  <div class="col-sm-4 col-xs-6 col-md-3 col-lg-2 win_img text-center">
						 <?php if($row['social_id']!=''){
							if (strpos($pic, 'https') !== false)
								{?>
						 <img src="<?php echo $row['user_picture'];?>"  width="100px" height="100px">
						 <?php }
							}																
							if($row['user_picture'] == ""){ ?>
						 <img src="users-images/user.png" width="100px" height="100px">
						 <?php }else {?>
						 <img src="users-images/<?php echo $row['user_picture'];?>" width="100px" height="100px">
						 <?php }?>
						 <h6 class="topname text-center" style="margin:0; "><a class="name-player" href="user-profile.php?user=<?php echo toPublicId($user_id);?>" >	
							<?php echo $row['name'];?>
							</a>
						 </h6>
						 <div class="coin_display text-center">
							<div class="total_b">Total Bids: <span style="color:#0daacf"> 
							   <?php echo $total_bids;?></span>
							</div>
							<div class="total_b">Total Wons: <span style="color:#e82a1b"> 
							   <?php echo $total_won;?></span>
							</div>
						 </div>
					  </div>
					  <?php }?>
				   </div>
				</div>
				<!--********************************Top Rated******************************************************* -->
				<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
				   <div class="row">
					  <?php $data = $user_obj->get_Popular_user();	
						 while($mpu=mysqli_fetch_array($data)){	
							$user_id =$mpu['id'];
							$total_bids = $user_obj->total_bids_byuser_byallgames($user_id);
							if ($total_bids=='')
							{
								$total_bids ='0000';
							}
							$total_won = $user_obj-> total_coins_won($user_id);
							if ($total_won=='')
							{
								$total_won ='0000';
							}
							?>	
					  <div class="col-sm-4 col-xs-6 col-md-3 col-lg-2 win_img text-center">
						 <?php if($mpu['social_id']!=''){
							if (strpos($pic, 'https') !== false)
								{?>
						 <img src="<?php echo $mpu['user_picture'];?>"  width="100px" height="100px">
						 <?php }
							}																
							if($mpu['user_picture'] == ""){ ?>
						 <img src="users-images/user.png" width="100px" height="100px">
						 <?php }else {?>
						 <img src="users-images/<?php echo $mpu['user_picture'];?>" width="100px" height="100px">
						 <?php }?>
						 <h6 class="topname text-center" style="margin:0; "><a class="name-player" href="user-profile.php?user=<?php echo toPublicId($user_id);?>">	
							<?php echo $mpu['name'];?>
							</a>
						 </h6>
						 <div class="coin_display text-center">
							<div class="total_b">Total Bids: <span style="color:#0daacf"> 
							   <?php echo $total_bids;?></span>
							</div>
							<div class="total_b">Total Wons: <span style="color:#e82a1b"> 
							   <?php echo $total_won;?></span>
							</div>
						 </div>
					  </div>
					  <?php }?>
				   </div>
				</div>
				<!--*********************************Most Popular Player******************************************************* -->
				<div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
				   <div class="row">
					  <?php $data = $user_obj->get_Popular_user();	
						 while($mpu=mysqli_fetch_array($data)){	
							$user_id =$mpu['id'];
							$total_bids = $user_obj->total_bids_byuser_byallgames($user_id);
							if ($total_bids=='')
							{
								$total_bids ='0000';
							}
							$total_won = $user_obj-> total_coins_won($user_id);
							if ($total_won=='')
							{
								$total_won ='0000';
							}
							?>	
					  <div class="col-sm-4 col-xs-6 col-md-3 col-lg-2 win_img text-center">
						 <?php if($mpu['social_id']!=''){
							if (strpos($pic, 'https') !== false)
								{?>
						 <img src="<?php echo $mpu['user_picture'];?>"  width="100px" height="100px">
						 <?php }
							}																
							if($mpu['user_picture'] == ""){ ?>
						 <img src="users-images/user.png" width="100px" height="100px">
						 <?php }else {?>
						 <img src="users-images/<?php echo $mpu['user_picture'];?>" width="100px" height="100px">
						 <?php }?>
						 <h6 class="topname text-center" style="margin:0; "><a class="name-player" href="user-profile.php?user=<?php echo toPublicId($user_id);?>">	
							<?php echo $mpu['name'];?>
							</a>
						 </h6>
						 <div class="coin_display text-center">
							<div class="total_b">Total Bids: <span style="color:#0daacf"> 
							   <?php echo $total_bids;?></span>
							</div>
							<div class="total_b">Total Wons: <span style="color:#e82a1b"> 
							   <?php echo $total_won;?></span>
							</div>
						 </div>
					  </div>
					  <?php }?>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
 </section>
</div>
</div>
</div>
</section>