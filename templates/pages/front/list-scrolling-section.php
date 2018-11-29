<section class="banner p-t-40 p-b-40">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-md-4 col-xs-12 m-l-r-auto">
					<div class="block1 text-left pos-relative m-b-30" style="border-bottom:1px solid #08a6cc;">
						<h1 class="list-heading" style="margin-top:0">Admin Announcements</h1>
						<div class="demo5 demof" style="overflow:hidden;height:285px;">
							<ul style="border:2px solid #08a6cc;">
								<?php
								$query = "SELECT * FROM  announcement where is_active =1";
								$result = mysqli_query($con, $query) or die(mysqli_error($con));
								$i=0; while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
									$id= $row['id'];
									$id= toPublicId($id);
									$announcement=$row['announcement'];
									$announcement_date=$row['announcement_date'];
									$announcement_time=$row['announcement_time'];
									$slider_description=$row['slider_description'];
									?>										
									<li class="demof ancm"><?php if (strlen($announcement) > 25) {
											$trimstring = substr($announcement, 0, 70)."<a href=announcement.php?list=".$id.">&nbsp;&nbsp; Read More...</a>";
											} else {
											$trimstring = $string;
											}
											echo $trimstring;?>
											<p  class="list-para"><?php echo $announcement_date;?> &nbsp&nbsp <?php echo $announcement_time;?></p></li><hr>
									<?php }?>
								</ul>
							</div>
							<div class="block1-wrapbtn w-size2">	
							</div>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 col-xs-12 m-l-r-auto ">			
						<div class="block1  pos-relative m-b-30" >
							<h1 class="list-heading" style="margin-top:0">Winner Lists</h1>
							<div class="demo5 demof" style="overflow:hidden;height:285px!important; border:1px solid #08a6cc;">
							<?php $winners = $user_obj->get_winners(25);?>
							<ul><?php
							while ($winner = mysqli_fetch_array($winners)){
								$user_id = $winner['user_id'];
								$total_bid_amount = $winner['total_bid_amount'];
								$total_won_coins = $winner['total_won'];
								$win_date = $winner['create_date'];
								/*Get user detail by id*/
								$user_detail = $user_obj->user_detail_byid($user_id);
								$create_date= $win_date; ?>
										<li>
										   <?php $pic = $row['user_picture'];								  									
											if($user_detail['user_picture'] == ""){ ?>
											<img src="users-images/user.png" style="width:50px; height:50px;">
											<?php }elseif (strpos($pic, 'https') !== false) {?>
											<img src="<?php echo $user_detail['user_picture'];?>"  style="width:50px; height:50px;">
											<?php } else {?>
											<img src="users-images/<?php echo $user_detail['user_picture'];?>" style="width:50px; height:50px;">
											<?php }?>
											<a href="user-profile.php?user=<?php echo toPublicId($user_id);?>" target="_SELF"><?php echo $user_detail['name'];?></a>
											<p><span  style="color:#666;">Coins won:</span>
											<span style="color:#e82a1b"> <?php echo $total_won_coins;?></span>&nbsp;&nbsp;&nbsp; <?php echo date('d-M-y',strtotime($create_date));?></p>
										</li>								 
									<?php }?>	
									</ul>																			
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-md-4 col-xs-12 m-l-r-auto">					
								<!-- block2 -->
								<div class="block2 wrap-pic-w pos-relative m-b-30">
									<img src="images/banner5.png" style="height:333px">
								</div>
							</div>
						</div>
					</div>			
				</section>