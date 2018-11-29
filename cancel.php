<?php
session_start();
$username=$_SESSION['username'];
echo "<h1>Welcome, $username</h1>";
echo "<h1>Payment Canceled</h1>";
?>
 <script type="text/javascript">
	setTimeout(function () {
	var basepath = window.location.protocol + '//' + window.location.hostname;
	var path = basepath;
	window.location.href= path; // the redirect goes here
	},1000); // 5 seconds
</script>