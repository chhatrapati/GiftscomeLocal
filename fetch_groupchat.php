<?php 
session_start();
require_once('includes/config.php');
$chatid=$_POST['chatroomno'];
$member_id=$_SESSION['id'];
//$msg=$_POST['msg'];
$query=mysqli_query($con,"select * from `privatechatmessage` left join `users` on users.id=privatechatmessage.userid where chatroomid='$chatid' order by chat_date asc") or die(mysqli_error($con));
while($row=mysqli_fetch_array($query)){
if($row['id']==$member_id){?>
<li class="sent">
<?php
if($row['user_picture']=='')
{
	?>
	<img src="users-images/user.png" alt="" />
<?php } else { ?>
	<img src="users-images/<?php echo $row['user_picture'];?>" alt="" />
<?php } ?>
	
	<p><?php echo $row['message'];?></p>
</li>
<?php }else {?>
<li class="replies">
<?php
	if($row['user_picture']=='')
{
	?>
	<img src="users-images/user.png" alt="" />
<?php } else { ?>
	<img src="users-images/<?php echo $row['user_picture'];?>" alt="" />
<?php } ?>					
	<p><?php echo $row['message'];?></p>
</li>
<?php }}?>