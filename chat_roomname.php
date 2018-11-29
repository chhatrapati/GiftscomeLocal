<?php
session_start();
require_once('includes/config.php');
?>
    <?php $chatid=$_POST['chatid'];?>
  <div class="ks-name">Chat name <?php echo $chatroomname=$_POST['chatroomname'];?></div>
  
  <div class="ks-amount">

			   <?php
					$num=mysqli_query($con,"select * from chat_member where chatroomid='$chatid'");
					?>
					
					members : <?php echo mysqli_num_rows($num);?><br>
					
					member list:
						  <?php
	$rm=mysqli_query($con,"select * from chat_member left join `users` on users.id=chat_member.userid where chatroomid='$chatid' limit 4");
				$nam ='';
					while($rmrow=mysqli_fetch_array($rm)){
			   
				$creq=mysqli_query($con,"select * from chatroom where chatroomid='$chatid'");
						$crerow=mysqli_fetch_array($creq);
								
							if ($crerow['userid']==$rmrow['userid']){
						}
	
	
	                   // $name= $rmrow['name'].",";
						$nam= $nam.$rmrow['name'].',';
						//echo rtrim($name,',');
						//echo $name;
						
					            }
								//echo $nam;
								echo substr($nam, 0, -1);
                            echo "(...)";								
								?>
</div>


