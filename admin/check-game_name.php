<?php
include('include/config.php');


if( isset( $_POST['game_name'] ) && !empty($_POST['game_name'])){
	$game_name = $_POST['game_name'];
	$query = " SELECT count(game_name) cnt FROM tbl_game where game_name = '$game_name'";
	$result = mysqli_query($con, $query);
	$data = mysqli_fetch_assoc($result);
	if($data['cnt'] > 0){
		echo 'false';
	}else{
		echo 'true';
	}
	exit;
}