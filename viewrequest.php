<?php
session_start();
require_once('includes/config.php');
if(isset($_POST['viewreq']))
{
                     
                       
                     
                        $sendReq = "SELECT * FROM friendrequest";
					    $res = mysqli_query($con, $sendReq) or die(mysqli_error($con));
						$rowRe = mysqli_fetch_array($res, MYSQLI_BOTH);
						
						
						$sender=$rowRe['sender_id'];
						$member_id = $_SESSION['id'];
	                $query1 = mysqli_query($con,"SELECT * FROM friendrequest WHERE receiver_id='$member_id'");
					 
                                 if(mysqli_num_rows($query1) > 0) 
								 
								 {
								 
								 
                                 while($row = mysqli_fetch_array($query1)) 
								 
								 { 
								 
                                 $query2 = mysqli_query($con,"SELECT * FROM users WHERE id = '" .  $row["sender_id"] . "'");
                                 while($row2 = mysqli_fetch_array($query2)) 
								 
								 {
                                  
						
					?>
	
					
			<li class="contact"  id="acceptreq" onclick="accpet_request('<?php echo $row2['id'];?>','<?php echo $row2['name'];?>','<?php echo $row2['user_picture'];?>')">
					<div class="wrap">
						<span class="contact-status online"></span>
						<?php
						if($row2['user_picture']=='')
						{
							?>
							<img src="users-images/user.png" alt="">
						<?php } else {?>
						
										<img src="users-images/<?php echo $row2['user_picture'];?>" alt="">
						<?php }?>
										<div class="meta">
		<p class="name"><?php echo $row2['name'];?><span class="badge badge-notify" style="font-size:10px;position: absolute;left: 111px;margin: 10px 0 0 62px;width: 41px; height: 19px;border-radius: 50%;border: 2px solid red;top:-6px;background:red">New</span></p>
						</div>
					</div>
				</li>
				<?php
} }}}?>