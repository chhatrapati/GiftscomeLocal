<?php
session_start();
include('includes/config.php');
echo $timezone_offset_minutes=$_POST['timezone_offset_minutes'];
$_SESSION['tz'] = $timezone_offset_minutes;
?>