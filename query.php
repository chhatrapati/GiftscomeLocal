<?php
error_reporting(0);
require_once('includes/config.php');
$uid= $_SESSION['id'];
// $ss=  mysqli_query($con,"SELECT COUNT(1), loginTime FROM userlog  WHERE loginTime >= DATE_SUB(NOW(), INTERVAL 12 HOUR) AND user_id='104'");
// $ss=  mysqli_query($con,"SELECT logindate FROM userlog  WHERE user_id='104' order by loginTime desc limit 1");
		// $result_data = mysqli_fetch_assoc($ss);
		// //$no_of_login = $result_data['COUNT(1)'];
		// //$loginTime = $result_data['loginTime'];
		// $logindate = $result_data['logindate'];
		// echo '<pre>';print_r($result_data); 
		// //echo $no_of_login; if($no_of_login > 1) {echo 'greater';} else { echo 'no';}
		// //echo $date = strtotime($loginTime);
		// echo $cur_date= date("Y-m-d");
		// if($cur_date>$logindate){echo 'greater';} else {echo 'less';}
		
$sss=mysqli_query($con,"SELECT  distinct user_id  FROM package_sales WHERE expire_date >= CURRENT_DATE");
while($res=mysqli_fetch_array($sss)) {
$user_id = $res['user_id'];
echo $user_id;
}
// $row = $res['TotalVIPPackage'];
// if($TotalVIPPackage ==0 )
// {
	// $query98=mysqli_query($con, "update users set user_type='normal' where id=".$uid."");	
// }
?>