<?php
//error_reporting(0);
session_start();
include('includes/config.php');
$user_obj = new Cl_User();
//extract($_POST);
$id=$_POST['id'];
$uid=$_POST['uid'];
$status=$_POST['status'];
$query=mysqli_query($con,"UPDATE tbl_user_robot set  status='".$status."' WHERE id='".$id."'");
//$_SESSION['alert_msg']="Your bid status has been updated successfully!!";	
$sql_478=mysqli_query($con,"select status from tbl_user_robot WHERE id='".$id."'");
$result=mysqli_fetch_array($sql_478); //print_r($result);			
$status = $result['status'];
if($status=='0')
{
	$ret = mysqli_query($con,"select * from tbl_game WHERE game_status=0 or game_status=1");
	while($row=mysqli_fetch_array($ret))
		{
			$game_id= $row['id'];
			$sql12 = mysqli_query($con,"select SUM(bid_amount) as total_bid_amt from tbl_userbids where game_id = '".$game_id."' AND user_id = '".$uid."' ");
			$result33=mysqli_fetch_array($sql12);
			$total_bid_amt =$result33['total_bid_amt'];
			$sql = mysqli_query($con,"delete from tbl_userbids where game_id = '".$game_id."' AND user_id = '".$uid."' ");
			$gift_coins_bal = $user_obj->get_user_coins_balance($uid);
			$gift_coins = $gift_coins_bal['gift_coins'];
			$final_gift_coins = $gift_coins + $total_bid_amt;
			$user_obj->update_gift_coins_final_balance($uid,$final_gift_coins);
		}
}
else
{
 require_once('auto-bids-latest.php');
}
echo $status;
?>