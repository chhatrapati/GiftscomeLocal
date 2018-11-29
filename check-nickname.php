<?php
require_once 'includes/config.php';
$db = new Cl_DBclass();


if( isset( $_POST['nick_name'] ) && !empty($_POST['nick_name'])){
	$nick_name = $_POST['nick_name'];
	$query = " SELECT count(nick_name) cnt FROM users where nick_name = '$nick_name' ";
	$result = mysqli_query($db->con, $query);
	$data = mysqli_fetch_assoc($result);
	if($data['cnt'] > 0){
		echo 'false';
	}else{
		echo 'true';
	}
	exit;
}

if( isset( $_GET['nick_name'] ) && !empty($_GET['nick_name'])){
	$nick_name = $_GET['nick_name'];
	$query = " SELECT count(email) cnt FROM users where nick_name = '$nick_name' ";
	$result = mysqli_query($db->con, $query);
	$data = mysqli_fetch_assoc($result);
	if($data['cnt'] == 1){
		echo 'true';
	}else{
		echo 'false';
	}
	exit;
}