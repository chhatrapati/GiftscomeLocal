<?php
session_start();
require_once('includes/config.php');
if($_POST)
{
 $q=$_POST['searchword'];
 $member_id = $_SESSION['id'];


//echo "SELECT * FROM myfriends WHERE myid = '$member_id' OR myfriends = '$member_id'";
//get matched data from skills table
$query = mysqli_query($con,"SELECT * FROM myfriends WHERE myid = '$member_id' OR myfriends = '$member_id'");	
$num_rows = mysqli_num_rows($query);	
			
						while ($row = mysqli_fetch_array($query)) {
							
						 $myfriend = $row['myid'];
					
							$myfriend1 = $row['myfriends'];
								
						
			//echo "SELECT * FROM users WHERE name LIKE '%".$q."%' and (id = '$myfriend1' or id='$myfriend') ORDER BY name ASC";						
		$query1 = mysqli_query($con,"SELECT * FROM users WHERE name LIKE '%".$q."%' and (id = '$myfriend1' or id='$myfriend') ORDER BY name ASC");
										
										
         while ($row1 =mysqli_fetch_array($query1)) {
			
			$username=$row1['name'];
			$user_picture=$row1['user_picture'];
		
?>

<div class="display_box" align="left">
<img src="users-images/<?php echo $user_picture; ?>" style="width:50px; height:50px; float:left; margin-right:6px;" /><span class="name"><?php echo $username; ?></span>

<?php
}
}
}
?>







