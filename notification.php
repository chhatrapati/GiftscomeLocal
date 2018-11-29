<?php
//fetch.php;
session_start();
$member_id = $_SESSION['id'];
if(isset($_POST["view"])){
	
require_once('includes/config.php');
	if($_POST["view"] != ''){
		mysqli_query($con,"update `message` set seen_status='1' where seen_status='0'");
		mysqli_query($con,"update `friendrequest` set seen_status='1' where seen_status='0'");
		mysqli_query($con,"update `privatechatmessage` set seen_status='1' where seen_status='0'");
	}
	
	// $query=mysqli_query($con,"select * from `notification` order by userid desc limit 10");
	 $output = '';
 
	// if(mysqli_num_rows($query) > 0){
	// while($row = mysqli_fetch_array($query)){
	// $output .= '
	// <li>
		// <a href="#">
		// Firstname: <strong>'.$row['firstname'].'</strong><br />
		// Lastname: <strong>'.$row['lastname'].'</strong>
		// </a>
	// </li>
	
	// ';
	// }
	// }
	// else{
	// $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
	// }
	
	
	$query1=mysqli_query($con,"select msg from `message` where seen_status='0' and receiver_id='$member_id'");
	 $count1 = mysqli_num_rows($query1);
	 
	 
	 $query2=mysqli_query($con,"select * from `friendrequest` where seen_status='0' and receiver_id='$member_id'");
	 $count2 = mysqli_num_rows($query2);
	 
	 $query3=mysqli_query($con,"select message from `privatechatmessage` where seen_status='0' and userid='$member_id'");
	 $count3 = mysqli_num_rows($query3);
	 
	 $count=$count1+$count2+$count3;
	 
	// $query1=mysqli_query($con,"select * from `notification` where seen_status='0'");
	// $count = mysqli_num_rows($query1);
	$data = array(
		'notification'   => $output,
		'unseen_notification' => $count
	);
	echo json_encode($data);
}
?>