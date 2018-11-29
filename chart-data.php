<?php
require_once('includes/config.php');
header('Content-Type: application/json');
$sqlQuery = "SELECT bid_no,SUM(bid_amount) as bid_amount FROM tbl_userbids group by bid_no";
$result = mysqli_query($con,$sqlQuery);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
mysqli_close($con);
echo json_encode($data);
?>