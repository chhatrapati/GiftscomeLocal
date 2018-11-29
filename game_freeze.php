<?php
session_start();
include('includes/config.php');
date_default_timezone_set('UTC');// change according timezone
$currentTime = date( 'Y/m/d H:i:s', time () );
echo $currentTime;
?>