<?php
session_start();
include('includes/config.php');
$timezone_offset_minutes=$_SESSION['tz'];
//$timezone_offset_minutes = 330;  // $_GET['timezone_offset_minutes']
$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);
date_default_timezone_set($timezone_name);
$currentTime = date( 'Y-m-d H:i:s', time () );
echo $currentTime;
?>