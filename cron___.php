<?php session_start();
error_reporting(0);
require_once('includes/config.php');
$sql=mysqli_query($con, "select id FROM tbl_game where game_status=0 ORDER BY id ASC LIMIT 1");
$result=mysqli_fetch_array($sql);
//print_r($result);
$game_id=$result['id'];
$query=mysqli_query($con,"update tbl_game set game_status=1 where id='".$game_id."'");
date_default_timezone_set('UTC');
$currentTime = date( 'Y-m-d H:i:s', time () );
$sql_12=mysqli_query($con, "select * FROM tbl_game where game_status = 1 ORDER BY id ASC LIMIT 1");
$result_12=mysqli_fetch_array($sql_12);
$expire_game_id=$result_12['id'];
$game_start_time = $result_12['game_start_time'];
$game_duration = $result_12['game_duration'];
//date_default_timezone_set('UTC');
$end_date = date('Y-m-d H:i:s',strtotime('+'.$game_duration.'minutes',strtotime($game_start_time)));
$End_date_extend = date('Y-m-d H:i:s',strtotime('-10 seconds',strtotime($end_date)));
if($currentTime > $End_date_extend)  {
$sp = "CALL get_winnig_no($expire_game_id)";
$result_32 = mysqli_query($con, $sp) or die(mysqli_error($con));
$result_33 = mysqli_fetch_assoc($result_32);
//print_r($result_33);
//mysqli_free_result($result_32);
mysqli_next_result($result_33);
//$user_obj = new Cl_User();
//$user_obj->auto_start_game();

}
?>