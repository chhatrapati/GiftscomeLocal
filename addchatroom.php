<?php 
session_start();
require_once('includes/config.php');

    $cid="";      
       $member_id = $_SESSION['id'];
      $chat_name=$_POST['chatname'];
	// $chat_password=$_POST['chatpass'];
	
mysqli_query($con,"insert into chatroom(chat_name,date_created,userid) values ('$chat_name',NOW(),'$member_id')");
	$cid=mysqli_insert_id($con);
	
	mysqli_query($con,"insert into chat_member (chatroomid, userid) values ('$cid', '$member_id')");
	
	echo "Chat room Created";
	
	$cid;
	
	
	
?>