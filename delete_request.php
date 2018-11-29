<?php 
session_start();
require_once('includes/config.php');

       $myfriend=$_POST['rid'];
       $me= $_SESSION['id'];
       $query = mysqli_query($con,"delete from friendrequest WHERE receiver_id = '" . $_SESSION["id"] . "' AND sender_id = '" . $_POST['rid'] . "' OR receiver_id = '" . $_POST['rid'] . "' AND sender_id = '" . $_SESSION["id"] . "' ");
    
     
	 {
	echo "Request Removed complete";
		
	}
	
	
  ?>