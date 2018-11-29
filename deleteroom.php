<?php
	require_once('includes/config.php');
	
	if (isset($_POST['del'])){
		$id=$_POST['id'];
		
		mysqli_query($con,"delete from `chatroom` where chatroomid='$id'");
		mysqli_query($con,"delete from `privatechatmessage` where chatroomid='$id'");
		mysqli_query($con,"delete from `chat_member` where chatroomid='$id'");
	}
?>