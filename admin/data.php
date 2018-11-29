<?php
include('include/config.php');
require_once('User.php');
$userinfo_obj = new User_Info();
?>
<?php 
//$result = mysqli_query($con,"SELECT name, val FROM web_marketing");
//$result = mysqli_query($con,"select game_name, id from tbl_game");
$rows = array();
$data = $userinfo_obj->get_game_history();					
while($r=mysqli_fetch_array($data)) {
	$game_id = $r['id'];
		$game_name = $r['game_name'];
		
		$total_bids = $userinfo_obj->get_total_noof_bids($game_id);
		if($total_bids=='')
		{
			$total_bids ="0";
		}
		$row[0] = $game_name;
		$row[1] = $total_bids;

array_push($rows,$row);
}
print json_encode($rows, JSON_NUMERIC_CHECK);
mysqli_close($con);

/*
$result = mysqli_query($con,"SELECT name, val FROM web_marketing");
$rows = array();
while($r = mysqli_fetch_array($result)) {
$row[0] = $r[0];
$row[1] = $r[1];
array_push($rows,$row);
}
print json_encode($rows, JSON_NUMERIC_CHECK);
mysqli_close($con);*/
?>
