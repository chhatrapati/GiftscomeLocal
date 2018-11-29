<?php
error_reporting(0);
require_once('includes/config.php');
$user_id ='104';
$expire_game_id ='314';
$winning_no ='5';
//$gift_coins_bal = $user_obj->get_user_coins_balance($user_id);
$data_new11=  mysqli_query($con,"select * from users where id='$user_id'")or die(mysqli_error());
$gift_coins_bal_1=mysqli_fetch_array($data_new11,MYSQLI_ASSOC); //echo '<pre>';print_r($data_new); die();
$gift_coins = $gift_coins_bal_1['gift_coins'];
//$data = $user_obj->get_users_by_winno($expire_game_id,$winning_no);
$data=mysqli_query($con, "select * from tbl_userbids  WHERE game_id ='$expire_game_id' AND bid_no = '$winning_no' group by user_id");
/*Fetch payout amount  of game on winning no*/
$sql44 = mysqli_query($con,"select payout_amount FROM tbl_game_payout WHERE game_id ='$expire_game_id' AND payout_digit = '$winning_no'");
$result44=mysqli_fetch_array($sql44);//print_r($result44);
$payout_amount =$result44['payout_amount'];
while($res=mysqli_fetch_array($data)) {
		$user_id = $res['user_id'];
		$bid_amount = $res['bid_amount'];
		$bid_no = $res['bid_no'];
		/*Fetch total no of bids placed by user on winning no of game*/
		//$total_bids = $user_obj->total_bids_byuser_onwinno($winning_no,$winning_no,$user_id);
		$sql99 = mysqli_query($con,"select SUM(bid_amount) FROM tbl_userbids WHERE game_id ='$expire_game_id' AND bid_no ='$winning_no' AND user_id ='$user_id' ");
		$result99=mysqli_fetch_array($sql99); //print_r($result99);
		$total_bids =$result99['SUM(bid_amount)'];
		$total_coins_won = $payout_amount*$total_bids;
		$final_gift_coins = $gift_coins + $total_coins_won;
		//$user_obj->update_gift_coins_final_balance($user_id,$final_gift_coins);
		$sql_123=mysqli_query($con,"update users set  gift_coins='".$final_gift_coins."'  where id='".$user_id."'");
		echo $sql_123;
}
?>