<?php
session_start();
require_once('includes/config.php');
if($_POST)
{
 $q=$_POST['searchword'];
 $member_id = $_SESSION['id'];

//get matched data from skills table
//echo "SELECT * FROM users WHERE name LIKE '%".$q."%' and (id !=$member_id) ORDER BY name ASC";
$query = mysqli_query($con,"SELECT * FROM users WHERE name LIKE '%".$q."%' and (id !=$member_id) ORDER BY name ASC");	
$num_rows = mysqli_num_rows($query);	
			
						while ($row = mysqli_fetch_array($query)) {
							
							
							$username=$row['name'];
			               $user_picture=$row['user_picture'];
				
								
?>

<div class="display_box" align="left">
<?php
if($row['user_picture'] == ""){ ?>

<img src="users-images/user.png" width="50px" height="50px">
										<?php }else {?>								

<img src="users-images/<?php echo $user_picture; ?>" style="width:50px; height:50px; float:left; margin-right:6px;" />
<?php }?>
<span class="name"><?php echo $username; ?></span>

<?php
}
}
?>







