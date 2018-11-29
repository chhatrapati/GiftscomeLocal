<?php
session_start();
require_once('includes/config.php');
	if (isset($_POST['leave'])){
		$id=$_POST['id'];
		 $member_id=$_SESSION['id'];
		
		mysqli_query($con,"delete from chat_member where userid='$member_id' and chatroomid='$id'");
		
		//remove room if no more member
		$r=mysqli_query($con,"select * from chat_member where chatroomid='$id'");
		if (mysqli_num_rows($r)<1){
			mysqli_query($con,"delete from chatroom where chatroomid='$id'");
		}
	
		  
	}

?>