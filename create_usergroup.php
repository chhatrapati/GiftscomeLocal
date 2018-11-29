<?php 
session_start();
require_once('includes/config.php');

    
       $member_id = $_SESSION['id'];
      $group_name=$_POST['group_name'];
	//echo  $username=$_POST['username'];
	  $uid=$_POST['uid'];
	  $chatroomno='';
	  //exit();
	 // echo "SELECT DISTINCT(chatroomno) from `chatroom` WHERE `create_userid`='$member_id'";
	  $ab=mysqli_query($con,"SELECT DISTINCT(chatroomno) from `chatroom`");
	  while($z=mysqli_fetch_array($ab))
	  {
	  //$z=mysqli_fetch_assoc($ab);
	   $chatroomno= $z['chatroomno'];
	  }
	 $sql="SELECT DISTINCT(chatroomno) from `chatroom` WHERE chatroomno='$chatroomno'";
	
        $res=mysqli_query($con,$sql);
		
        if (mysqli_num_rows($res) >= 0) {
			
        // output data of each row
        $row = mysqli_fetch_assoc($res);

  // echo $row['chatroomno'];
// exit();   
		// var_dump($row);
             // //echo $row;
			// //print_r($row);
		// exit();		
        if ($chatroomno==$row['chatroomno'])
        {
           // echo "Username already exists";
		  // $chatroomno=$chatroomno+1;
		  //$count++;
		  $count=1;
		  $chatroomno=$chatroomno+$count;
		$b="INSERT INTO `chatroom` (`chat_name`,`create_userid`, `userid`,`chatroomno`) VALUES ('$group_name','$member_id', '$uid','$chatroomno')";
			mysqli_query($con,$b);
			$count++;
			echo "chat room created";
        }
        else{
			
			echo $a="INSERT INTO `chatroom` (`chat_name`,`create_userid`, `userid`,`chatroomno`) VALUES ('$group_name','$member_id', '$uid','12')";
			mysqli_query($con,$a);
             echo "create";
        }
    }
	// // $chat_password=$_POST['chatpass'];
	// //echo "SELECT DISTINCT(chatroomno) from `chatroom` WHERE `create_userid`='$member_id'";
	// // $query="SELECT DISTINCT(chatroomno) from `chatroom` WHERE `create_userid`='$member_id'";
	// // $result=mysqli_query($con,$query);
    // // while($row=mysqli_fetch_array($result)){
			// // // $cno=$row['chatroomno'];
            // // if($row["chatroomno"]==$chatroomno)
			// // {
				// // // inline condition is a personal preference
				// // echo "yes";
        // // }
    // // else{
	// // echo "insert into chatroom(chat_name,create_userid,userid,uname,chatroomno) values ('$group_name','$member_id','$uid','$username','$chatroomno')";
		
       // // //mysqli_query($con,"insert into chatroom(chat_name,date_created,create_userid,userid,uname,chatroomno) values ('$group_name',NOW(),'$member_id','$uid','$username','$chatroomno')");      //echo "Doesn't exist";
	   // // echo "Chat room Created";
  
    // // }
	 // // }

	// // while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
	// // {
		// // echo $cno=$row['chatroomno'];
		// // echo $chatroomno;
	// // if($chatroomno==$cno)
		// // {
			// // echo "yes";
			
		// // }
	
		// // else
		// // {
	// // mysqli_query($con,"insert into chatroom(chat_name,date_created,create_userid,userid,uname,chatroomno) values ('$group_name',NOW(),'$member_id','$uid','$username','$chatroomno')");      //echo "Doesn't exist";
	  // // echo "Chat room Created";
  
		// // }
		// // }
	
	
	
	
	
	 // // if ($result=mysqli_query($con,$query))
  // // {
   // // if(mysqli_num_rows($result) > 0)
    // // {
     // // // echo "Exists";
	  // // $chatroomno+=1;
	 // // mysqli_query($con,"insert into chatroom(chat_name,date_created,create_userid,userid,uname,chatroomno) values ('$group_name',NOW(),'$member_id','$uid','$username','$chatroomno')");
	  // // echo "Chat room Created";
    // // }
  // // else
  // // {
  // // mysqli_query($con,"insert into chatroom(chat_name,date_created,create_userid,userid,uname,chatroomno) values ('$group_name',NOW(),'$member_id','$uid','$username','$chatroomno')");      //echo "Doesn't exist";
	  // // echo "Chat room Created";
  
  // // }
  // // }
	// // // exit();
   // // while($r=mysqli_fetch_array($s))
	// // {
	// // echo "fggdg =".$chatn=$r['chatroomno'];
	// // if( $chatroomno==$chatn)
	// // {
		// // echo"if";
		// // $chatroomno+=1;
		// // echo "insert into chatroom(chat_name,date_created,create_userid,userid,uname,chatroomno) values ('$group_name',NOW(),'$member_id','$uid','$username','$chatroomno')";
		// // mysqli_query($con,"insert into chatroom(chat_name,date_created,create_userid,userid,uname,chatroomno) values ('$group_name',NOW(),'$member_id','$uid','$username','$chatroomno')");
	// // }
	// // else
	// // {
	// // echo "else";
	
// // mysqli_query($con,"insert into chatroom(chat_name,date_created,create_userid,userid,uname,chatroomno) values ('$group_name',NOW(),'$member_id','$uid','$username','$chatroomno')");
	// // //$cid=mysqli_insert_id($con);
	
	// // //mysqli_query($con,"insert into chat_member (chatroomid, userid) values ('$cid', '$member_id')");
	
	// // //echo "Chat room Created";
	
	// // //$cid;
	
	// // }
	
	// // }
	
?>