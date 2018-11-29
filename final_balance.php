<?php
session_start();
error_reporting(0);
include('includes/config.php');
$user_obj = new Cl_User();
$userid = $_SESSION['id'];
$gift_coins_bal = $user_obj->get_user_coins_balance($userid);
$gift_coins = $gift_coins_bal['gift_coins'];
echo $gift_coins;
?>