<?php
error_reporting(0);
require_once('includes/config.php');
$pre_game_name = "Game#00";
$j = 0; for ($i = 1;$i <481; $i++) { $j= $j+3;
date_default_timezone_set('UTC');// change according timezone
$currentTime = date( 'Y-m-d H:i:s', time () );
$time_extend = date('Y-m-d H:i:s',strtotime('+'.$j.' minutes',strtotime($currentTime)));
//$game_name=$_POST['game_name'].$i;
$query142=mysqli_query($con,"select id FROM tbl_game ORDER BY id DESC LIMIT 1");
$result142=mysqli_fetch_array($query142);
$lid=$result142['id']+1;
$last_id = $lid;
$game_name=$pre_game_name.$last_id;
$game_start_time=$time_extend;
$game_duration='3';
$win_no1 = rand(0,9);
$win_no2 = rand(0,9);
$win_no3 = rand(0,9);
$winning_no = $win_no1 + $win_no2 + $win_no3;
$sql=mysqli_query($con, "insert into tbl_game(game_name,game_start_time,game_duration,game_wining_number1,game_wining_number2,game_wining_number3,winning_no) values('$game_name','$game_start_time','$game_duration','$win_no1','$win_no2','$win_no3','$winning_no')");
$lastid = mysqli_insert_id($con);
/*Set payout rate of new create game in table tbl_game_payout*/
$sql23=mysqli_query($con, "select * from tbl_default_payout");
while($result=mysqli_fetch_array($sql23)) {
$payout_digit = $result['payout_digit'];
$payout_amount = $result['payout_amount'];
$sql56=mysqli_query($con,"insert into tbl_game_payout(game_id,payout_digit,payout_amount) values('$lastid','$payout_digit','$payout_amount')");
}
}
?>