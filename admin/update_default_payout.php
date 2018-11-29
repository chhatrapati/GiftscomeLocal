<?php
session_start();
error_reporting(0);
include('include/config.php');
/*$payout_amount0 = trim($_POST['payout_amount0']);
$payout_amount1 = trim($_POST['payout_amount1']);

echo "Welcome ". $payout_amount0; die();*/
//extract($_POST);
//print_r($_POST);
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
	$sql=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount0' where id =1");
	$sql1=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount1' where id =2");
	$sql2=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount2' where id =3");
	$sql3=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount3' where id =4");
	$sql4=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount4' where id =5");
	$sql5=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount5' where id =6");
	$sql6=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount6' where id =7");
	$sql7=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount7' where id =8");
	$sql8=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount8' where id =9");
	$sql9=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount9' where id =10");
	$sql10=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount10' where id =11");
	$sql11=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount11' where id =12");
	$sql12=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount12' where id =13");
	$sql13=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount13' where id =14");
	$sql14=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount14' where id =15");
	$sql15=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount15' where id =16");
	$sql16=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount16' where id =17");
	$sql17=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount17' where id =18");
	$sql18=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount18' where id =19");
	$sql19=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount19' where id =20");
	$sql20=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount20' where id =21");
	$sql21=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount21' where id =22");
	$sql22=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount22' where id =23");
	$sql23=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount23' where id =24");
	$sql24=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount24' where id =25");
	$sql25=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount25' where id =26");
	$sql26=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount26' where id =27");
	$sql27=mysqli_query($con, "update tbl_default_payout set payout_amount='$payout_amount27' where id =28");
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