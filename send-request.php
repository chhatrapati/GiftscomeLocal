<?php
session_start();
require_once('includes/config.php');
if($_POST) {
         $rid=$_POST['rid'];
	     $rname=$_POST['rname'];
	     $sid=$_POST['sid'];
	     $sname=$_POST['sname'];
		 $spic=$_POST['spic'];
	     $rpic=$_POST['rpic'];
	$query = "SELECT * from friendrequest where sender_id ='$sid' and receiver_id='$rid'";
 if ($result=mysqli_query($con,$query))
  {
   if(mysqli_num_rows($result) > 0)
    {
echo "Already Sent";
    }
	else
	{
$sql = mysqli_query($con, "INSERT INTO friendrequest(sender_id,sender_name,sender_pic,receiver_id,receiver_name,receiver_pic) VALUES ('$sid','$sname','$spic','$rid','$rname','$rpic')");
	
	if ($sql == true) {
            echo "request sent";
        } else {
            	echo "request send failed";
        }
}
  }
}



/*if ($_POST) {
	
	echo $reciver=$_POST['reciver'];
	echo $member_id=$_SESSION['user']['id'];
$sql = mysqli_query($conn, "INSERT INTO friendrequest(sender,receiver) VALUES ('$member_id','$reciver')");
        if ($sql == true) {
            echo "<script type=\"text/javascript\">
							alert(\"friend request sent\");
							window.location='view_friends.php';
						</script>";
        } else {
            echo "<script type=\"text/javascript\">
							alert(\"friend request sent failed\");
						
						</script>";
        }
    }*/

?>





