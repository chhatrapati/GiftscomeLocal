<?php
session_start();
error_reporting(0);
require_once('includes/config.php');
$user_obj = new Cl_User();
$uid = $_SESSION['id'];
$user_balance= $user_obj->get_user_coins_balance($uid);
$User_gift_coins= $user_balance['gift_coins'];
//print_r($user_balance);
$amazon_pro_name=$_POST['amazon_pro_name'];
$amazon_pro_link=$_POST['amazon_pro_link'];
$amazon_pro_price=$_POST['amazon_pro_price'];
$full_name=$_POST['full_name'];
$shipping_address=$_POST['shipping_address'];
$email_for_order=$_POST['email_for_order'];
$gift_coins_exchange_rate = $user_obj->gift_coins_exchange_rate();
$price = $amazon_pro_price*$gift_coins_exchange_rate;
$sub = 'Amazon Self Select Gift Item';
$message='Product Name: '.$amazon_pro_name.'<br/> Product Price: $'.$amazon_pro_price.'<br/> Product Url: '.$amazon_pro_link.'';
if($User_gift_coins >= $price)
{

?>

<div class="alert alert-success" id="successmessage">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Well done!</strong>	Your order has been submitted
</div>	
<?php 
$sql=mysqli_query($con,"insert into tickets (user_id,sub,message,is_active,created_at) values('$uid','$sub','$message','0',NOW())");
$sql2=mysqli_query($con,"Select ticket_id from tickets order by ticket_id desc limit 1");
$num_rows = mysqli_fetch_row($sql2);
$ticket_id = $num_rows[0];
$sql2=mysqli_query($con,"insert into comments (ticket_id,user_id,sub,comment,created_at,status_by_user) values('$ticket_id','$uid','$sub','$message',NOW(),'1')");
mysqli_query($con,"insert into tbl_amazon_orders(user_id,ticket_id,product_name,product_url,product_price,order_date,full_name,shipping_address,email_for_order) values('".$uid."','".$ticket_id."','".$amazon_pro_name."','".$amazon_pro_link."','".$amazon_pro_price."',NOW(),'$full_name','$shipping_address','$email_for_order')");
mysqli_query($con,"update users set gift_coins=gift_coins-'".$price."' where id='$uid'");
/*Email to admin*/
$site_setting =$user_obj->get_general_setting();
$admin_email = $site_setting['site_email'];
$to = $admin_email;
//$to = 'preetmtharu@gmail.com';
$subject = 'New Order Received - Amazon Self Selected Gift Card';
$msg ='<p>Hi, <br /><br /> A new order has been placed by user on giftscome, to view order details please login to admin panel and visit below link </p><p style="color:#080;font-size:18px;"><a href='.SITE_URL.'/admin/orders.php> '.SITE_URL.'/admin/orders.php </a></p>';
$user_obj->send_email($to,$subject,$msg);
}
else
{?>

<div class="alert alert-danger" id="">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Oops!</strong>	Your Coins Balance is not enough to purchase items
</div>
<?php }

?>
<script>
 $(document).ready(function(){
        setTimeout(function() {
		 $('#successmessage').fadeOut('fast');
        }, 5000);
    });
</script>