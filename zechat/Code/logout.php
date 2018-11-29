<?php 
require_once('app/config.php');
$query = mysqli_query($con, "update `".$config['db']['pre']."userdata` set online = '0' where id = '".$_SESSION['id']."'");

// Remove access token from session
unset($_SESSION['facebook_access_token']);
//Unset token and user data from session
unset($_SESSION['token']);
session_unset($_SESSION['id']);

session_destroy();

echo '<script>window.location="login.php"</script>';



?>

