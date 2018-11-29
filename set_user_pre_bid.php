<?php
session_start();
error_reporting(0);
include('includes/config.php');
$uid =$_SESSION['id'];
//print_r($_POST);
$bid_amt0 = $_POST['bid_amt0'];
$bid_amt1 = $_POST['bid_amt1'];
$bid_amt2 = $_POST['bid_amt2'];
$bid_amt3 = $_POST['bid_amt3'];
$bid_amt4 = $_POST['bid_amt4'];
$bid_amt5 = $_POST['bid_amt5'];
$bid_amt6 = $_POST['bid_amt6'];
$bid_amt7 = $_POST['bid_amt7'];
$bid_amt8 = $_POST['bid_amt8'];
$bid_amt9 = $_POST['bid_amt9'];
$bid_amt10 = $_POST['bid_amt10'];
$bid_amt11 = $_POST['bid_amt11'];
$bid_amt12 = $_POST['bid_amt12'];
$bid_amt13 = $_POST['bid_amt13'];
$bid_amt14 = $_POST['bid_amt14'];
$bid_amt15 = $_POST['bid_amt15'];
$bid_amt16 = $_POST['bid_amt16'];
$bid_amt17 = $_POST['bid_amt17'];
$bid_amt18 = $_POST['bid_amt18'];
$bid_amt19 = $_POST['bid_amt19'];
$bid_amt20 = $_POST['bid_amt20'];
$bid_amt21 = $_POST['bid_amt21'];
$bid_amt22 = $_POST['bid_amt22'];
$bid_amt23 = $_POST['bid_amt23'];
$bid_amt24 = $_POST['bid_amt24'];
$bid_amt25 = $_POST['bid_amt25'];
$bid_amt26 = $_POST['bid_amt26'];
$bid_amt27 = $_POST['bid_amt27'];
$no_of_games = $_POST['no_of_games'];
$game_id = $_POST['game_id'];
$total_pre_bids = $bid_amt0 + $bid_amt1 + $bid_amt2 + $bid_amt3 + $bid_amt4 + $bid_amt5 + $bid_amt6 + $bid_amt7 + $bid_amt8 + $bid_amt9 + $bid_amt10 + $bid_amt11 + $bid_amt12 + $bid_amt13 + $bid_amt14 + $bid_amt15 + $bid_amt16 + $bid_amt17 + $bid_amt18 + $bid_amt19 + $bid_amt20 + $bid_amt21 + $bid_amt22 + $bid_amt23 + $bid_amt24 + $bid_amt25 + $bid_amt26 + $bid_amt27; 
$sql = mysqli_query($con,"SELECT * FROM tbl_user_robot where user_id ='$uid'");
$result=mysqli_fetch_array($sql);
if($result=='')
{
$sql=mysqli_query($con,"insert into tbl_user_robot(bid_0,bid_1,bid_2,bid_3,bid_4,bid_5,bid_6,bid_7,bid_8,bid_9,bid_10,bid_11,bid_12,bid_13,bid_14,bid_15,bid_16,bid_17,bid_18,bid_19,bid_20,bid_21,bid_22,bid_23,bid_24,bid_25,bid_26,bid_27,user_id,total_bids,no_of_games,game_id) values('$bid_amt0','$bid_amt1','$bid_amt2','$bid_amt3','$bid_amt4','$bid_amt5','$bid_amt6','$bid_amt7','$bid_amt8','$bid_amt9','$bid_amt10','$bid_amt11','$bid_amt12','$bid_amt13','$bid_amt14','$bid_amt15','$bid_amt16','$bid_amt17','$bid_amt18','$bid_amt19','$bid_amt20','$bid_amt21','$bid_amt22','$bid_amt23','$bid_amt24','$bid_amt25','$bid_amt26','$bid_amt27','$uid',$total_pre_bids,$no_of_games,$game_id)");
}

else
{
$sql=mysqli_query($con,"update tbl_user_robot set bid_0='$bid_amt0',bid_1='$bid_amt1', bid_2='$bid_amt2',bid_3='$bid_amt3',bid_4='$bid_amt4',bid_5='$bid_amt5',bid_6='$bid_amt6',bid_7='$bid_amt7',bid_8='$bid_amt8',bid_9='$bid_amt9',bid_10='$bid_amt10',bid_11='$bid_amt11',bid_12='$bid_amt12',bid_13='$bid_amt13',bid_14='$bid_amt14',bid_15='$bid_amt15',bid_16='$bid_amt16',bid_17='$bid_amt17',bid_18='$bid_amt18',bid_19='$bid_amt19',bid_20='$bid_amt20',bid_21='$bid_amt21',bid_22='$bid_amt22',bid_23='$bid_amt23',bid_24='$bid_amt24',bid_25='$bid_amt25',bid_26='$bid_amt26',bid_27='$bid_amt27',total_bids='$total_pre_bids',no_of_games='$no_of_games',game_id='$game_id' where user_id ='$uid' ");
}
require_once('auto-bids-latest.php');
?>