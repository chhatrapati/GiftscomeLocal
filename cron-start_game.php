<?php
error_reporting(0);
require_once('includes/config.php');
/*Create Game Cron 1*/
$game_name = "Game#00";
/**Last game id */
$query12=mysqli_query($con,"select id FROM tbl_game ORDER BY id DESC LIMIT 1");
$result12=mysqli_fetch_array($query12);
$last_game_id = $result12['id'];
$new_game_id=$last_game_id+1;
/*Fetch game start and end time of last game id*/
$query1245=mysqli_query($con,"select * FROM tbl_game where id ='$last_game_id'");
$result12345=mysqli_fetch_array($query1245);//print_r($result12);
$game_start_time=$result12345['game_start_time'];
$game_duration = $result12345['game_duration'];
$end_time = date('Y-m-d H:i:s',strtotime('+'.$game_duration.' minutes',strtotime($game_start_time)));
$new_game_name =$game_name.@$new_game_id;
//date_default_timezone_set('UTC');// change according timezone
//$currentTime = date( 'Y-m-d H:i:s', time () );
$time_extend = date('Y-m-d H:i:s',strtotime('+0 seconds',strtotime($end_time)));
$game_name=$new_game_name;
$new_game_start_time=$time_extend;
$game_duration='3';
$sql=mysqli_query($con, "insert into tbl_game(game_name,game_start_time,game_duration) values('$game_name','$new_game_start_time','$game_duration')");
$lastid = mysqli_insert_id($con);
/*Set payout rate of new create game in table tbl_game_payout*/
$sql23=mysqli_query($con, "select * from tbl_default_payout");
while($result=mysqli_fetch_array($sql23)) {
	$payout_digit = $result['payout_digit'];
	$payout_amount = $result['payout_amount'];
	$sql56=mysqli_query($con,"insert into tbl_game_payout(game_id,payout_digit,payout_amount) values('$lastid','$payout_digit','$payout_amount')");
}
/*End of create game*/

/*Start Game*/
$sql=mysqli_query($con, "select id FROM tbl_game where game_status=0 ORDER BY id ASC LIMIT 1");
$result=mysqli_fetch_array($sql);
$game_id=$result['id'];
$query=mysqli_query($con,"UPDATE tbl_game SET game_status=1 WHERE id='".$game_id."'");
/*End of start Game*/

/*Get Winnning No*/
//date_default_timezone_set('UTC');
$currentTime = date( 'Y-m-d H:i:s', time () );
$sql_12=mysqli_query($con, "select * FROM tbl_game where game_status = 1 ORDER BY id ASC LIMIT 1");
$result_12=mysqli_fetch_array($sql_12);
$expire_game_id=$result_12['id'];
$game_start_time = $result_12['game_start_time'];
$game_duration_1 = $result_12['game_duration'];
//date_default_timezone_set('UTC');
$end_date = date('Y-m-d H:i:s',strtotime('+'.$game_duration_1.'minutes',strtotime($game_start_time)));
$End_date_extend = date('Y-m-d H:i:s',strtotime('-10 seconds',strtotime($end_date)));
if($currentTime >= $End_date_extend)  {
$sp = "CALL get_winnig_no($expire_game_id)";
$result_32 = mysqli_query($con, $sp) or die(mysqli_error($con));
$result_33 = mysqli_fetch_assoc($result_32);
mysqli_next_result($result_33);
}
?>