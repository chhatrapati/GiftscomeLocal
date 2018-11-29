<?php
   session_start();
   require_once('includes/config.php');
   
   if(isset($_POST['send']))
   {  
   
      $member_id = $_SESSION['id'];
      $login_userpic= $_SESSION['login_userpic'];
      $sender_name = $_POST['sname'];
      $reciver_id     = $_POST['to'];
      $reciver_name  = $_POST['unames'];
      $reciver_img  = $_POST['upics'];
      $msg    =  $_POST['msg'];

      
      mysqli_query($con,"INSERT INTO message(sender_id,sender_name,sender_img,receiver_id,receiver_name,receiver_img,msg) values('$member_id','$sender_name','$login_userpic','$reciver_id','$reciver_name','$reciver_img','$msg')"); 
      $last_id = mysqli_insert_id($con);
      
    echo "<div class='xyz' style='display:none;'>".$last_id."</div>";
   }
   
   if(isset($_POST['get_all_msg']) && isset($_POST['user']) && isset($_POST['sender_name']))
   {
      $sname = $_POST['sender_name'];
      $user = $_POST['user'];
      $member_id = $_SESSION['id'];
      $data=mysqli_query($con,"SELECT * FROM message where (sender_id = '$member_id' AND receiver_id = '$user') OR (sender_id = '$user' AND receiver_id = '$member_id')");      
      while($row = mysqli_fetch_array($data))
      {
      if($row['sender_id']==$member_id){?>         
      <div id="chatting">
      <?php
      echo $row['sender_name'];
     // echo $row['message_id'];?>
      <p style="color:#fff; "><?php
      echo $row['msg'];?></p>
     </div><?php } 
     if($row['sender_id']==$user){?> 
     <div class="chatcontainer darker">
   <?php
      echo $row['sender_name'];?>
   <p style="color:#fff; "><?php
      echo $row['msg'];
      ?></p>
</div><?php } ?>
<?php
   } 
   }
  
   ?>
