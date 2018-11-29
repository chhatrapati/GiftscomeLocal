<?php
error_reporting(1);
include('includes/config.php');
$user_obj = new Cl_User();
$game_id=$_POST['game_id'];
$rem_coins = $_POST['rem_coins'];
/*Code of fetch winning no*/
//$sp = "CALL get_winnig_no($game_id)";
//$result = mysqli_query($con, $sp) or die(mysqli_error($con));
//$row=mysqli_fetch_array($result); print_r($row);
//mysqli_free_result();
//mysqli_next_result($con);
?>
<?php
$user_obj->set_user_points($user_id,'50','By Play Game');
/*Fetch payout amount  of game on winning no*/
$payout_amount = $user_obj->get_payout_amount_OnWin_no($game_id,$winno);
/*Select winning users and their total no of bids on winning no and tottal won coins*/
$winner_list = $user_obj->get_winner_totalwon_totalbid($game_id,$winno);
while($res=mysqli_fetch_array($winner_list)) {
$user_id = $res['user_id'];
$bid_amount = $res['bid_amount'];
$bid_no = $res['bid_no'];
$total_won = $bid_amount*$payout_amount;
/*Inser winning users into tbl_winners*/
$user_obj->insert_winners($game_id,$user_id,$bid_amount,$total_won);
$user_obj->set_user_points($user_id,'100','By Game Won');
/*Update total gift coins balance of user*/
}
$gift_coins_bal = $user_obj->get_user_coins_balance($user_id);
$gift_coins = $gift_coins_bal['gift_coins'];
$data = $user_obj->get_users_by_winno($game_id,$winno);
while($res=mysqli_fetch_array($data)) {
		$user_id = $res['user_id'];
		$bid_amount = $res['bid_amount'];
		$bid_no = $res['bid_no'];
		/*Fetch total no of bids placed by user on winning no of game*/
		$total_bids = $user_obj->total_bids_byuser_onwinno($game_id,$winno,$user_id);
		$total_coins_won = $payout_amount*$total_bids;
		$final_gift_coins = $gift_coins + $total_coins_won;
		$user_obj->update_gift_coins_final_balance($user_id,$final_gift_coins);
}
?>
<?php
$sql12=mysqli_query($con, "select * from tbl_game where id='$game_id'");
$row_12 = mysqli_fetch_array($sql12, MYSQLI_BOTH); //print_r($row_12);
$winning_no = $row_12['winning_no'];
$winn_no01 = $row_12['game_wining_number1'];
$winn_no02 = $row_12['game_wining_number2'];
$winn_no03 = $row_12['game_wining_number3'];
?>
<div class="" id="">
<strong>Winning number is: </strong><?php echo $winn_no01;?> + <?php echo $winn_no02;?> + <?php echo $winn_no03;?> = <?php echo $winning_no;?><a target="_blank" href="users-game-history.php?game=<?php echo toPublicId($game_id);?>"> <b>See Result</b></a>
</div>