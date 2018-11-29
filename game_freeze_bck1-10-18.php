<?php
session_start();
include('includes/config.php');
date_default_timezone_set('UTC');// change according timezone
$currentTime = date( 'Y-m-d H:i:s', time () );
/*$query = "SELECT * FROM tbl_game where id = '$game_id' and is_active =1";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
//$rowcount=mysqli_num_rows($result);//print_r($rowcount);
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
$id = $row['id'];
$game_name = $row['game_name'];
$game_start_time = $row['game_start_time'];




$query567 = "SELECT * FROM tbl_game";
$result567 = mysqli_query($con, $query567) or die(mysqli_error($con));
$rowcount=mysqli_num_rows($result567);*/
echo $currentTime;
?>