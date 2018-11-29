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
	$quantity=$_SESSION['product_quantity'];
	//$pdd=$_SESSION['product_id'];
	$pid=$_SESSION['product_id'];
	$_SESSION['tp'] = $_SESSION['tp'];
	//$user_balance = $_SESSION['gift_coins'].'.00';
    $user_balance= $user_obj->get_user_coins_balance($uid);
    $User_gift_coins= $user_balance['gift_coins'];
	foreach ($_SESSION["shopping_cart"] as $keys => $values)
	{
		mysqli_query($con,"insert into orders(userId,productId,quantity) values('".$uid."','".$values["product_id"]."','".$values["product_quantity"]."')");
    }
    $final_balance = $User_gift_coins - $_SESSION['tp']; //echo $final_balance; die();
	mysqli_query($con,"update users set gift_coins='".$final_balance."' where id='".$uid."'");
	unset($_SESSION['shopping_cart']);
	header('location:thank-you-order.php');
}
?>