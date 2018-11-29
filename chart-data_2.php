<?php
require_once('includes/config.php');
header('Content-Type: application/json');
//$sqlQuery = "SELECT bid_no,SUM(bid_amount) as bid_amount FROM tbl_userbids where game_id BETWEEN '".$last_id."' AND '".$last_id."'-10 group by bid_no";
$sqlQuery1 = "SELECT game_id,SUM(bid_amount) as bid_amount FROM tbl_userbids group by game_id limit 50";
$result1 = mysqli_query($con,$sqlQuery1);
$data1 = array();
foreach ($result1 as $row1) {
	$data1[] = $row1;
}
mysqli_close($con);
echo json_encode($data1);
?>