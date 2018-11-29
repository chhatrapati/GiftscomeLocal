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
$sql=mysqli_query($con,"select package_id,package_name,package_price,package_validity,gift_coins,currency from package where package_id='$item_no'");
$row=mysqli_fetch_array($sql);
$package_name=$row['package_name'];
$package_validity=$row['package_validity'];
//$user_coins = $row['coins_value'];
$user_gift_coins = $row['gift_coins'];
$price=$row['package_price'];
$currency=$row['currency'];
$typeof_coins ='Gift Coins';
$remarks ="By Subscribe Package";
$sql123 =mysqli_query($con,"SELECT expire_date FROM package_sales WHERE user_id='$my_user_id' AND CURRENT_DATE<=expire_date order BY expire_date DESC limit 1");
$row123=mysqli_fetch_array($sql123);
$expire_date_prev= $row123['expire_date'];
if($expire_date_prev!='')
{
	
	$date1 = str_replace('-', '/', $expire_date_prev);
    $saledate = date('Y-m-d',strtotime($date1 . "+1 days"));
}
else
{
	$saledate=date('Y-m-d');
}
//Rechecking the packages details
if($item_price==$price && $item_currency==$currency)
{
$date2 = str_replace('-', '/', $saledate);
$expire_date_pre = date('Y-m-d',strtotime($date2 . "+$package_validity days"));
$date3 = str_replace('-', '/', $expire_date_pre);
$expire_date = date('Y-m-d',strtotime($date3 . "-1 days"));
//$expire_date = date('Y-m-d', strtotime("+$package_validity days"));
$result = mysqli_query($con,"INSERT INTO package_sales(package_id, user_id, saledate,package_validity,transactionid,expire_date) VALUES('$item_no', '$my_user_id', '$saledate','$package_validity','$item_transaction','$expire_date')");
$sql1=mysqli_query($con, "update users set user_type='vip' where id='$my_user_id'");
$sql12 = mysqli_query($con,"INSERT INTO user_wallet(user_id, user_coins, coins_type, coins_get_by_package,reason_mode_of_coins,pakcage_validity) VALUES('$my_user_id', '$user_gift_coins', '$typeof_coins', '$package_name','$remarks','$package_validity')");
$update_users_coins =$user_obj->update_user_coins_final_balance($my_user_id,$user_gift_coins);
if($result){
  //echo "<h1>Welcome, $username</h1>";
  //echo '<pre>';
  //echo '<h1>Payment Successful</h1>';?>
  <script type="text/javascript">
	setTimeout(function () {
	var basepath = window.location.protocol + '//' + window.location.hostname;
	var path = basepath +'/thanks.php';
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
