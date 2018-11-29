  
 
  <div class="ks-header">
                    User Info
                </div>
				 

                <div class="ks-body">
				  <?php
  require_once('includes/config.php');
  $user_id=$_POST['user_id'];
  $query = "SELECT * FROM users where id ='$user_id'";
  $result = mysqli_query($con, $query);
  while($row=mysqli_fetch_array($result)){
  
  ?>
                    <div class="ks-item ks-user">
                        <span class="ks-avatar ks-online">
                            <img src="users-images/<?php echo $row['user_picture'];?>" width="36" height="36" class="rounded-circle">
                        </span>
                        <span class="ks-name">
                           <?php echo $row['name']; ?>
                        </span>
                    </div>

                   <!-- <div class="ks-item">
                        <div class="ks-name">Username</div>
                        <div class="ks-text">
                            @lauren.sandoval
                        </div>
                    </div>
                    <div class="ks-item">
                        <div class="ks-name">Email</div>
                        <div class="ks-text">
                            lauren.sandoval@example.com
                        </div>
                    </div>
                    <div class="ks-item">
                        <div class="ks-name">Phone Number</div>
                        <div class="ks-text">
                            +1(555) 555-555
                        </div>
                    </div>
                </div>
                <div class="ks-footer">
                    <div class="ks-item">
                        <div class="ks-name">Created</div>
                        <div class="ks-text">
                            Febriary 17, 2016 at 11:38 PM
                        </div>
                    </div>
                    <div class="ks-item">
                        <div class="ks-name">Last Activity</div>
                        <div class="ks-text">
                            1 minute ago
                        </div>
                    </div>-->
                </div>
  <?php } ?>