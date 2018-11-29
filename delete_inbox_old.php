<?php
require_once('includes/config.php');

$checked=$_POST['checkbox'];

$query = mysqli_query($con,"delete from message WHERE message_id = '$checked'");
$query1 = mysqli_query($con,"delete from reply WHERE reply_id = '$checked'");
    
     
	 {
		echo "<script type=\"text/javascript\">
							alert(\"Message deleted\");
							window.location='inbox.php';
						</script>";
			
		
	}
	


?>