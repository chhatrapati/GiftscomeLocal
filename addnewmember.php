<?php
require_once('includes/config.php');

	 $chatroomid=$_POST['chatroomid'];
	 $userid=$_POST['userid'];
	
	mysqli_query($con,"insert into chat_member (userid,chatroomid) values('$userid','$chatroomid')");
	
	echo "Member Added";
	
?>