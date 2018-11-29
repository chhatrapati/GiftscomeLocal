<?php
	require_once('includes/config.php');
   

	if(isset($_POST)){		
		$reciver_id=$_POST['userid'];
	   	$reciver_name=$_POST['uname'];
		 $reciver_img=$_POST['uimage'];
	     $sender_id=$_POST['sender_id'];
		 $sender_name=$_POST['sender_name'];
	    $sender_img=$_POST['sender_img'];
		 $message=$_POST['message'];
 mysqli_query($con,"INSERT INTO message(sender_id,sender_name,sender_img,receiver_id,receiver_name,receiver_img,msg) values('$sender_id','$sender_name','$sender_img','$reciver_id','$reciver_name','$reciver_img','$message')"); 

		
	}