<?php
session_start();
require 'includes/config.php';
$user_obj = new Cl_User();
$my_user_id = $_SESSION['uid'];
$username=$_SESSION['username'];

$item_no = $_GET['item_number'];
$item_transaction = $_GET['tx'];
$item_price = $_GET['amt'];
$item_currency = $_GET['cc'];

//Getting packages details
$sql=mysqli_query($con,"select * from tbl_direct_coins_pur where id='$item_no'");
$row=mysqli_fetch_array($sql);
$name=$row['name'];
$price=$row['price'];
$gift_coins_value = $row['gift_coins_value'];
$typeof_coins ='Gift Coins';
$remarks ="By Direct Coins Purchase";
//Rechecking the packages details
if($item_price==$price)
{
$result = mysqli_query($con,"INSERT INTO tbl_dcp_sales(dcp_id, user_id, sale_date,transactionid) VALUES('$item_no', '$my_user_id', NOW(),'$item_transaction')");
$sql12 = mysqli_query($con,"INSERT INTO user_wallet(user_id, user_coins, coins_type, coins_get_by_package,reason_mode_of_coins) VALUES('$my_user_id', '$gift_coins_value', '$typeof_coins', '$name','$remarks')");

$update_users_coins =$user_obj->update_user_coins_final_balance($my_user_id,$gift_coins_value);
if($result){
  //echo "<h1>Welcome, $username</h1>";
  //echo '<pre>';
  //echo '<h1>Payment Successful</h1>';?>
  <script type="text/javascript">
	setTimeout(function () {
	var basepath = window.location.protocol + '//' + window.location.hostname;
	var path = basepath +'/thank-you.php';
	window.location.href= path; // the redirect goes here
	},1000); // 5 seconds
</script>
<?php    
}else{
    echo "Payment Error";
}
}
else
{
echo "Payment Failed";
}
?>
