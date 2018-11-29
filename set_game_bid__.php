<?php
session_start();
error_reporting(0);
include('includes/config.php');
/*$payout_amount0 = trim($_POST['payout_amount0']);
$payout_amount1 = trim($_POST['payout_amount1']);

echo "Welcome ". $payout_amount0; die();*/
//extract($_POST);
//print_r($_POST);
$game_id=$_POST['game_id'];
$user_id=$_POST['user_id'];
$final_gift_coins=$_POST['final_gift_coins'];
$payout_amount0=$_POST['payout_amount0'];
	$payout_amount1=$_POST['payout_amount1'];
	$payout_amount2=$_POST['payout_amount2'];
	$payout_amount3=$_POST['payout_amount3'];
	$payout_amount4=$_POST['payout_amount4'];
	$payout_amount5=$_POST['payout_amount5'];
	$payout_amount6=$_POST['payout_amount6'];
	$payout_amount7=$_POST['payout_amount7'];
	$payout_amount8=$_POST['payout_amount8'];
	$payout_amount9=$_POST['payout_amount9'];
	$payout_amount10=$_POST['payout_amount10'];
	$payout_amount11=$_POST['payout_amount11'];
	$payout_amount12=$_POST['payout_amount12'];
	$payout_amount13=$_POST['payout_amount13'];
	$payout_amount14=$_POST['payout_amount14'];
	$payout_amount15=$_POST['payout_amount15'];
	$payout_amount16=$_POST['payout_amount16'];
	$payout_amount17=$_POST['payout_amount17'];
	$payout_amount18=$_POST['payout_amount18'];
	$payout_amount19=$_POST['payout_amount19'];
	$payout_amount20=$_POST['payout_amount20'];
	$payout_amount21=$_POST['payout_amount21'];
	$payout_amount22=$_POST['payout_amount22'];
	$payout_amount23=$_POST['payout_amount23'];
	$payout_amount24=$_POST['payout_amount24'];
	$payout_amount25=$_POST['payout_amount25'];
	$payout_amount26=$_POST['payout_amount26'];
	$payout_amount27=$_POST['payout_amount27'];
	
	$sql=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','0','$payout_amount0','$user_id')");
	$sql1=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','1','$payout_amount1','$user_id')");
	$sql2=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','2','$payout_amount2','$user_id')");
	$sql3=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','3','$payout_amount3','$user_id')");
	$sq4=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','4','$payout_amount4','$user_id')");
	$sql5=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','5','$payout_amount5','$user_id')");
	$sql6=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','6','$payout_amount6','$user_id')");
	$sql7=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','7','$payout_amount7','$user_id')");
	$sql8=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','8','$payout_amount8','$user_id')");
	$sql9=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','9','$payout_amount9','$user_id')");
	$sql10=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','10','$payout_amount10','$user_id')");
	$sql11=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','11','$payout_amount11','$user_id')");
	$sql12=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','12','$payout_amount12','$user_id')");
	$sql13=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','13','$payout_amount13','$user_id')");
	$sql14=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','14','$payout_amount14','$user_id')");
	$sql15=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','15','$payout_amount15','$user_id')");
	$sql16=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','16','$payout_amount16','$user_id')");
	$sql17=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','17','$payout_amount17','$user_id')");
	$sql18=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','18','$payout_amount18','$user_id')");
	$sql19=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','19','$payout_amount19','$user_id')");
	$sql20=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','20','$payout_amount20','$user_id')");
	$sql21=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','21','$payout_amount21','$user_id')");
	$sql22=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','22','$payout_amount22','$user_id')");
	$sql23=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','23','$payout_amount23','$user_id')");
	$sql24=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','24','$payout_amount24','$user_id')");
	$sql25=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','25','$payout_amount25','$user_id')");
	$sql26=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','26','$payout_amount26','$user_id')");
	$sql27=mysqli_query($con,"insert into tbl_userbids(game_id,bid_no,bid_amount,user_id) values('$game_id','27','$payout_amount27','$user_id')");
	?>
	<?php
	$user_obj = new Cl_User();
	@$data = $user_obj->update_gift_coins_final_balance($user_id,$final_gift_coins);
	
	?>
	<div class="alert alert-success" id="successMessage">
	<?php //echo '<pre>'; print_r($data); ?>
	<strong>Well done!! </strong>Your bid has been submitted successfully !!
	</div>
<script>
 $(document).ready(function(){
	 document.getElementById("game_zone").reset();
        setTimeout(function() {
          $('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    });
</script>