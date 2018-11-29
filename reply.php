<?php
require_once('includes/config.php');
if($_POST){
	$mid=$_POST['mid'];
	$sid=$_POST['sid'];
	$rname=$_POST['rname'];
	$msgid=$_POST['msgid'];
	$sname=$_POST['sname'];
	$sender_img=$_POST['sender_img'];
	$reciver_img=$_POST['reciver_img'];
	$msg=$_POST['reply_msg'];


 $sql=mysqli_query($con,"INSERT INTO reply(message_id,sender_id,sender_name,sender_img,receiver_id,receiver_name,receiver_img,msg) values('$msgid','$mid','$rname','$reciver_img','$sid','$sname','$sender_img','$msg')");
  if($sql){
echo "Your message have been successfully .";
 
}
}	
?>