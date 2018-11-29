<?php
session_start();
require_once('includes/config.php');
if(isset($_POST['search']))
{
	 $search=$_POST['search'];
	 $member_id = $_SESSION['id'];
	  $query = "SELECT * FROM  chatroom where  chat_name LIKE '%".$search."%' and create_userid='$member_id'"; 
	  $result = mysqli_query($con, $query) or die(mysqli_error($con));
	  while($r = mysqli_fetch_array($result)){
		  ?>
		  	<p>My Group</p>
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
}
	  ?>