<?php
session_start();
error_reporting(0);
include('include/config.php');
/*$bid_amt0 = trim($_POST['bid_amt0']);
$bid_amt1 = trim($_POST['bid_amt1']);

echo "Welcome ". $bid_amt0; die();*/
//extract($_POST);
//print_r($_POST);
$bid_amt0=$_POST['bid_amt0'];
	$bid_amt1=$_POST['bid_amt1'];
	$bid_amt2=$_POST['bid_amt2'];
	$bid_amt3=$_POST['bid_amt3'];
	$bid_amt4=$_POST['bid_amt4'];
	$bid_amt5=$_POST['bid_amt5'];
	$bid_amt6=$_POST['bid_amt6'];
	$bid_amt7=$_POST['bid_amt7'];
	$bid_amt8=$_POST['bid_amt8'];
	$bid_amt9=$_POST['bid_amt9'];
	$bid_amt10=$_POST['bid_amt10'];
	$bid_amt11=$_POST['bid_amt11'];
	$bid_amt12=$_POST['bid_amt12'];
	$bid_amt13=$_POST['bid_amt13'];
	$bid_amt14=$_POST['bid_amt14'];
	$bid_amt15=$_POST['bid_amt15'];
	$bid_amt16=$_POST['bid_amt16'];
	$bid_amt17=$_POST['bid_amt17'];
	$bid_amt18=$_POST['bid_amt18'];
	$bid_amt19=$_POST['bid_amt19'];
	$bid_amt20=$_POST['bid_amt20'];
	$bid_amt21=$_POST['bid_amt21'];
	$bid_amt22=$_POST['bid_amt22'];
	$bid_amt23=$_POST['bid_amt23'];
	$bid_amt24=$_POST['bid_amt24'];
	$bid_amt25=$_POST['bid_amt25'];
	$bid_amt26=$_POST['bid_amt26'];
	$bid_amt27=$_POST['bid_amt27'];
	//echo 'prrrrr';die();
	$sql=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt0' where id =1");
	$sql1=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt1' where id =2");
	$sql2=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt2' where id =3");
	$sql3=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt3' where id =4");
	$sql4=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt4' where id =5");
	$sql5=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt5' where id =6");
	$sql6=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt6' where id =7");
	$sql7=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt7' where id =8");
	$sql8=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt8' where id =9");
	$sql9=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt9' where id =10");
	$sql10=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt10' where id =11");
	$sql11=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt11' where id =12");
	$sql12=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt12' where id =13");
	$sql13=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt13' where id =14");
	$sql14=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt14' where id =15");
	$sql15=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt15' where id =16");
	$sql16=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt16' where id =17");
	$sql17=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt17' where id =18");
	$sql18=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt18' where id =19");
	$sql19=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt19' where id =20");
	$sql20=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt20' where id =21");
	$sql21=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt21' where id =22");
	$sql22=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt22' where id =23");
	$sql23=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt23' where id =24");
	$sql24=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt24' where id =25");
	$sql25=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt25' where id =26");
	$sql26=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt26' where id =27");
	$sql27=mysqli_query($con, "update tbl_default_bids set bid_amt='$bid_amt27' where id =28");
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