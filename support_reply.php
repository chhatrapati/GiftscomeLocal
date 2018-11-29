<?php
require_once('includes/config.php');
if($_POST){
	$mid=$_POST['mid'];
	$sid=$_POST['sid'];
	$rname=$_POST['rname'];
	$msgid=$_POST['msgid'];
	$sname=$_POST['sname'];
	$msg=$_POST['reply_msg'];


 $sql=mysqli_query($con,"INSERT INTO support_reply(support_id,sender_id,sender_name,receiver_id,receiver_name,msg) values('$msgid','$mid','$rname','$sid','$sname','$msg')");
  if($sql){
echo "Your message have been successfully .";
 
}
}	
?>