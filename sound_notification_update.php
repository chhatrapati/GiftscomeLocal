<?php
include('includes/config.php');
$id=$_POST['id'];
$status=$_POST['status'];
$query=mysqli_query($con,"UPDATE users set sound_notification='".$status."' WHERE id='".$id."'");
?>