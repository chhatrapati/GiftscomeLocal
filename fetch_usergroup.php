<?php
session_start();
require_once('includes/config.php');
if(isset($_POST['search']))
{
	 $search=$_POST['search'];
 $member_id = $_SESSION['id'];
$query = mysqli_query($con,"SELECT * FROM myfriends WHERE myid = '$member_id' OR myfriends = '$member_id'");	
$num_rows = mysqli_num_rows($query);	
			
						while ($row = mysqli_fetch_array($query)) {
							
						 $myfriend = $row['myid'];
					
							$myfriend1 = $row['myfriends'];
								
						
			//echo "SELECT * FROM users WHERE name LIKE '%".$q."%' and (id = '$myfriend1' or id='$myfriend') ORDER BY name ASC";						
		//$query1 = mysqli_query($con,"SELECT * FROM users WHERE name LIKE '%".$term."%' and (id = '$myfriend1' or id='$myfriend') ORDER BY name ASC");
		 $sql="SELECT * FROM users WHERE name LIKE '%".$search."%' and (id = '$myfriend1' or id='$myfriend') and id<>'$member_id' ORDER BY name ASC";						
			   if($result = mysqli_query($con, $sql)){
    
            while($row = mysqli_fetch_array($result)){
				?>
					
					<li style="height:50px;" class="contact" onclick="mydata('<?php echo $row['id']; ?>','<?php echo $row['name']; ?>','<?php echo $row['user_picture']; ?>')" >
								<input type="checkbox" style="float:left;" name="friend" id="usersname" upic="<?php echo $row['user_picture'];?>" uid="<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
					<div class="wrap">
						<span class="contact-status online"></span>
						<?php
						if($row['user_picture'] == ""){ ?>
						<img src="users-images/user.png" alt="" width="50" height="50"  style="float:left;border-radius:50%;border:3px solid skyblue;"/>
				<?php }else {?>
				<img src="users-images/<?php echo $row['user_picture'];?>"  id="upic"  alt="" width="50" height="50" style="float:left;border-radius:50%;border:3px solid skyblue;">
				<?php } ?>
						<div class="meta">
							<p class="name" style="margin-top: 8px;float: left; "><?php echo $row['name']; ?></p>
						</div>
					</div>
				</li>
				<?php
				//echo "<div class='myfriends' style='display:none;'>". $row['name'] ."</div>";
               // echo "<p style='border: 1px solid; width: 24.5%;border-radius: 4px;'><img src='users-images/".$row['user_picture']."' style='width:30px; height:30px;'>" . $row['name'] . "</p>";
            }
       
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }	
						}
}
						?>
						
						
						