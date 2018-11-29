<?php
session_start();
require_once('includes/config.php');

$term = mysqli_real_escape_string($con, $_REQUEST['term']);

 $member_id = $_SESSION['id'];
$query = mysqli_query($con,"SELECT * FROM myfriends WHERE myid = '$member_id' OR myfriends = '$member_id'");	
$num_rows = mysqli_num_rows($query);	
			
						while ($row = mysqli_fetch_array($query)) {
							
						 $myfriend = $row['myid'];
					
							$myfriend1 = $row['myfriends'];
								
						
			//echo "SELECT * FROM users WHERE name LIKE '%".$q."%' and (id = '$myfriend1' or id='$myfriend') ORDER BY name ASC";						
		//$query1 = mysqli_query($con,"SELECT * FROM users WHERE name LIKE '%".$term."%' and (id = '$myfriend1' or id='$myfriend') ORDER BY name ASC");
		 $sql="SELECT * FROM users WHERE name LIKE '%".$term."%' and (id = '$myfriend1' or id='$myfriend') and id<>'$member_id' ORDER BY name ASC";						
			   if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
				echo "<div class='myfriends' style='display:none;'>". $row['name'] ."</div>";
                echo "<p style='border: 1px solid; width: 24.5%;border-radius: 4px;'><img src='users-images/".$row['user_picture']."' style='width:30px; height:30px;'>" . $row['name'] . "</p>";
            }
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }							

}
?>







