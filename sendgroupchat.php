<?php
	require_once('includes/config.php');
   

	if(isset($_POST)){		
	
	   echo  $sender_id=$_POST['sender_id'];
		echo $sender_name=$_POST['sender_name'];
	   echo $sender_img=$_POST['sender_img'];
		echo $message=$_POST['message'];
		echo  $chatroomno=$_POST['chatroomno'];
 mysqli_query($con,"INSERT INTO privatechatmessage(userid,chatroomid,message) values('$sender_id','$chatroomno','$message')"); 

		
	}