<?php
//error_reporting(0);
include('include/config.php');

//extract($_POST);
$id=$_POST['id'];
$is_active=$_POST['is_active'];
$table_name=$_POST['table_name'];
$query=mysqli_query($con,"UPDATE $table_name SET  is_active='$is_active' WHERE id='$id'");
//echo $query;
//echo 1;

?>