<?php
session_start();
include('includes/config.php');
$query567 = "SELECT * FROM tbl_game";
$result567 = mysqli_query($con, $query567) or die(mysqli_error($con));
$rowcount=mysqli_num_rows($result567);
echo $rowcount;
?>