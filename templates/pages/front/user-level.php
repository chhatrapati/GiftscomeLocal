<?php if(isset($_SESSION['name']) && $_SESSION['name']){
		$uid = $_SESSION['id'];?>
				<!-- ******************************************* Section For Player Level************************************************** -->	
				<section  CLass="level_section">		
				<div class="container">
				<div class="row">	
					<div class="col-md-3 col-xs-12 text-center">
						<div class="col-md-12 ">	
						<?php $user_detail = $user_obj-> user_detail_byid($uid);?>
						<?php $pic = $row['user_picture'];								  									
						if($user_detail['user_picture'] == ""){ ?>
						<img src="users-images/user.png" width="170" height="170" class="User_level">
						<?php }elseif (strpos($pic, 'https') !== false) {?>
						<img src="<?php echo $user_detail['user_picture'];?>" width="170" height="170" class="User_level">
						<?php } else {?>
						<img src="users-images/<?php echo $user_detail['user_picture'];?>" width="170" height="170" class="User_level">
						<?php }?>
						</div>
					<div class="col-md-12">
					<span>
					<p class="lvtext2"><?php echo $user_detail['name'];?></p>
					<p class="lvtext1"> Member Since: <?php	$create_date = $user_detail['regDate'];
					echo date('M-y',strtotime($create_date));?>
					</p>
					</span>
					</div>
					</div>
				<div class="col-md-9 col-xs-12 text-center">
				<div class="col-md-12 text-center"><span style="color:#000">Nice To See You Back! Lets Play The Next Game & Redeem Gifts</span></div>
					<div class="col-md-12 text-center">
					<?php $user_level = $user_obj-> get_level_point($uid); //echo '<pre>';print_r($user_level);?>
														               
					</div>
				<div class="row">
				<div class="col-md-12 col-xs-12 col-sm-11 ulevel" > 
					<div class="arrow-steps clearfix">										
					<?php                                 
					$userlevelids=array();	
					$index=1;
					$sql = mysqli_query($con, "SELECT * FROM user_levels")or die(mysqli_error($con));
					while($result=mysqli_fetch_array($sql))
					{
					$user_levels_id =$result['user_levels_id'];
					$userlevelids[$index]=$user_levels_id;
					$user_levels_name =$result['user_levels_name'];
					$user_levels_complete =$result['user_levels_complete'];	
					$index++;							  
					?>
					<div class="step" id="Level<?php echo $user_levels_name;?>" data-points="<?php echo $user_levels_id;?>"><?php echo $user_levels_name;?></div>	
					<?php } ?>
				<?php
			        $userpoints='';
					$userpoints =$user_obj->user_total_points($uid);
		            $curr_lev= $user_level['user_level'];
					$sql1 = mysqli_query($con,"SELECT * FROM user_levels where user_levels_name='$curr_lev'")or die(mysqli_error($con));
					$result=mysqli_fetch_assoc($sql1);//print_r($result);
					$sub_lev1_points =$result['sub_lev1_points'];
					$sub_lev2_points =$result['sub_lev2_points'];
					$sub_lev3_points =$result['sub_lev3_points'];
					$sub_lev4_points =$result['sub_lev4_points'];
					$sub_lev5_points =$result['sub_lev5_points'];
			if($userpoints ==$sub_lev1_points || $userpoints < $sub_lev2_points )
					{
					$level_image ='images1.png';
					}
					if($userpoints >=$sub_lev2_points && $userpoints >$sub_lev1_points )
					{
					$level_image ='images2.png';
					}
					if($userpoints >=$sub_lev3_points && $userpoints >$sub_lev2_points)
					{
					$level_image ='images3.png';
					}
					if($userpoints >=$sub_lev4_points && $userpoints >$sub_lev3_points)
					{
					$level_image ='images4.png';
					}
					if($userpoints >=$sub_lev5_points && $userpoints >$sub_lev4_points)
					{
					$level_image ='images5.png';
					}
					?>
					<img src="admin/images/<?php echo $level_image;?>" width="30" height="30"  id="image_lev" style="display:none;" >
					<input type="hidden" id="users_points" value="<?php  echo $userpoints;?>">
					</div>
				<div class="nav clearfix" style="display:none; ">
				<a href="#" class="prev">Previous</a>
				<a href="#" class="next pull-right">Next</a>
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-3 col-xs-12 col-sm-3 py-0 ulevel">
				<?php 
				$total_games = $user_obj->total_games_byuser($uid);
				$total_wons = $user_obj->total_coins_won_byuser($uid);
				?>
				<p>Total Games Played : <strong class="levl3"><?php if($total_games!=''){ echo $total_games; } else {echo '0';}?></strong>  
				<p>Total Coins Earned : <strong class="levl3"><?php if($total_wons!=''){ echo number_format($total_wons); } else {echo '0';}?></strong>
				<!--<p><button type="submit" id="addMe" name="req_to_admin" class="btn-upper btn-sm btn-info">Request Coins</button></p>-->							
				</div>
				<div class="col-md-3 col-xs-12 py-0 col-sm-3 ulevel">
				<p class="" style="font-size:14px;">Total Points :&nbsp; <strong style="color:red; "><?php echo $user_detail['user_points'];?></strong></p>
				<?php if($user_level['user_level'] != 'God'){?>
				<p class="text-left" style="font-size:14px;">Just Needs <strong style="color:red; "> <?php echo $user_level['next_level'];?> Points</strong> To Acheive Next Level</p>
				<?php }?>
				</div>
				<div class="col-md-6 col-xs-12 py-0 col-sm-6 text-right ulevel" >
				<div class="col-xs-12 col-md-12 col-sm-12">
				<span class="ref-text my-2"><span class="" style="">Refer to friend</span>
				<div class="help-tip">
				<?php $coins_value_by_refer_code = $user_obj->coins_value_by_refer_code();?>
			<p>Invite your friends using your referal link.
				For spreading the love, you get a whole lot of goodness in return!
				We will credit your wallet balance by <?php echo $coins_value_by_refer_code;?> coins right after your friend registers on this website. You can use your coins whenever and however you’d like.
				Also, to help you friend get started, they will receive <?php echo $coins_value_by_refer_code;?> coins in their wallet upon registration. </p>
			    </div></span><br class="hidden-xs"/>
				<?php $ref_code = $user_obj->get_referal_code($uid);
					  $ref_url = ''.SITE_URL.'/register.php?ref='.$ref_code.'';
				?><br/>
				<span class="ref-link"><input type="text" value="<?php echo $ref_url;?>" id="ref_link" class="ref-link" readonly><button onclick="myFunction()" class="btn btn-custom btn-anim">Copy</button>
				 </div>									
				</div>
				<div class="col-xs-12 py-3  col-md-12 col-sm-12 req_daily">
				<?php 
				/*Count no of times daily login coins requested by user*/
				$cur_date= date("Y-m-d");
				$sql_98=  mysqli_query($con,"SELECT * FROM user_wallet  WHERE user_id='$uid' AND reason_mode_of_coins='By Redeem Daily Login Giftcoins' AND date_of_coins_get='$cur_date' ");
				$no_of_daily_login_req = mysqli_num_rows($sql_98);
				?>
				<div id="msg_1" style="display:none;"></div>
				<?php $curr_user= $user_obj->user_type($uid);
						if($curr_user=='vip'){?>
							VIP users automatically get their daily login rewards.
				<?php } else {?>
				Click to redeem your daily login giftcoins
				<?php if($no_of_daily_login_req<=0){?>
				<button type="submit" id="req_daily_login_coins" name="req_daily_login_coins" class="btn btn-custom btn-anim">Request Daily Login Giftcoins</button>
				<?php } else {?>
				<button type="button" id="" name="" class="btn btn-custom btn-anim al_req">Already Requested</button>
				<?php }}?>
				</div>
				<div class="col-md-7 col-xs-12 col-sm-3">
				<div class="col-xs-12 col-md-12 col-sm-12 ulevel">
				<?php $coins_value_social_share = $user_obj->coins_value_social_share();
				?>
				Daily sharing to social media and earn <?php echo number_format($coins_value_social_share);?> giftcoins<a class="btn btn-basic share-btnv"><i class="fa fa-facebook"></i></a>
				</div>
				</div>
				<div class="col-md-5 col-xs-12 col-sm-3 ulevel">
				<div class="col-xs-12 py-0 col-md-12 col-sm-12 ulevel">  
				<span>Share Referal Code:</span><span class="share-ref-icon"> <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $ref_url;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><i class="fa fa-facebook"></i></a>
				<a href="https://twitter.com/share?url=<?php echo $ref_url;?>&text=Share And Earn Coins" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Twitter"><i class="fa fa-twitter"></i></a>
				<a href="whatsapp://send?text=<?php echo $ref_url;?>"><i class="fa fa-whatsapp"></i></a>
				<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $ref_url;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Linkedin"><i class="fa fa-linkedin"></i></a>
				</span></div>
				
				</div>
				</div>
				</div>	
				</div>	
				</section>
<!-- // For Facebook share -->
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId            : '208527059935526',
			autoLogAppEvents : true,
			xfbml            : true,
			version          : 'v2.12'
		});
	};
	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "https://connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.12&appId=208527059935526&autoLogAppEvents=1';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<script type="text/javascript">
 $(document).ready(function(){
 $('.share-btnv').on( 'click', fb_share );
	});
	function fb_share() { 
			FB.ui( {
			method: 'feed',
			name: "GiftsCome",
			link:"http://giftscome.com.cp-28.hostgatorwebservers.com",
			picture: "http://giftscome.com.cp-28.hostgatorwebservers.com/images/fb-bg.png",
			caption: "Play Game & Get Coins",
			actions: {"name":"Search", "link":"http://giftscome.com.cp-28.hostgatorwebservers.com"}
		},  function(response) {

			if (response && !response.error_message) {
				 window.location.href = "share1.php";
				} else {
				//window.location.href = "/";
			}
		} );
	}
</script>
<?php }?>