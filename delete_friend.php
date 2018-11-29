  <?php
session_start();
require_once('includes/config.php');
    $myfriend=$_POST['rid'];
    $me= $_SESSION["id"];
    $query = mysqli_query($con,"delete from myfriends WHERE myid = '" . $_SESSION["id"] . "' AND myfriends = '$myfriend' OR myid = '$myfriend' AND myfriends = '" . $_SESSION["id"] . "' ");
     {		 	
      echo "friend has been removed successfully";
		 }
  ?>