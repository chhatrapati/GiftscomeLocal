<?php
require_once 'includes/config.php';
//code check email
if(!empty($_POST["emailid"])) {
$result = mysqli_query($con,"SELECT count(*) FROM users WHERE email='" . $_POST["emailid"] . "'");
$row = mysqli_fetch_row($result);
$email_count = $row[0];
if($email_count>0) echo "<span style='color:red'></span>";
else echo "<span style='color:green'> Email Are Not Register</span>";
}