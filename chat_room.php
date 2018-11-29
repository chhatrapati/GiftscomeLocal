<?php
session_start();
require_once('includes/config.php');
$chatid=$_POST['chatid'];
$chatroom=$_POST['chatroom'];
$member_id=$_SESSION['id'];
?>
<button type="button" class="btn btn-warning btn-sm leave2" id="leave" value="<?php echo $chatid; ?>" style="margin-top:10px">Leave</button>
<ul>
<?php
	$rm=mysqli_query($con,"select * from chat_member left join `users` on users.id=chat_member.userid where chatroomid='$chatid'");
				
					while($rmrow=mysqli_fetch_array($rm)){
			   
				$creq=mysqli_query($con,"select * from chatroom where chatroomid='$chatid'");
						$crerow=mysqli_fetch_array($creq);
								
							if ($crerow['userid']==$rmrow['userid']){
						}
								?>
					<div class='chatroomname' style='display:none;'><?php echo $chatroom;?></div>
					<div class='xyz' style='display:none;'><?php echo $chatid;?></div>		
              <li class="chat_membername" id="<?php echo $chatid;?>"><?php echo $rmrow['name'];?>
			 
			  <?php } ?>
			
						
					
		</li>
		
	</ul>
		