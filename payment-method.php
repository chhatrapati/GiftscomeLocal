<?php 
session_start();
include('includes/config.php');
$user_obj = new Cl_User();
//error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
	//echo '<pre>'; print_r($_SESSION); die();
	$uid= $_SESSION['id'];
	//$quantity=$_SESSION['product_quantity'];
	//$pdd=$_SESSION['product_id'];
	//$pid=$_SESSION['product_id'];
	$_SESSION['tp'] = $_SESSION['tp'];
	//$user_balance = $_SESSION['gift_coins'].'.00';
	$items_list =$user_obj->cart_items($uid);
	$count = mysqli_num_rows($items_list);
	while($values = mysqli_fetch_array($items_list, MYSQLI_BOTH)) 
	{
		$product_id = $values["product_id"];
		if($values["product_cat"]=='7')
		{
			$sql123 =mysqli_query($con,"SELECT expire_date FROM package_sales WHERE user_id='$uid' AND CURRENT_DATE<=expire_date order BY expire_date DESC limit 1");
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
			$pckg_id = $values["product_id"];
			$pckg_name = $values["product_name"];
			$pro_quantity = $values["product_quantity"];
			
			$package_validity =$values["validity_of_vip_package"];
			$package_validity= $package_validity*$pro_quantity;
			$gift_coins_by_pckg =$values["gift_coins_value"];
			$gift_coins_by_pckg= $gift_coins_by_pckg*$pro_quantity;
			
			$date2 = str_replace('-', '/', $saledate);
			$expire_date_pre = date('Y-m-d',strtotime($date2 . "+$package_validity days"));
			$date3 = str_replace('-', '/', $expire_date_pre);
			$expire_date = date('Y-m-d',strtotime($date3 . "-1 days"));
			$typeof_coins ='Gift Coins';
            $remarks ="By Redeem ".$pckg_name;
		  mysqli_query($con,"INSERT INTO package_sales(package_id, user_id, saledate,package_validity,expire_date) VALUES('$pckg_id', '$uid', '$saledate','$package_validity','$expire_date')");
          $sql1=mysqli_query($con, "update users set user_type='vip' where id='$uid'");
		  $sql12 = mysqli_query($con,"INSERT INTO user_wallet(user_id, user_coins, coins_type, coins_get_by_package,reason_mode_of_coins,pakcage_validity) VALUES('$uid', '$gift_coins_by_pckg', '$typeof_coins', '$pckg_name','$remarks','$package_validity')");
		  $update_users_coins =$user_obj->update_user_coins_final_balance($uid,$gift_coins_by_pckg);
		  $user_obj->update_pro_payment_status($uid,$product_id);
		}
		else
		{
		mysqli_query($con,"insert into orders(userId,productId,quantity) values('".$uid."','".$values["product_id"]."','".$values["product_quantity"]."')");
		$user_obj->update_pro_payment_status($uid,$product_id);
		}
		
    }
	$user_balance= $user_obj->get_user_coins_balance($uid);
    $User_gift_coins= $user_balance['gift_coins'];
    $final_balance = $User_gift_coins - $_SESSION['tp']; //echo $final_balance; die();
	mysqli_query($con,"update users set gift_coins='".$final_balance."' where id='".$uid."'");
	/*Email to admin*/
$site_setting =$user_obj->get_general_setting();
$admin_email = $site_setting['site_email'];
$to = $admin_email;
//$to = 'preetmtharu@gmail.com';
$subject = 'New Order Received';
$msg ='<p>Hi, <br /><br /> A new order has been placed by user on giftscome, to view order details please login to admin panel and visit below link </p><p style="color:#080;font-size:18px;"><a href='.SITE_URL.'/admin/orders.php> '.SITE_URL.'/admin/orders.php </a></p>';
$user_obj->send_email($to,$subject,$msg);
header('location:thank-you-order.php');
}
?>