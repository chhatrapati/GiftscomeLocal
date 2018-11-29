<?php
require_once('includes/config.php');
?>
<?php
if(isset($_POST)){
$reciver_id=$_POST['userid'];
$sender_id=$_POST['sender_id'];
$data=mysqli_query($con,"SELECT * FROM message where (sender_id = '$sender_id' AND receiver_id = '$reciver_id') OR (sender_id = '$reciver_id' AND receiver_id = '$sender_id')");      
while($row = mysqli_fetch_array($data))
{
if($row['sender_id']==$sender_id){?>
<li class="sent">
<?php
    if($row['sender_img']=='')
    {
        ?>
     <img src="users-images/user.png" alt="" />   
     <?php
    }
    else
    {
        ?>
<img src="users-images/<?php echo $row['sender_img'];?>" alt="" />
<?php
    }
    ?>
<p><?php echo $row['msg'];?></p>
</li>
<?php }else {?>
<li class="replies">
<?php
    if($row['sender_img']=='')
    {
        ?>
     <img src="users-images/user.png" alt="" />   
     <?php
    }
    else
    {
        ?>
<img src="users-images/<?php echo $row['sender_img'];?>" alt="" />
<?php
    }
    ?>				
<p><?php echo $row['msg'];?></p>
</li>
<?php }}}?>
		