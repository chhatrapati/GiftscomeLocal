<?php 
session_start();
require_once('includes/config.php');
$chatid=$_POST['chatroomno'];
$uid =$_POST['uid']; 
$sql=mysqli_query($con,"delete from chatroom WHERE `create_userid`='$uid' and `chatroomno`='$chatid'");
$sql1=mysqli_query($con,"delete from privatechatmessage WHERE`chatroomid`='$chatid'");

echo "chat room deleted";
?>