<?php
error_reporting(0);
require_once('includes/config.php');
$query= "INSERT INTO tbl_game_archive (id, game_name, game_start_time, game_duration, game_wining_number1,game_wining_number2,game_wining_number3,winning_no,total_bids,total_won_coins,is_active,game_status,create_date)
SELECT id, game_name, game_start_time, game_duration, game_wining_number1,game_wining_number2,game_wining_number3,winning_no,total_bids,total_won_coins,is_active,game_status,create_date
FROM tbl_game ORDER by id asc LIMIT 200";
$sql_12=mysqli_query($con, $query);
$sql=mysqli_query($con, "delete from tbl_game ORDER by id asc LIMIT 200");
if($sql)
{
	//echo "Records Deleted Successfully";
}
?>