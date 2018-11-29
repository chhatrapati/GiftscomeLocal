
<?php 
session_start();
require_once('includes/config.php');
$chatid=$_POST['chatroomno'];
//$msg=$_POST['msg'];
// $query=mysqli_query($con,"SELECT `uname`, (SELECT * FROM `users` WHERE id IN(128,130)) as u FROM `chatroom` WHERE `chatroomno`='$chatid'") or die(mysqli_error($con));
 $nam =array();


$sql=mysqli_query($con,"select userid from chatroom where `chatroomno`='$chatid'");
$a=mysqli_fetch_assoc($sql);
	
	$chatuserid=$a['userid'];
	
	$query=mysqli_query($con,"SELECT * FROM users WHERE id IN($chatuserid) limit 2");
	while($row=mysqli_fetch_array($query)){

	$nam[]=$row['name'];
	}
	//echo"Chat Member :-";
	$name=implode(",",$nam);
	echo '<span style="margin-left:10px;">'.$name.'</span>';
    //echo implode(",",$nam);
     echo "...";
	
	$member_id = $_SESSION['id'];
//echo "SELECT `chatroomno`,create_userid FROM `chatroom` WHERE `create_userid`='$member_id' and `chatroomno`='$chatid'";
$sql=mysqli_query($con,"SELECT `chatroomno`,create_userid FROM `chatroom` WHERE `create_userid`='$member_id' and `chatroomno`='$chatid'");

$row=mysqli_fetch_assoc($sql);


	if($row['create_userid']==$member_id)
	{
		
		echo '<button type="button" onclick="editchatroom()" style="border:0;background: transparent;color: #337ab7;outline: 0;">
		<span class="ks-text" data-toggle="modal" data-target="#editchatroom"</span>
									<i class="fa fa-edit" style="margin-left:10px;"></i>
									<span class="tooltiptext">Edit Chat Room</span>
								</button>';
								
		echo '<button type="button" onclick="delete_group('.$row['chatroomno'].')" style="border:0;background: transparent;color: #337ab7;outline: 0;">
									<span class="ks-text"</span>
									<i class="fa fa-trash" aria-hidden="true" style="margin-left:10px;"></i>
									<span class="tooltiptext" style="font-size:10px; width: 123px;">Delete Chat Room</span>
								</button>';

		//echo '<i class="fa fa-pencil" aria-hidden="true" onclick="editchatroom()"><span class="ks-text" data-toggle="modal" data-target="#editchatroom"</span></i>';
        //echo '<i class="fa fa-trash" aria-hidden="true"></i>';
//echo "<button type='button' onclick='editchatroom()' class='btn btn-warning' style='margin:8px 71px'><span class='ks-text' data-toggle='modal' data-target='#editchatroom'>edit chat room</span></button>";
//echo'<input type="submit" value="delete" style="background-color: #f44336;" onclick="delete_group('.$row['chatroomno'].')">';

	}
	else		
	{
		echo '<button type="button"  onclick="leave_group('.$chatid.')" style="border:0;background: transparent;color: #337ab7;outline: 0;">
		<span class="ks-text" data-toggle="modal" data-target="#editchatroom"</span>
									<i class="fa fa-trash" aria-hidden="true"></i>
								</button>';
	//echo '<input type="submit" value="leave" onclick="leave_group('.$chatid.')">';
	}
	
	
	
	$sql11=mysqli_query($con,"select userid from chatroom where `chatroomno`='$chatid'");
$aa=mysqli_fetch_assoc($sql11);
	
	 $chatmember=$aa['userid'];
	 
	 $user = split ("\,", $chatmember);
	 
	 $countuser=count($user);
	echo  '<div class="xyz" style="display:none;">'.$countuser.'</div>';
	// print_r($user);
	 //echo str_word_count($chatmember);
	 //echo strlen($chatmember);
	 //print_r($chatmember);
	 

// //$query=mysqli_query($con,"SELECT * FROM users WHERE id IN(128,129)");

// while($row=mysqli_fetch_array($query)){

// //echo "welcome";
 // echo $row['name'];
// //$userid = 
// //echo substr($nam, 0, -1);
	
// }
 // // echo"Chat Member :-";
  // // echo implode(",",$nam);	                          
		
		// // SELECT chatroom.userid, users.name
// // FROM users
// // INNER JOIN chatroom ON chatroom.`create_userid`=users.id;