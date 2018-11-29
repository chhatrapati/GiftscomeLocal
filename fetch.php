<?php
session_start();
require_once('includes/config.php');

	 $search=$_POST['search'];

	   $member_id = $_SESSION['id'];
                  
               $a = array();
			   $b = array();
			  $post = mysqli_query($con,"SELECT * FROM myfriends WHERE myid = '$member_id' OR myfriends = '$member_id'")or die(mysqli_error($con));
			 // print_r($post);
			 $d=mysqli_num_rows($post);
			 
			 //echo $d;
			  while($s=mysqli_fetch_array($post))
			  {
				   $a[]=$s['myid'];
				   $b[]=$s['myfriends'];
				  
			   }
			         if($d >0)
					 {
						 
						 
                        $userid = $_SESSION['id'];
                        $queryFriend = "SELECT * FROM friendrequest where receiver_id =$member_id"; 
                        $arrFriends = array();
						 
                        $resultFriend = mysqli_query($con, $queryFriend) or die(mysqli_error($con));
                        while ($rowFriend = mysqli_fetch_array($resultFriend, MYSQLI_BOTH)) {
                            $arrFriends[]=$rowFriend["sender_id"];
                        }
                        $arrFriends[]=$member_id;
						$c=array_merge($a,$b,$arrFriends);
						//id IN (".implode(',', $bookIDs).")";
						// $query = "SELECT * FROM  users where id not in (".implode(",",$arrFriends).")";
                     // $query = "SELECT * FROM  users where  name LIKE '%".$search."%' and id not in (".implode(",",$c).")";
					  $query = "SELECT * FROM  users where  name LIKE '%".$search."%' and id not in(".implode(',', $c).")";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
					 }
					 else
					 {
						 $query = "SELECT * FROM  users where  name LIKE '%".$search."%'"; 
						 $result = mysqli_query($con, $query) or die(mysqli_error($con));
					 }
					
				
					 
					 if(mysqli_num_rows($result) > 0) 
					 {
				       ?>
					   <!--<p>More friend</p>-->
					   <?php
                        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                            ?>
	
	 <li class="contact" id="srequest" onclick="send_request('<?php echo $row['id']; ?>','<?php echo $row['name']; ?>','<?php echo $row['user_picture'];?>')" id="chat_username<?php echo $row['id']; ?>">
					<div class="wrap">
						<span class="contact-status online" style="display:none;"></span>
						<?php
						if($row['user_picture'] == ""){ ?>
						<img src="users-images/user.png" alt="" />
				<?php }else {?>
				<img src="users-images/<?php echo $row['user_picture'];?>" alt="">
				<?php } ?>
						<div class="meta">
							<p class="name"><?php echo $row['name']; ?></p>
						</div>
					</div>
				</li> 
				<?php
}
}
else
{
	//echo "not found";
	
	
	
 $member_id = $_SESSION['id'];
$query = mysqli_query($con,"SELECT * FROM myfriends WHERE myid = '$member_id' OR myfriends = '$member_id'");	
$num_rows = mysqli_num_rows($query);	
			?>
			<!--<p>My Friends</p>-->
			<?php
						while ($row = mysqli_fetch_array($query)) {
							
						 $myfriend = $row['myid'];
					
							$myfriend1 = $row['myfriends'];
								
						
			//echo "SELECT * FROM users WHERE name LIKE '%".$q."%' and (id = '$myfriend1' or id='$myfriend') ORDER BY name ASC";						
		//$query1 = mysqli_query($con,"SELECT * FROM users WHERE name LIKE '%".$term."%' and (id = '$myfriend1' or id='$myfriend') ORDER BY name ASC");
		 $sql="SELECT * FROM users WHERE name LIKE '%".$search."%' and (id = '$myfriend1' or id='$myfriend') and id<>'$member_id' ORDER BY name ASC";						
			   if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
				?>
				
					<li class="contact" onclick="mydata('<?php echo $row['id']; ?>','<?php echo $row['name']; ?>','<?php echo $row['user_picture']; ?>')" id="chat_username<?php echo $row['id']; ?>">
					<div class="wrap">
						<span class="contact-status online" style="display:none;"></span>
						<?php
						if($row['user_picture'] == ""){ ?>
						<img src="users-images/user.png" alt="" />
				<?php }else {?>
				<img src="users-images/<?php echo $row['user_picture'];?>" alt="">
				<?php } ?>
						<div class="meta">
							<p class="name"><?php echo $row['name']; ?></p>
						</div>
					</div>
				</li>
				<?php
				//echo "<div class='myfriends' style='display:none;'>". $row['name'] ."</div>";
               // echo "<p style='border: 1px solid; width: 24.5%;border-radius: 4px;'><img src='users-images/".$row['user_picture']."' style='width:30px; height:30px;'>" . $row['name'] . "</p>";
            }
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }	
	
	
	
						}
}
	?>