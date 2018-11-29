<?php
session_start();
require_once('includes/config.php');
if($_POST){
 $sender_id=$_POST['sender_id'];
 $sender_name=$_POST['sender_name'];
  $login_userpic=$_POST['login_userpic'];
 $reciver_id=$_POST['reciver_id'];
 $reciver_name=$_POST['reciver_name'];
 $reciver_img=$_POST['reciver_img'];
 $msg=$_POST['reciver_msg'];

  
$sql=mysqli_query($con,"INSERT INTO message(sender_id,sender_name,sender_img,receiver_id,receiver_name,receiver_img,msg) values('$sender_id','$sender_name','$login_userpic','$reciver_id','$reciver_name','$reciver_img','$msg')");
  if($sql){
echo "Your message have been successfully .";
}
}
?>