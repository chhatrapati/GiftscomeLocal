<?php
session_start();
include('includes/config.php');
$next_game_id=$_POST['next_game_id'];
$curr_game_id=$_POST['curr_game_id'];
//$quer_new=mysqli_query($con,"select count(*) as current_games from tbl_game WHERE game_status='1'");
//$row_new=mysqli_fetch_array($quer_new);
//print_r($row_new);
//if($row_new['current_games']==1){
	$sql=mysqli_query($con, "UPDATE tbl_game SET game_status = '3' WHERE id='$curr_game_id'");
	$sql_12=mysqli_query($con, "UPDATE tbl_game SET game_status = '1' WHERE id='$next_game_id'");
//}	
//$result=mysqli_fetch_array($sql);
?>