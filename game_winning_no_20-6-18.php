<?php
error_reporting(1);
include('includes/config.php');
$user_obj = new Cl_User();
$game_id=$_POST['game_id'];
$user_id=$_POST['user_id'];
//$total_bids_byuser_ongame = $user_obj->total_bids_ongame_byuser($game_id,$user_id);
?>
<?php
$sql345 = mysqli_query($con,"select winning_no from tbl_game where id ='$game_id'");
$result345=mysqli_fetch_array($sql345);
$winno = $result345['winning_no'];
/*Fetch payout amount  of game on winning no*/
$payout_amount = $user_obj->get_payout_amount_OnWin_no($game_id,$winno);
/*Select winning users and their total no of bids on winning no and total won coins*/
$winner_list = $user_obj->get_winner_totalwon_totalbid($game_id,$winno);
//print_r($winner_list);				

while($res=mysqli_fetch_array($winner_list)) {
$user_id = $res['user_id'];
$bid_amount = $res['bid_amount'];
$bid_no = $res['bid_no'];
$total_won = $bid_amount*$payout_amount;
/*Inser winning users into tbl_winners*/
//$user_obj->insert_winners($expire_game_id,$user_id,$bid_amount,$total_won);
$query_142=mysqli_query($con, "insert into tbl_winners(game_id,user_id,total_bid_amount,total_won_coins) values('".$game_id."','$user_id','$bid_amount','$total_won')");
//$user_obj->set_user_points($user_id,'100','By Game Won');
$result = $user_obj->get_points_supplement();
$points_by_game_won = $result['points_by_game_won'];
$user_obj->set_user_points($user_id,$points_by_game_won,'By Game Won');
$user_obj->set_points_users($user_id);
/*Update total gift coins balance of user*/
$sql_123=mysqli_query($con,"update users set gift_coins=gift_coins+'".$total_won."'  where id='".$user_id."'");
}
/*Update Total Bids And Total Won Coins of game into tbl_game*/
$sql_322 = mysqli_query($con,"select SUM(bid_amount) as total_bid_amt FROM tbl_userbids WHERE game_id ='".$game_id."'");
$result_344=mysqli_fetch_array($sql_322);
$total_bids =$result_344['total_bid_amt'];
$sql_563=mysqli_query($con, "update tbl_game set total_bids='".$total_bids."' where id='".$game_id."'");
/*Update total won coins*/
$sql_967 = mysqli_query($con,"select SUM(total_won_coins) as total_won_coins FROM tbl_winners WHERE game_id ='".$game_id."'");
$result_967=mysqli_fetch_array($sql_967);
$total_won_coins =$result_967['total_won_coins'];
$sql_843=mysqli_query($con, "update tbl_game set total_won_coins='".$total_won_coins."' where id='".$game_id."'");
// $gift_coins_bal = $user_obj->get_user_coins_balance($user_id);
// $gift_coins = $gift_coins_bal['gift_coins'];
// $rem_coins = $gift_coins - $total_bids_byuser_ongame;
// $data = $user_obj->get_users_by_winno($game_id,$winno);
// while($res=mysqli_fetch_array($data)) {
		// $user_id = $res['user_id'];
		// $bid_amount = $res['bid_amount'];
		// $bid_no = $res['bid_no'];
		// /*Fetch total no of bids placed by user on winning no of game*/
		// $total_bids = $user_obj->total_bids_byuser_onwinno($game_id,$winno,$user_id);
		// $total_coins_won = $payout_amount*$total_bids;
		// $final_gift_coins = $rem_coins + $total_coins_won;
		// $user_obj->update_gift_coins_final_balance($user_id,$final_gift_coins);
// }
?>
<!--<script>
 $(document).ready(function(){
        setTimeout(function() {
          //$('#msg').fadeOut('fast');
        }, 2000);
    });
</script>-->