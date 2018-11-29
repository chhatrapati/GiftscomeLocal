<?php
session_start();
require_once('includes/config.php');
$member_id=$_SESSION['id'];
//get search term
$searchTerm = $_GET['term'];
$queryFriend = "SELECT * FROM friendrequest where receiver_id =$member_id"; 
              $arrFriends = array();
              $resultFriend = mysqli_query($con, $queryFriend) or die(mysqli_error($con));
              while ($rowFriend = mysqli_fetch_array($resultFriend, MYSQLI_BOTH)) {
                  $arrFriends[]=$rowFriend["sender_id"];
              }
			  
			  $queryFriend1 = "SELECT * FROM myfriends where myid =$member_id"; 
              $arrFriends1 = array();
              $resultFriend1 = mysqli_query($con, $queryFriend1) or die(mysqli_error($con));
              while ($rowFriend1 = mysqli_fetch_array($resultFriend1, MYSQLI_BOTH)) {
                  $arrFriends1[]=$rowFriend1["myfriends"];
              }
              $arrFriends[]=$member_id;
			  $newarray=array_merge($arrFriends,$arrFriends1);
			  //$query = "SELECT * FROM  users where id not in (".implode(",",$newarray).")";	
//get matched data from skills table
$query = mysqli_query($con,"SELECT * FROM users WHERE name LIKE '%".$searchTerm."%' and id not in (".implode(",",$newarray).")  ORDER BY name ASC");
while ($row = mysqli_fetch_array($query)) {
	if($row['user_picture']=='')
	{
		$default_img= "user.png";
		$data[] = array('value' => $row['name'], 'id' => $row['id'],'img'=>$default_img);
	}
	else
	{
	$data[] = array('value' => $row['name'], 'id' => $row['id'],'img'=>$row['user_picture']);
   
	}
}
//return json data
echo json_encode($data);
?>

