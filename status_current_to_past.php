<?php
session_start();
include('includes/config.php');
$curr_game_id=$_POST['curr_game_id'];
$sql=mysqli_query($con, "UPDATE tbl_game SET game_status = '3' WHERE id='$curr_game_id'");
?>