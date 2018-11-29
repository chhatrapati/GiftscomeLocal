<?php 
session_start();
require_once('includes/config.php');

			
       $myfriend=$_POST['aid'];
		
		$member_id = $_SESSION['id'];
		$mfriends=mysqli_query($con,"INSERT INTO myfriends(myid,myfriends) VALUES('$member_id','$myfriend') ")or die(mysql_error($con));
		
     
	   $query = mysqli_query($con,"delete from friendrequest WHERE receiver_id = '$member_id' AND sender_id = '$myfriend' OR receiver_id = '$myfriend' AND sender_id = '$member_id'");
     
	  {
		
	echo "Request Accepted";
			
		
      }
	
	
  ?>