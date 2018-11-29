<?php
session_start();
require_once('includes/config.php');
	if (isset($_POST['chatmembervalue'])){
		
	$chatid=$_POST['chatroomno'];	
$sql11=mysqli_query($con,"select userid from chatroom where `chatroomno`='$chatid'");
$aa=mysqli_fetch_assoc($sql11);
	
	 $chatmember=$aa['userid'];
	 
	 $user = split ("\,", $chatmember);
	 
	 $countuser=count($user);
	 echo str_pad($countuser, 10);
	 echo 'participants';
	 //echo $countuser.&nbsp;'view participate';
	}