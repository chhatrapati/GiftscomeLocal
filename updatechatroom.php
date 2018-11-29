    <?php
 //session_start();
require_once('includes/config.php');
$chatroomno=$_POST['chatroomno'];
$uid=$_POST['uid'];
$updatechat=$_POST['updatechat'];
$chatroomname=$_POST['chatroomname'];

$ss=mysqli_query($con,"update `chatroom` set chat_name='$chatroomname',userid='$updatechat' WHERE chatroomno='$chatroomno' and create_userid='$uid'");
echo "chat room updated";
?>