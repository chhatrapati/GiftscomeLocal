<?php
error_reporting(0);
require_once('includes/config.php');
$user_obj = new Cl_User();
//$myNumber = 100000;
//echo number_format( $myNumber);
// client-ip.php : Demo script by nixCraft <www.cyberciti.biz>
// get an IP address
//$ip = $_SERVER['REMOTE_ADDR'];
// display it back
//echo "<h2>Client IP Demo</h2>";
//echo "Your IP address : " . $ip;
//echo "<br>Your hostname : ". gethostbyaddr($ip) ;
$data = $user_obj->get_client_ip_env();
echo $data;
?>