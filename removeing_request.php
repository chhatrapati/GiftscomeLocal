<?php 
session_start();
require_once('includes/config.php');

       $myfriend=$_POST['uid'];
       $me= $_SESSION['id'];
       $query = mysqli_query($con,"delete from friendrequest WHERE receiver_id = '" . $_SESSION["id"] . "' AND sender_id = '" . $_POST['uid'] . "' OR receiver_id = '" . $_POST['uid'] . "' AND sender_id = '" . $_SESSION["id"] . "' ");

	 {
	echo "Request Removed complete";
		
	}

  ?>