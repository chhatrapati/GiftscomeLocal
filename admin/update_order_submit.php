<?php
include_once 'include/config.php';
require_once('User.php');
$userinfo_obj = new User_Info();
//define('SITE_URL', 'http://giftscome.com.cp-28.hostgatorwebservers.com');
$oid=$_POST['idorder'];
$status=$_POST['status'];
$remark=$_POST['remark'];//space char

/*Fetch useremail*/
$query_12=mysqli_query($con,"select userId from orders where id ='$oid'");
$row=mysqli_fetch_array($query_12);
$userId = $row['userId'];
$query_212=mysqli_query($con,"select email from users where id ='$userId'");
$row12=mysqli_fetch_array($query_212);
$useremail = $row12['email'];
$query_23=mysqli_query($con,"select * from ordertrackhistory where orderId ='$oid'");
$total_rows = mysqli_num_rows($query_23);
if($total_rows>0)
{
$query=mysqli_query($con,"update ordertrackhistory set status='$status',remark='$remark' where orderId='$oid'");
}
else
{
$query=mysqli_query($con,"insert into ordertrackhistory(orderId,status,remark) values('$oid','$status','$remark')");
}
$sql=mysqli_query($con,"update orders set orderStatus='$status' where id='$oid'");
/*Mail to user*/
$to = $useremail;
$subject = 'Order status changed';
$msg ='<p>Hi, <br /><br /> Status of your order no #'.$oid.' has been changed by admin. Visit below link to track status of order.</p><p style="color:#080;font-size:18px;"><a href='.SITE_URL.'/order-history.php> '.SITE_URL.'/order-history.php </a></p>';
$userinfo_obj->send_email($to,$subject,$msg);
?>