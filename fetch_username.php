<?php
session_start();
require_once('includes/config.php');

if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($con, $_POST["query"]);

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
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
				?>
					<li class="contact" onclick="mydata('<?php echo $row['id']; ?>','<?php echo $row['name']; ?>','<?php echo $row['user_picture']; ?>')" id="chat_username<?php echo $row['id']; ?>">
					<div class="wrap">
						<span class="contact-status online"></span>
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
else
{
            if (isset($_SESSION['id'])) {
                 $member_id = $_SESSION['id'];
            }  
			
			 $sender_name=$_SESSION['username'];
			 
			 $query=mysqli_query($con, "SELECT name, user_picture FROM users WHERE id = '$member_id'");
			 $res = mysqli_fetch_assoc($query);
			   $user_name=$res['name'];
			  $user_picture=$res['user_picture'];
			  echo "<input type='hidden' id='sender_image' value='".$user_picture."'>";
            $post = mysqli_query($con, "SELECT * FROM myfriends WHERE myid = '$member_id' OR myfriends = '$member_id' ")or die(mysqli_error($con));

            $num_rows = mysqli_num_rows($post);

            if ($num_rows != 0) {

                while ($row = mysqli_fetch_array($post)) {

                    $myfriend = $row['myid'];

                    //$member_id=$_SESSION["logged"];

                    if ($myfriend == $member_id) {

                        $myfriend1 = $row['myfriends'];
                        $friends = mysqli_query($con, "SELECT * FROM users WHERE id = '$myfriend1'")or die(mysqli_error($con));
                        $friendsa = mysqli_fetch_array($friends);
                        
						$name=$friendsa['name'];
						?>
				<li class="contact" onclick="mydata('<?php echo $friendsa['id']; ?>','<?php echo $friendsa['name']; ?>','<?php echo $friendsa['user_picture']; ?>')" id="chat_username<?php echo $friendsa['id']; ?>">
					<div class="wrap">
						<span class="contact-status online"></span>
						<?php
						if($friendsa['user_picture'] == ""){ ?>
						<img src="users-images/user.png" alt="" />
				<?php }else {?>
				<img src="users-images/<?php echo $friendsa['user_picture'];?>" alt="">
				<?php } ?>
						<div class="meta">
							<p class="name"><?php echo $friendsa['name']; ?></p>
						</div>
					</div>
				</li>
				 <?php
                    } else {
                        $friends = mysqli_query($con, "SELECT * FROM users WHERE id = '$myfriend'")or die(mysqli_error($con));
                        $friendsa = mysqli_fetch_array($friends);
						$name=$friendsa['name'];
                        ?>
						<li class="contact" onclick="mydata('<?php echo $friendsa['id']; ?>','<?php echo $friendsa['name']; ?>','<?php echo $friendsa['user_picture']; ?>')">
					<div class="wrap" >
						<span class="contact-status online"></span>
						<?php
						if($friendsa['user_picture'] == ""){ ?>
						<img src="users-images/user.png" alt="" />
				<?php }else {?>
				<img src="users-images/<?php echo $friendsa['user_picture'];?>" alt="">
				<?php } ?>
						<div class="meta">
							<p class="name"><?php echo $friendsa['name']; ?> </p>
							<p class="preview">You just got LITT up, Mike.</p>
						</div>
					</div>
				</li>
				<?php
                    }
                }
            } else {



                echo 'You do not have friends ';
            }
          
}
?>