<?php
require_once('includes/config.php');

$checked=$_POST['checkbox'];

$query = mysqli_query($con,"delete from  support WHERE support_id = '$checked'");
$query1 = mysqli_query($con,"delete from  support_reply WHERE support_reply_id = '$checked'");
    
     
	 {
		echo "<script type=\"text/javascript\">
							alert(\"Message deleted\");
							window.location='help_support_inbox.php';
						</script>";
			
		
	}
	


?>