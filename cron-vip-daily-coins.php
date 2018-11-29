<?php
error_reporting(0);
require_once('includes/config.php');
$sql12=  mysqli_query($con,"select * from coins_transfer_value where user_type='vip'")or die(mysqli_error());
$data123=mysqli_fetch_array($sql12,MYSQLI_ASSOC);
$daily_gift_coins = $data123['gift_coins'];
$remarks ='Daily Vip Coins Reward';
$sql=mysqli_query($con,"SELECT  distinct user_id  FROM package_sales WHERE expire_date >= CURRENT_DATE");
while($res=mysqli_fetch_array($sql)) {
$user_id = $res['user_id'];
$query_142=mysqli_query($con, "insert into user_wallet(user_id,user_coins,reason_mode_of_coins,coins_type,date_of_coins_get) values('".$user_id."','$daily_gift_coins','$remarks','gift_coins',NOW())");
$sql_123=mysqli_query($con,"update users set gift_coins=gift_coins+'$daily_gift_coins'  where id='$user_id'");
}
?>