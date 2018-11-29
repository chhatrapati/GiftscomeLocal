<?php
session_start();
error_reporting(0);
require_once('includes/config.php');
$user_obj = new Cl_User();
$uid = $_SESSION['id'];
$user_balance= $user_obj->get_user_coins_balance($uid);
echo $User_gift_coins= $user_balance['gift_coins'];
//print_r($user_balance);
$amazon_pro_name='retretre';
$amazon_pro_link='rtetre';
$amazon_pro_price='10';
$gift_coins_exchange_rate = $user_obj->gift_coins_exchange_rate();
echo $price = $amazon_pro_price*$gift_coins_exchange_rate;
if($User_gift_coins >= $price)
{

?>

<div class="alert alert-success" id="">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Well done!</strong>	Your order has been submitted
</div>	
<?php mysqli_query($con,"insert into tbl_amazon_orders(user_id,product_name,product_url,product_price,order_date) values('".$uid."','".$amazon_pro_name."','".$amazon_pro_link."','".$amazon_pro_price."',NOW())");
//echo $final_balance = $user_balance - $price; //echo $final_balance; die();
echo mysqli_query($con,"update users set gift_coins=gift_coins-'".$price."' where id='104'");
}
else
{?>

<div class="alert alert-danger" id="">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Oops!</strong>	Your Coins Balance is not enough to purchase items
</div>
<?php }

?>