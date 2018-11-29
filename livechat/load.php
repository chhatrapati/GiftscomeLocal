<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "giftscome_live";
$con = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database)
or die("Oops some thing went wrong!!!");
$game_id=$_POST['game_id'];
$query = "select name,comment,post_time from live_comments where game_id='".$game_id."'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$numrows = mysqli_num_rows($result);
if($numrows > 0)
{
while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
	$name=$row['name'];
	$comment=$row['comment'];
    $time=$row['post_time'];
?>
<div class="chats"><strong><?=$name?>:</strong> <?=$comment?> </div>
<?php
}
} else { echo 'Send message to start conversation';}
?>