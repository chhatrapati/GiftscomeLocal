<?php session_start();
error_reporting(1);
require_once('includes/config.php');
$sql=mysqli_query($con, "select id FROM tbl_game where game_status=0 ORDER BY id ASC LIMIT 1");
$result=mysqli_fetch_array($sql);
$game_id=$result['id'];
$query=mysqli_query($con,"update tbl_game set  game_status=1 where id='".$game_id."'");
?>