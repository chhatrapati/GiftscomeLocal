 <?php
 session_start();
require_once('includes/config.php');
$chatid=$_POST['chatroomno'];
$uid =$_POST['uid']; 
//echo "SELECT `userid` FROM `chatroom` WHERE chatroomno='$chatid'";
 $ss="SELECT `userid` FROM `chatroom` WHERE chatroomno='$chatid'";
	$result = mysqli_query($con, $ss) or die(mysqli_error($con));
	while($r=mysqli_fetch_array($result))
	{
		 $userid=$r['userid'];
	}	
	
	$ui = split ("\,", $userid); 
	foreach (array_keys($ui, $uid) as $key) {
    unset($ui[$key]);
}
    $p=implode(",",$ui);
	//echo "update chatroom set `userid`='$p' WHERE `chatroomno`='$chatid'"
    $sql1=mysqli_query($con,"update chatroom set `userid`='$p' WHERE `chatroomno`='$chatid'");
    echo "leave room";
   
	?>