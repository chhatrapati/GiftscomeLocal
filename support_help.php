<?php
session_start();
require_once('includes/config.php');
if($_POST){
$to=$_POST['category'];
$stud = explode("_",$_POST['category']);
$reciver_id = $stud[0];
$reciver_name = $stud[1];
$msg=$_POST['reciver_msg'];
$sender_name= $_SESSION['username'];
$sender_id = $_SESSION['id'];

  
$sql=mysqli_query($con,"INSERT INTO support(sender_id,sender_name,receiver_id,receiver_name,msg) values('$sender_id','$sender_name','$reciver_id','$reciver_name','$msg')");
  if($sql){
echo "Your message have been successfully .";
}
}
?>