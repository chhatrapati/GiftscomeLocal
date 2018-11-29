<?php
session_start();
error_reporting(0);
include('includes/config.php');
$user_obj = new Cl_User();
$game_id=$_POST['game_id'];
$user_id=$_POST['user_id'];
$sql12 = mysqli_query($con,"select SUM(bid_amount) as total_bid_amt from tbl_userbids where game_id = '".$game_id."' AND user_id = '".$user_id."' ");
$result33=mysqli_fetch_array($sql12);
$total_bid_amt =$result33['total_bid_amt'];
$sql = mysqli_query($con,"delete from tbl_userbids where game_id = '".$game_id."' AND user_id = '".$user_id."' ");
$gift_coins_bal = $user_obj->get_user_coins_balance($user_id);
$gift_coins = $gift_coins_bal['gift_coins'];
$final_gift_coins = $gift_coins + $total_bid_amt;
$user_obj->update_gift_coins_final_balance($user_id,$final_gift_coins);
?>
<div class="" id="">
Your bid has been canceled!!
</div>