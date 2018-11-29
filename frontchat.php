      <?php 
require_once('includes/config.php');
					$query = "SELECT * FROM  chat";
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                       while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
					?>
                  
					
							<li>
							<?php if($row['id']%2!=0){?>
						<div class="left-chat">
							<img src="images/man01.png" title="<?php echo $row['name'];?>">
							<p> <?php echo $row['chatmsg'];?>
							</p>
							
						</div>
							<?php } else { ?>
					</li>
					<li>
						<div class="right-chat">
							<img src="images/man02.png" title="<?php echo $row['name'];?>">
							<p><?php echo $row['chatmsg'];?></p>
							
						</div>
					</li>
					   <?php } } ?>
 