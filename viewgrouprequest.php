<?php
session_start();
require_once('includes/config.php');
if(isset($_POST['viewgrouprequest']))
{

			//$uid=array();
			$member_id = $_SESSION['id'];
			//$s=array();
			//echo "SELECT * from chatroom where FIND_IN_SET($member_id,userid)";
			$query1=mysqli_query($con,"SELECT * from chatroom where FIND_IN_SET($member_id,userid)");
			//print_r($query1);
			//$new1=mysqli_fetch_assoc($query1);
			//print_r($new1);
			while($r=mysqli_fetch_assoc($query1))
			{
				
				//echo $new1['chat_name'];
				//echo $new1['chatroomno'];
				?>
				<li class="contact" id="chatroom" value= "<?php echo $r['chatroomno']; ?>" onclick="chatroom('<?php echo $r['chat_name']; ?>','<?php echo $r['chatroomno']; ?>','<?php echo $member_id; ?>','<?php echo $r['userid']; ?>')">
			
				<input type="hidden" id="chatroomno" value="<?php echo $r['chatroomno'];?> ">
				<div class="wrap" >
						<span class="contact-status online" style="display:none;"></span>
						
						<img src="users-images/user.png" alt=""  id="upic"  style="float:left !importan;border-radius:50% !important;border:3px solid skyblue !importan;"/>
				
						<div class="meta">
							<p class="name"><?php echo $r['chat_name']; ?> </p>
						</div>
					</div>
				</li>
				<?php
			}
			
			$creq=mysqli_query($con,"SELECT `chat_name`,chatroomno,userid FROM chatroom where create_userid='$member_id' GROUP BY `chat_name`");
			while($r=mysqli_fetch_array($creq))
						{
						//echo $chatname=$rs['chat_name'];
						//echo $rs['chatroomno'];
						?>
							<li class="contact" id="chatroom" value= "<?php echo $r['chatroomno']; ?>" onclick="chatroom('<?php echo $r['chat_name']; ?>','<?php echo $r['chatroomno']; ?>','<?php echo $member_id; ?>','<?php echo $r['userid']; ?>')">
			
				<input type="hidden" id="chatroomno" value="<?php echo $r['chatroomno'];?> ">
				<div class="wrap" >
						<span class="contact-status online" style="display:none;"></span>
						
						<img src="users-images/user.png" alt=""  id="upic"  style="float:left !importan;border-radius:50% !important;border:3px solid skyblue  !importan;" />
				
						<div class="meta">
							<p class="name"><?php echo $r['chat_name']; ?> </p>
						</div>
					</div>
				</li>
				<?php
						}
		                    
                       
         
}?>