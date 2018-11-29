<?php
session_start();
error_reporting(0);
require_once('includes/config.php');
$user_obj = new Cl_User();
require_once('includes/function.php');
$uid = $_SESSION['id'];
$date_of_points_get = $user_obj->points_get_date($uid,'By Facebook Share');
$cur_date_12= date("Y-m-d");
$points_by_fb = $user_obj->get_points_supplement();
$points_by_social_share = $points_by_fb['points_by_social_share'];
$remarks= 'By Facebook Share';
if($cur_date_12 > $date_of_points_get)
{
$user_obj->set_user_points($uid,$points_by_social_share,$remarks);
$user_obj->set_points_users($uid,$points_by_social_share);
}
$ss=  mysqli_query($con,"SELECT date_of_coins_get FROM user_wallet  WHERE user_id='$uid' AND reason_mode_of_coins='By Social Share' order by date_of_coins_get desc limit 1");
$result_data = mysqli_fetch_assoc($ss);
$date_of_coins_get = $result_data['date_of_coins_get'];
$cur_date= date("Y-m-d");
if($cur_date > $date_of_coins_get)
{
$user_obj->coins_by_social_share($uid);
}
$url="http://giftscome.com.cp-28.hostgatorwebservers.com";
header('Location: '.$url);
?>


