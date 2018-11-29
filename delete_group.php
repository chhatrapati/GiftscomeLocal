<?php 
session_start();
require_once('includes/config.php');
$chatid=$_POST['chatroomno'];
$member_id = $_SESSION['id'];
//echo "SELECT `chatroomno`,create_userid FROM `chatroom` WHERE `create_userid`='$member_id' and `chatroomno`='$chatid'";
$sql=mysqli_query($con,"SELECT `chatroomno`,create_userid FROM `chatroom` WHERE `create_userid`='$member_id' and `chatroomno`='$chatid'");

$row=mysqli_fetch_assoc($sql);


	if($row['create_userid']==$member_id)
	{
		
echo "<button type='button' style='display:none;' onclick='editchatroom()' class='btn btn-warning' style='margin:8px 71px'><span class='ks-text' data-toggle='modal' data-target='#editchatroom'>edit chat room</span></button>";
echo'<input type="submit" style="display:none;" value="delete" style="background-color: #f44336;" onclick="delete_group('.$row['chatroomno'].')">';

	}
	else	
	{
	echo '<input type="submit" style="display:none;" value="leave" onclick="leave_group('.$chatid.')">';
	}
	

?>

