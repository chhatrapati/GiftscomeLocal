<?php
session_start();
include('includes/config.php');
$game_id=$_POST['id_game'];
/*Update game status 3 to active game*/
/*$query345 = "select * from tbl_game WHERE is_active=1 and game_status=1 order by id asc limit 1";
$result345 = mysqli_query($con, $query345) or die(mysqli_error($con));
$res_765=mysqli_fetch_array($result345);
$active_game_id= $res_765['id'];
$sql345=mysqli_query($con, "UPDATE tbl_game SET game_status = '3' WHERE id='$active_game_id'");*/
$sql=mysqli_query($con, "UPDATE tbl_game SET game_status = '1' WHERE id='$game_id'");
$result=mysqli_fetch_array($sql);
?>