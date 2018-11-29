<?php
error_reporting(1);
include('includes/config.php');
$user_obj = new Cl_User();
$game_id=$_POST['game_id'];
$user_id=$_POST['user_id'];
$rem_coins = $_POST['rem_coins'];

?>
<?php
$sql345 = mysqli_query($con,"select winning_no from tbl_game where id ='$game_id'");
$result345=mysqli_fetch_array($sql345);
$winno = $result345['winning_no'];
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
$result = $user_obj->get_points_supplement();
$points_by_game_won = $result['points_by_game_won'];
$user_obj->set_user_points($user_id,$points_by_game_won,'By Game Won');
$user_obj->set_points_users($user_id);
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
		$final_gift_coins = $rem_coins + $total_coins_won;
		$user_obj->update_gift_coins_final_balance($user_id,$final_gift_coins);
}
?>
<script>
 $(document).ready(function(){
        setTimeout(function() {
          //$('#msg').fadeOut('fast');
        }, 5000);
    });
</script>