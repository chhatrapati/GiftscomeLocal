<?php
error_reporting(0);
//print_r($_SESSION);
require_once('includes/config.php');
$sql=mysqli_query($con, "insert into tbl_test(name) values('abcd')");
?>