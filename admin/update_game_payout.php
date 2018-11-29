<?php
session_start();
error_reporting(0);
include('include/config.php');
$game_id=$_POST['game_id'];
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
	//echo 'prrrrr';die();
	$sql=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount0' where payout_digit =0 AND game_id = '$game_id'");
	$sql=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount1' where payout_digit =1 AND game_id = '$game_id'");
	$sql1=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount2' where payout_digit =2 AND game_id = '$game_id'");
	$sql2=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount3' where payout_digit =3 AND game_id = '$game_id'");
	$sql3=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount4' where payout_digit =4 AND game_id = '$game_id'");
	$sql4=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount5' where payout_digit =5 AND game_id = '$game_id'");
	$sql5=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount6' where payout_digit =6 AND game_id = '$game_id'");
	$sql6=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount7' where payout_digit =7 AND game_id = '$game_id'");
	$sql7=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount8' where payout_digit =8 AND game_id = '$game_id'");
	$sql8=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount9' where payout_digit =9 AND game_id = '$game_id'");
	$sql9=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount10' where payout_digit =10 AND game_id = '$game_id'");
	$sql10=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount11' where payout_digit =11 AND game_id = '$game_id'");
	$sql11=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount12' where payout_digit =12 AND game_id = '$game_id'");
	$sql12=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount13' where payout_digit =13 AND game_id = '$game_id'");
	$sql13=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount14' where payout_digit =14 AND game_id = '$game_id'");
	$sql14=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount15' where payout_digit =15 AND game_id = '$game_id'");
	$sql15=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount16' where payout_digit =16 AND game_id = '$game_id'");
	$sql16=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount17' where payout_digit =17 AND game_id = '$game_id'");
	$sql17=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount18' where payout_digit =18 AND game_id = '$game_id'");
	$sql18=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount19' where payout_digit =19 AND game_id = '$game_id'");
	$sql19=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount20' where payout_digit =20 AND game_id = '$game_id'");
	$sql20=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount21' where payout_digit =21 AND game_id = '$game_id'");
	$sql21=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount22' where payout_digit =22 AND game_id = '$game_id'");
	$sql22=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount23' where payout_digit =23 AND game_id = '$game_id'");
	$sql23=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount24' where payout_digit =24 AND game_id = '$game_id'");
	$sql24=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount25' where payout_digit =25 AND game_id = '$game_id'");
	$sql25=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount26' where payout_digit =26 AND game_id = '$game_id'");
	$sql26=mysqli_query($con, "update tbl_game_payout set payout_amount='$payout_amount27' where payout_digit =27 AND game_id = '$game_id'");
	?>
	<div class="alert alert-success" id="successMessage">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Well done!</strong>	Record Updated !!
	</div>
<script>
 $(document).ready(function(){
        setTimeout(function() {
          $('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    });
</script>