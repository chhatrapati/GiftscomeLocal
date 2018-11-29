<?php
require_once('includes/config.php');
echo $name=$_POST['name'];
echo $msg=$_POST['msg'];
$sql=mysqli_query($con,"INSERT INTO chat(name,chatmsg) values('$name','$msg')");
 if($sql){
echo "Your message have been successfully .";
}
?>