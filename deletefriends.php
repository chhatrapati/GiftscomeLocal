  <?php
session_start();
require_once('includes/config.php');
//$myfri=array();
    $myfriend=$_POST['uid'];
    $me= $_SESSION["id"];  
	
	
	$uid=array();
	 $ss="SELECT `userid` FROM `chatroom` WHERE create_userid='$me'";
	$result = mysqli_query($con, $ss) or die(mysqli_error($con));
	while($r=mysqli_fetch_array($result))
	{
		 $uid=$r['userid'];
	}	
$ui = split ("\,", $uid); 
foreach (array_keys($ui, $myfriend) as $key) {
    unset($ui[$key]);
}
 $p=implode(",",$ui);

 
$sql2=mysqli_query($con,"delete from frineds where myfriends='$myfriend' and myid='$me'");
  $sql3=mysqli_query($con,"delete from frineds where myfriends='$me' and myid='$myfriend'");
//echo "update chatroom set userid='$p' where create_userid='$me'";	
 $sql=mysqli_query($con,"update chatroom set userid='$p' where create_userid='$me'");
 $sql=mysqli_query($con,"delete from message where sender_id='$me' or receiver_id='$me'");
 $sql1=mysqli_query($con,"delete from privatechatmessage where userid='$me'");
 //echo "delete from frineds where myfriends='$me'";
  
 $query = mysqli_query($con,"delete from myfriends WHERE myid = '" . $_SESSION["id"] . "' AND myfriends = '$myfriend' OR myid = '$myfriend' AND myfriends = '" . $_SESSION["id"] . "' ");
     {		 	echo "friend has been removed";
		}
	
	
  ?>