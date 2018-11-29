<?php
session_start();
require_once('includes/config.php');
//get search term
$searchTerm = $_GET['term'];
 $member_id = $_SESSION['id'];
//get matched data from skills table
$query = mysqli_query($con,"SELECT * FROM myfriends WHERE myid = '$member_id' OR myfriends = '$member_id'");	
       $num_rows = mysqli_num_rows($query);	
			
						while ($row = mysqli_fetch_array($query)) {
							
							$myfriend = $row['myid'];
							if($myfriend == $member_id){
							 $myfriend1 = $row['myfriends'];
								
								
						
			//echo "SELECT * FROM users WHERE name LIKE '%".$searchTerm."%' and id = '$myfriend1' ORDER BY name ASC";						
		$query1 = mysqli_query($con,"SELECT * FROM users WHERE name LIKE '%".$searchTerm."%' and id = '$myfriend1' ORDER BY name ASC");
										
										
         while ($row1 =mysqli_fetch_array($query1)) {
   $data[] = $row1['name'];
     }
							}
						}
				 
//return json data
echo json_encode($data);
?>
