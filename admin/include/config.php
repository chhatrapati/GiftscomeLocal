<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "giftscome_live";
$con = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database)
or die("Oops some thing went wrong");
/*Base url of site*/
define('SITE_URL', 'http://giftscome.com.cp-28.hostgatorwebservers.com');
?>