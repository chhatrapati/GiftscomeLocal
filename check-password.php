<?php
require_once 'includes/config.php';
$db = new Cl_DBclass();
if( isset( $_POST['password'] ) && !empty($_POST['password'])){
	$password =md5( trim( $_POST['password'] ) );
	@$email = $_POST['email'];
	
	if( !empty( $email) && !empty($password) ){
		$query = " SELECT count(password) cnt FROM users where password = '$password' and email = '$email' ";
		$result = mysqli_query($db->con, $query);
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