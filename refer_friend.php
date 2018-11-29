<?php
session_start();
require_once('includes/config.php');
$user_obj = new Cl_User();
$member_id = $_SESSION['id'];
$email=$_SESSION['email'];
$ref_code = $user_obj->get_referal_code($member_id);
if($_POST['is_submit'] == 'yes'){
if ($_POST['c1']) {
foreach ( $_POST['c1'] as $key=>$value ) {
$values = mysqli_real_escape_string($con,$value);
//echo "INSERT INTO referral (sender,sender_email,receiver_email) VALUES ('$member_id','$email','$values')";
$query = mysqli_query($con,"insert into referral (sender,sender_email,receiver_email) values ('$member_id','$email','$values')");
echo "<i><h2><strong>" . count($_POST['c1']) . "</strong> Referal send successfully</h2></i>";
echo '<br/>';
echo "<br>";

//$lastID=mysqli_insert_id($con);
echo "<br>";
	
$to = $values;
//$to = 'preetmtharu@gmail.com';
$subject = 'Sign up and earn coins';
$msg ='<p>Hi, <br /><br /> Thank You! Use below referal link to sign up on giftscome and earn coins </p><p style="color:#080;font-size:18px;"><a href='.SITE_URL.'register.php?ref='.$ref_code.'> '.SITE_URL.'register.php?ref='.$ref_code.' </a></p>';
$user_obj->send_email($to,$subject,$msg);

}
}
}
