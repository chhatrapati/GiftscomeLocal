<?php
error_reporting(0);
include('includes/config.php');
$user_obj = new Cl_User();
$game_id=toInternalId($_POST['game_id']);
//$user_id=$_POST['user_id'];
?>
<?php
$sql345 = mysqli_query($con,"select winning_no from tbl_game where id ='$game_id'");
$result345=mysqli_fetch_array($sql345);
$winno = $result345['winning_no'];
$winner_list = mysqli_query($con,"select user_id, SUM(bid_amount) as bid_amount, bid_no,(select payout_amount FROM tbl_game_payout WHERE game_id ='$game_id' AND payout_digit = '$winno') as payout_amount  from tbl_userbids where game_id ='$game_id' AND bid_no ='$winno' AND bid_amount >0 GROUP BY user_id ");
while($res=mysqli_fetch_array($winner_list)) {
$user_id = $res['user_id'];
$bid_amount = $res['bid_amount'];
$bid_no = $res['bid_no'];
$payout_amount =$res['payout_amount'];
$total_won = $bid_amount*$payout_amount;
/*Check if user has alreday inserted in winner table*/
$query_987 = "SELECT * FROM tbl_winners where game_id = '$game_id' and user_id ='$user_id'";
$result_987 = mysqli_query($con, $query_987) or die(mysqli_error($con));
$rowcount_987=mysqli_num_rows($result_987);
if($rowcount_987 ==0)
{
$query_142=mysqli_query($con, "insert into tbl_winners(game_id,user_id,total_bid_amount,total_won_coins) values('$game_id','$user_id','$bid_amount','$total_won')");

//$result = $user_obj->get_points_supplement();
$sql_478 = mysqli_query($con,"select * from user_points_supplement");
$result=mysqli_fetch_array($sql_478); //print_r($result);			
$points_by_game_won = $result['points_by_game_won'];
//$user_obj->set_user_points($user_id,$points_by_game_won,'By Game Won');
$query_11=mysqli_query($con, "insert into tbl_users_points(user_id,user_points,points_by) values('$user_id','$points_by_game_won','By Game Won')");
//$user_obj->set_points_users($user_id);
$sql1=mysqli_query($con, "update users set user_points= (select sum(user_points) from tbl_users_points where user_id='$user_id') where id='$user_id'");
$sql_123=mysqli_query($con,"update users set gift_coins=gift_coins+'".$total_won."'  where id='".$user_id."'");
/*Update total gift coins balance of user*/
/*Update Coins Transaction*/
$remarks='By Game Won';
$query_5812=mysqli_query($con, "insert into user_wallet(user_id,user_coins,reason_mode_of_coins,coins_type,date_of_coins_get) values('$user_id','$total_won','$remarks','gift_coins',NOW())");
}
}
/*Update Total Bids And Total Won Coins of game into tbl_game*/
$sql_322 = mysqli_query($con,"select SUM(bid_amount) as total_bid_amt,(select SUM(total_won_coins) FROM tbl_winners WHERE game_id ='$game_id') as total_won_coins FROM tbl_userbids WHERE game_id ='$game_id'");
$result_344=mysqli_fetch_array($sql_322);
$total_bids =$result_344['total_bid_amt'];
$total_won_coins =$result_344['total_won_coins'];
$sql_563=mysqli_query($con, "update tbl_game set total_bids='$total_bids',total_won_coins='$total_won_coins' where id='$game_id'");
?>
<script>
 $(document).ready(function(){
        //setTimeout(function() {
			location.reload();
       // }, 2000);
    });
</script>