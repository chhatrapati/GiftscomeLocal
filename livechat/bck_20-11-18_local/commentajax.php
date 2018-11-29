<?php
include('../includes/config.php');
if(isset($_POST['user_comm']) && isset($_POST['user_name']))
{
  $comment=$_POST['user_comm'];
  $name=$_POST['user_name'];
  $game_id=$_POST['game_id'];
  $insert=mysqli_query($con,"insert into live_comments (name,comment,post_time,game_id) values('$name','$comment',CURRENT_TIMESTAMP,'$game_id')");
}

?>