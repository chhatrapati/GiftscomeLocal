<?php

           require_once('includes/config.php');
		
					$sender_name='';
					$msg='';
					$sender_id='';
				    $reciver_name='';
					$message_id='';
					$member_id = '';
			
          
     $query2 = "SELECT * FROM reply where receiver_id='$member_id' or receiver_id='$sender_id' and sender_id='$member_id' or sender_id='$sender_id'";
                       $result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
                       while ($row2 = mysqli_fetch_array($result2, MYSQLI_BOTH)) {
					  ?>
					
					
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font"><?php echo $row2['sender_name'];?></strong> <small class="pull-right text-muted">
								
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>
                                <p>
                               <?php echo $row2['msg'];?>
                                </p>
                            </div>
                        </li>
					   <?php } ?>