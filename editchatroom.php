    <?php
 session_start();
require_once('includes/config.php');
$chatroomno=$_POST['chatroomno'];
$chatroomname=$_POST['chatroomname'];
?>
   <div class="modal-dialog" style="margin: 0;margin-top: 21%;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"style="background-color: red; border-radius: 50%;width: 5%;">&times;</button>
          <div id="memberadded"></div>
          <button type="button"  class="btn btn-warning"><h4 class="modal-title" style="color:#fff;font-size:11px">Edit Group Chat</h4></button>
        </div>
        <div class="modal-body">
		   
			 <input style="width: 100%; padding: 6px 20px;margin: 8px 0;box-sizing: border-box;background-color: #e6e0e0;" id="chatroomname" name="chatroomname" value="<?php echo $chatroomname;?>"  placeholder="Enter Group Name Here ...">
			 <p id="warning_msg" style="display:none">Please enter group name</p>
			<br>
			 <input type="text" name="update_user" onclick="updatingsearch()" style="width: 100%; padding: 6px 20px;margin: 8px 0;box-sizing: border-box;background-color: #e6e0e0;" id="update_user" placeholder="Search contacts..." />
              <p id="warning_checkbox" style="display:none">Please select one user aleast</p>
			  <br>
			 <br>
			  <fieldset>
    <legend>Select users:</legend>
	
	<ul class="adding_usergroupchat" style="width: 100px;height: 300px;overflow-y: auto;overflow-x: hidden;width:450px;">
	<?php
            // if (isset($_SESSION['id'])) {
                 // $member_id = $_SESSION['id'];
            // }  
			
			 // $sender_name=$_SESSION['username'];
			 
			 // $query=mysqli_query($con, "SELECT name, user_picture FROM users WHERE id = '$member_id'");
			 // $res = mysqli_fetch_assoc($query);
			   // $user_name=$res['name'];
			  // $user_picture=$res['user_picture'];
			  // echo "<input type='hidden' id='sender_image' value='".$user_picture."'>";
			  ?>
			  
			  <?php
			  $member_id = $_SESSION['id'];
			  $myfriends=array();
			  $abc="SELECT * FROM frineds WHERE myid='$member_id'";
	$result1 = mysqli_query($con, $abc) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result1))
	{
		  $myfriends[]=$row['myfriends'];
	}	

	//print_r($myfriends);
 $ss="SELECT `userid` FROM `chatroom` WHERE chatroomno='$chatroomno' and create_userid='$member_id'";
	$result = mysqli_query($con, $ss) or die(mysqli_error($con));
	while($r=mysqli_fetch_array($result))
	{
		 $uid=$r['userid'];
	}	
	
	$ui = split ("\,", $uid);
	//print_r($ui);
	
	 $result=array_intersect($myfriends,$ui);
  //  print_r($result);
	
	   $my=array();
			  $abc="SELECT * FROM frineds WHERE myid='$member_id'";
	$result1 = mysqli_query($con, $abc) or die(mysqli_error($con));
	while($row1=mysqli_fetch_array($result1))
	{
		   $my[]=$row1['myfriends'];
		  
	}
	//print_r($my);
	//print_r($result);
	
	foreach($my as $val){
    if(in_array($val, $result)){
     // echo "check";
	  // echo $val;
	   $abc1="SELECT * FROM users WHERE id='$val'";
	$result11 = mysqli_query($con, $abc1) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result11))
	{
		
		  $name=$row['name'];
		   $user_picture=$row['user_picture'];
		  if($user_picture=='')
		  {
		?>
		
		  <li style="height:50px;">
			 <input type="checkbox" style="float:left;" name="updatechat" value="<?php echo $val;?>" checked>	
					<div class="wrap">
						<span class="contact-status online"></span>
										<img src="users-images/user.png" alt="" width="50" height="50" style="float:left;border-radius:50%;border:3px solid skyblue;">
										<div class="meta" style="margin-left:20%;">
							<p class="name" style="margin-top: 8px;float: left;color:red;"><?php echo $name;?> </p>
						</div>
					</div>
				</li>
			 <?php
		  }
		  else
		  {
			 ?>
			 
			   <li style="height:50px;">
			 <input type="checkbox" style="float:left;" name="updatechat" value="<?php echo $val;?>" checked>	
					<div class="wrap">
						<span class="contact-status online"></span>
										<img src="users-images/<?php echo $row['user_picture'];?>" alt="" width="50" height="50" style="float:left;border-radius:50%;border:3px solid skyblue;">
										<div class="meta" style="margin-left:20%;">
							<p class="name" style="margin-top: 8px;float: left;color:red;"><?php echo $name;?> </p>
						</div>
					</div>
				</li>
			<?php
		  }
		  
	}	
	   
	   
    } else {
		
		$abc1="SELECT * FROM users WHERE id='$val'";
	$result11 = mysqli_query($con, $abc1) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result11))
	{
		
		  $name=$row['name'];
		   $user_picture=$row['user_picture'];
		  if($user_picture=='')
		  {
		?>
		
		  <li style="height:50px;">
			 <input type="checkbox" style="float:left;" name="updatechat" value="<?php echo $val;?>" >	
					<div class="wrap">
						<span class="contact-status online"></span>
										<img src="users-images/user.png" alt="" width="50" height="50" style="float:left;border-radius:50%;border:3px solid skyblue;">
										<div class="meta" style="margin-left:20%;">
							<p class="name" style="margin-top: 8px;float: left;color:red;"><?php echo $name;?> </p>
						</div>
					</div>
				</li>
			 <?php
		  }
		  else
		  {
			 ?>
			 
			   <li style="height:50px;">
			 <input type="checkbox" style="float:left;" name="updatechat" value="<?php echo $val;?>" >	
					<div class="wrap">
						<span class="contact-status online"></span>
										<img src="users-images/<?php echo $row['user_picture'];?>" alt="" width="50" height="50" style="float:left;border-radius:50%;border:3px solid skyblue;">
										<div class="meta" style="margin-left:20%;">
							<p class="name" style="margin-top: 8px;float: left;color:red;"><?php echo $name;?> </p>
						</div>
					</div>
				</li>
			<?php
		  }
		  
	}	
     //  echo "choke";
	    //  echo $val;
    }
}

			  ?>
			</ul>
	</fieldset>
        </div>
        <div class="modal-footer">
		 <button type="submit" id="edit_chatroom" onclick="updatechatroom('<?php echo $chatroomno;?>','<?php echo $member_id;?>')" class="btn btn-info"  style="font-size:11px;">Update Chat room</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" style="font-size:11px;">Close</button> 
        </div>
         
      </div>
      
    </div>