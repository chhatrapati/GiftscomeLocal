<?php session_start();
include('includes/config.php');
$user_obj = new Cl_User();
$game_id=$_POST['id_game'];
$total_bids_on_current_game = $user_obj->get_total_noof_bids($game_id);
@$uid =$_SESSION['id'];
$total_my_bet = $user_obj->total_bids_ongame_byuser($game_id,$uid);
if($total_my_bet=='')
{
	$total_my_bet='0';
}
if($total_bids_on_current_game=='')
{
	$total_bids_on_current_game='0';
}

echo  '<div class="my_bets" style="display:none;">'.$total_my_bet.'</div>';
echo $total_bids_on_current_game;

?>