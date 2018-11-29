<?php
	session_start();
	require_once('includes/config.php');
    $member_id=$_SESSION['id'];

	if(isset($_POST['msg'])){		
		$msg=$_POST['msg'];
		$id=$_POST['id'];
		mysqli_query($con,"insert into `privatechatmessage` (chatroomid, message, userid, chat_date) values ('$id', '$msg' ,'$member_id', NOW())") or die(mysqli_error($con));
		echo $msg;
	}
?>