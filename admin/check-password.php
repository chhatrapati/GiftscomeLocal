<?php
require_once 'include/config.php';

if( isset( $_POST['password'] ) && !empty($_POST['password'])){
	$password =md5( trim( $_POST['password'] ) );
	
	
	if(!empty($password)){
		$query = " SELECT count(password) cnt FROM admin where password = '$password'";
		$result = mysqli_query($con, $query);
		$data = mysqli_fetch_assoc($result);
		if($data['cnt'] == 1){
			echo 'true';
		}else{
			echo 'false';
		}
	}else{
		echo 'false';
	}
	exit;
}