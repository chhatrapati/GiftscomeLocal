<?php
session_start();
require_once('includes/config.php');
$member_id=$_SESSION['id'];
//get search term
$searchTerm = $_GET['term'];	

//get matched data from skills table
$query = mysqli_query($con,"SELECT * FROM users WHERE name LIKE '%".$searchTerm."%' and id !='$member_id'  ORDER BY name ASC");
while ($row = mysqli_fetch_array($query)) {
	
	  $data[] = array('value' => $row['name'], 'id' => $row['id']);
   
	
	
}
//return json data
echo json_encode($data);
?>

