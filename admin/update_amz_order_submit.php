<?php
include_once 'include/config.php';
require_once('User.php');
$userinfo_obj = new User_Info();
//define('SITE_URL', 'http://giftscome.com.cp-28.hostgatorwebservers.com');
$oid=$_POST['idorder'];
$status=$_POST['status'];
$remark=$_POST['remark'];
/*Fetch useremail*/
$query_12=mysqli_query($con,"select email_for_order from tbl_amazon_orders where id ='$oid'");
$row=mysqli_fetch_array($query_12);
$useremail = $row['email_for_order'];
$query_23=mysqli_query($con,"select * from tbl_amazon_orders_track_history where amz_order_id ='$oid'");
$total_rows = mysqli_num_rows($query_23);
if($total_rows>0)
{
$query=mysqli_query($con,"update tbl_amazon_orders_track_history set amz_order_status='$status',amz_order_remark='$remark' where amz_order_id='$oid'");
}
else
{
$query=mysqli_query($con,"insert into tbl_amazon_orders_track_history(amz_order_id,amz_order_status,amz_order_remark) values('$oid','$status','$remark')");
}
$sql=mysqli_query($con,"update tbl_amazon_orders set order_status='$status' where id='$oid'");
/*Mail to user*/
$to = $useremail;
$subject = 'Amazon self selected order status changed';
$msg ='<p>Hi, <br /><br /> Status of your order no #'.$oid.' has been changed by admin. Visit below link to track status of order.</p><p style="color:#080;font-size:18px;"><a href='.SITE_URL.'/order-history.php> '.SITE_URL.'/order-history.php </a></p>';
$userinfo_obj->send_email($to,$subject,$msg);

?>