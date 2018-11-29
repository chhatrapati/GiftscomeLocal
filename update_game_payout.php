<?php
session_start();
error_reporting(0);
include('includes/config.php');
$game_id=$_POST['game_id'];
	$sp = "CALL update_game_payout($game_id)";
	$result = mysqli_query($con, $sp) or die(mysqli_error($con));
	//print_r($result);
	while($row=mysqli_fetch_array($result))
	{
		//echo $row[0];
	}
	  mysqli_free_result($result);mysqli_next_result($con);
	 
?>
