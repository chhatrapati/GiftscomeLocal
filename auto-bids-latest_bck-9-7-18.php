<?php
$ret = mysqli_query($con,"select * from tbl_game WHERE game_status=0 or game_status=1 ");
//print_r($ret);die();
while($row=mysqli_fetch_array($ret))
{
	$future_game_id= $row['id'];
	$game_name= $row['game_name'];
	$winning_no= $row['winning_no'];
/*User's robot bid on game*/
$pre_bids = mysqli_query($con,"SELECT * FROM tbl_user_robot where status=1");
if($pre_bids)
{
$i = 0;
while($resdata=mysqli_fetch_array($pre_bids)) {
	
	$user_id= $resdata['user_id'];
	$bid_no = $i;
	$payout_amount = $resdata['bid_'.$i];
	$bid_0= $resdata['bid_0'];
	$bid_1 = $resdata['bid_1'];
	$bid_2 = $resdata['bid_2'];
	$bid_3= $resdata['bid_3'];
	$bid_4= $resdata['bid_4'];
	$bid_5= $resdata['bid_5'];
	$bid_6= $resdata['bid_6'];
	$bid_7= $resdata['bid_7'];
	$bid_8= $resdata['bid_8'];
	$bid_9= $resdata['bid_9'];
	$bid_10= $resdata['bid_10'];
	$bid_11= $resdata['bid_11'];
	$bid_12= $resdata['bid_12'];
	$bid_13= $resdata['bid_13'];
	$bid_14= $resdata['bid_14'];
	$bid_15= $resdata['bid_15'];
	$bid_16= $resdata['bid_16'];
	$bid_17= $resdata['bid_17'];
	$bid_18= $resdata['bid_18'];
	$bid_19= $resdata['bid_19'];
	$bid_20= $resdata['bid_20'];
	$bid_21= $resdata['bid_21'];
	$bid_22= $resdata['bid_22'];
	$bid_23= $resdata['bid_23'];
	$bid_24= $resdata['bid_24'];
	$bid_25= $resdata['bid_25'];
	$bid_26= $resdata['bid_26'];
	$bid_27= $resdata['bid_27'];
	$total_pre_bids = $resdata['total_bids'];
	
//$bids_by_user = $user_obj->bids_ongame_byuser($game_id,$user_id);
$bids_by_user = mysqli_query($con,"SELECT * FROM tbl_userbids where game_id ='$future_game_id' AND user_id ='$user_id'");
$result=mysqli_fetch_array($bids_by_user);
//echo '<pre>';print_r($result);
//$gift_coins_bal = $user_obj->get_user_coins_balance($user_id);
$data_new=  mysqli_query($con,"select * from users where id='$user_id'")or die(mysqli_error());
$gift_coins_bal=mysqli_fetch_array($data_new,MYSQLI_ASSOC); //echo '<pre>';print_r($data_new); die();
$gift_coins = $gift_coins_bal['gift_coins'];
$avail_coins = $gift_coins;
$total_pre_bids =$total_pre_bids;
if($avail_coins >= $total_pre_bids)
{
/*Set remaining gift coins after bid coins on game*/
$final_rem_gcoins = $avail_coins - $total_pre_bids;
$sql_453=mysqli_query($con,"update users set  gift_coins='".$final_rem_gcoins."'  where id='".$user_id."'");

	if($result=='')
{
	//$sql=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','$bid_no','$payout_amount','$user_id')");
	$sql=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','0','$bid_0','$user_id')");
	$sql1=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','1','$bid_1','$user_id')");
	$sql2=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','2','$bid_2','$user_id')");
	$sql3=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','3','$bid_3','$user_id')");
	$sq4=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','4','$bid_4','$user_id')");
	$sql5=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','5','$bid_5','$user_id')");
	$sql6=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','6','$bid_6','$user_id')");
	$sql7=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','7','$bid_7','$user_id')");
	$sql8=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','8','$bid_8','$user_id')");
	$sql9=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','9','$bid_9','$user_id')");
	$sql10=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','10','$bid_10','$user_id')");
	$sql11=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','11','$bid_11','$user_id')");
	$sql12=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','12','$bid_12','$user_id')");
	$sql13=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','13','$bid_13','$user_id')");
	$sql14=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','14','$bid_14','$user_id')");
	$sql15=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','15','$bid_15','$user_id')");
	$sql16=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','16','$bid_16','$user_id')");
	$sql17=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','17','$bid_17','$user_id')");
	$sql18=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','18','$bid_18','$user_id')");
	$sql19=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','19','$bid_19','$user_id')");
	$sql20=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','20','$bid_20','$user_id')");
	$sql21=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','21','$bid_21','$user_id')");
	$sql22=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','22','$bid_22','$user_id')");
	$sql23=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','23','$bid_23','$user_id')");
	$sql24=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','24','$bid_24','$user_id')");
	$sql25=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','25','$bid_25','$user_id')");
	$sql26=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','26','$bid_26','$user_id')");
	$sql27=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$future_game_id','27','$bid_27','$user_id')");
} 
else
{
   $sql=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_0' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='0'");
   $sql1=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_1' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='1'");
   $sql2=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_2' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='2'");
   $sql3=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_3' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='3'");
   $sq4=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_4' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='4'");
   $sql5=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_5' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='5'");
   $sql6=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_6' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='6'");
   $sql7=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_7' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='7'");
   $sql8=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_8' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='8'");
   $sql9=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_9' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='9'");
   $sql10=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_10' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='10'");
   $sql11=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_11' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='11'");
   $sq112=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_12' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='12'");
   $sql13=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_13' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='13'");
   $sql14=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_14' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='14'");
   $sql15=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_15' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='15'");
   $sq116=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_16' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='16'");
   $sql17=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_17' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='17'");
   $sql18=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_18' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='18'");
   $sql19=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_19' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='19'");
   $sql20=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_20' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='20'");
   $sql21=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_21' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='21'");
   $sql22=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_22' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='22'");
   $sql23=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_23' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='23'");
   $sql24=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_24' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='24'");
   $sql25=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_25' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='25'");
   $sql26=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_26' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='26'");
   $sql27=mysqli_query($con,"update tbl_userbids set bid_amount='$bid_27' where game_id ='$future_game_id' AND user_id ='$user_id' AND bid_no ='27'");
}

$i++;	
}
else
{
$_SESSION['alert_msg']="Your coins balance is not enough to bid on game!!";
//$query345=mysqli_query($con,"update tbl_user_robot set status='0' where user_id ='$user_id' ");
}	
}

}
	
}
?>