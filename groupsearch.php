<?php
session_start();
require_once('includes/config.php');
	if (isset($_POST['groupsearch'])){

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
					
				<li style="height:50px;" class="contact" onclick="mydata('<?php echo $friendsa['id']; ?>','<?php echo $friendsa['name']; ?>','<?php echo $friendsa['user_picture']; ?>')" >
				<input type="checkbox" style="float:left;" name="friend" id="usersname" upic="<?php echo $friendsa['user_picture'];?>" uid="<?php echo $friendsa['id']; ?>" value="<?php echo $friendsa['id']; ?>">	
					<div class="wrap">
						<span class="contact-status online"></span>
						<?php
						if($friendsa['user_picture'] == ""){ ?>
						<img src="users-images/user.png" alt="" width="50" height="50" style="float:left;border-radius:50%;border:3px solid skyblue;" />
				<?php }else {?>
				<img src="users-images/<?php echo $friendsa['user_picture'];?>"  id="upic"  alt="" width="50" height="50" style="float:left;border-radius:50%;border:3px solid skyblue;" >
				<?php } ?>
						<div class="meta">
							<p class="name"  style="margin-top: 8px;float: left;"><?php echo $friendsa['name']; ?></p>
						</div>
					</div>
				</li>
				 <?php
                    } else {
                        $friends = mysqli_query($con, "SELECT * FROM users WHERE id = '$myfriend'")or die(mysqli_error($con));
                        $friendsa = mysqli_fetch_array($friends);
						$name=$friendsa['name'];
                        ?>
							<li style="height:50px;"  class="contact" onclick="mydata('<?php echo $friendsa['id']; ?>','<?php echo $friendsa['name']; ?>','<?php echo $friendsa['user_picture']; ?>')">
							<input type="checkbox"  style="float:left;" name="friend" id="usersname" upic="<?php echo $friendsa['user_picture'];?>" aid="<?php echo $friendsa['id']; ?>" value="<?php echo $friendsa['id']; ?>">
					<div class="wrap">
						<span class="contact-status online"></span>
						<?php
						if($friendsa['user_picture'] == ""){ ?>
						<img src="users-images/user.png" alt=""  id="upic" width="50" height="50" style="float:left;border-radius:50%;border:3px solid skyblue;" />
				<?php }else {?>
				<img src="users-images/<?php echo $friendsa['user_picture'];?>" alt="" width="50" height="50" style="float:left;border-radius:50%;border:3px solid skyblue;">
				<?php } ?>
						<div class="meta">
							<p class="name" style="margin-top: 8px;float: left;"><?php echo $friendsa['name']; ?> </p>
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