<!DOCTYPE html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once('templates/common_css.php');?>
	<style>
	.first-section {
    background-color: #17a2b8;
}
	</style>
</head>
<body class="animsition">
<?php
require_once('templates/header.php');
//error_reporting(1);
//print_r($_SESSION);
?>
	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
		<h2 class="l-text2 t-center">
			Inbox Message
		</h2>
		<p class="m-text13 t-center">
			Inbox message Area
		</p>
	</section>
	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
			<?php require_once('templates/friends_sidebar.php');?>
				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50" id="productContainer">
					
				<div class="panel panel-primary">
               
                <div class="panel-body">
				
                    <ul class="chat">
					<?php
					 $sender_name=$_POST['sender_name'];
					 $msg=$_POST['msg'];
					 $sender_id=$_POST['sender_id'];
					$reciver_name=$_POST['receiver_name'];
					 $message_id=$_POST['message_id'];
					$reciver_img=$_POST['receiver_img'];
					 $sender_img=$_POST['sender_img'];
					 $member_id = $_SESSION['id'];
					
				
					?>
			
				<input type="hidden" name="mid" id="mid" value='<?php echo $member_id;?>'>
					<input type="hidden" name="sid" id="sid" value='<?php echo $sender_id;?>'>
					<input type="hidden" name="rname" id="rname" value ='<?php echo $reciver_name;?>'>
					<input type="hidden" name="msgid" id="msgid" value='<?php echo $msg;?>'>
					<input type="hidden" name="sname"  id="sname" value='<?php echo $sender_name;?>'>
					<input type="hidden" name="sender_img"  id="sender_img" value='<?php echo $sender_img ;?>'>
					<input type="hidden" name="reciver_img"  id="reciver_img" value='<?php echo $reciver_img ;?>'>
			
					
					  <li class="left clearfix">
						    <?php
							  $member_id=$_SESSION['id'];
							  
                     				
					$query = "SELECT * FROM message WHERE receiver_id='$member_id' and sender_id='$sender_id'";
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                       while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
						   ?>
						<span class="chat-img pull-left">
					
				

				<img src="users-images/<?php echo $row['sender_img'];?>" width="100px" height="100px">
				
			
                
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font"><?php echo $row['sender_name'];?></strong> <small class="pull-right text-muted">
								
                                        <span class="glyphicon glyphicon-time"></span><?php echo $row['msg_date'];?></small>
                                </div>
                                <p>
                               <?php echo $row['msg'];?>
                                </p>
                            </div>
							 <?php } ?>
                        </li>
				   
					
                        <li class="left clearfix">
							<?php
          $query2 = "SELECT * FROM reply where receiver_id='$member_id' and sender_id='$sender_id' or sender_id='$member_id' and receiver_id='$sender_id'";   
                     $result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
                       while ($row2 = mysqli_fetch_array($result2, MYSQLI_BOTH)) {
						  ?>
						<span class="chat-img pull-left">
					
				

				<img src="users-images/<?php echo $row2['sender_img'];?>" width="100px" height="100px">
				
			
                
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font"><?php echo $row2['sender_name'];?></strong> <small class="pull-right text-muted">
								
                                        <span class="glyphicon glyphicon-time"></span><?php echo $row2['msg_date'];?></small>
                                </div>
                                <p>
                               <?php echo $row2['msg'];?>
                                </p>
                            </div>
							 <?php } ?>
                        </li>
					  
				      
						
						
 
						
                  </ul>
                </div>
			
                <div class="panel-footer">
				<form method="post" id="compose">
                    <div class="input-group">
					<input type="hidden" name="mid" id="mid" value='<?php echo $member_id ;?>'>
					<input type="hidden" name="sid" id="sid" value='<?php echo $sender_id ;?>'>
					<input type="hidden" name="rname" id="rname" value ='<?php echo $reciver_name;?>'>
					<input type="hidden" name="msgid" id="msgid" value='<?php echo $message_id;?>'>
					<input type="hidden" name="sname"  id="sname" value='<?php echo $sender_name;?>'>
					<input type="hidden" name="sender_img"  id="sender_img" value='<?php echo $sender_img ;?>'>
					<input type="hidden" name="reciver_img"  id="reciver_img" value='<?php echo $reciver_img ;?>'>
                        <input  type="text"  name="reply_msg" id="msg" class="form-control input-sm" placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <!--<button class="btn btn-warning btn-sm" id="btn-chat">
                                Send</button>-->
								<input type="submit" name="reply" class="btn btn-warning btn-sm" id="btn-chat" value="Send">
                        </span>
							
						</form>
                    </div>
                </div>
				
				
				
			
				
            </div>
											</div>
				</div>
			</div>
		</div>
	</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#compose").submit(function() {	
    	
		$.ajax({
			type: "POST",
			url: 'reply.php',
			data:$("#compose").serialize(),
			success: function (data) {	
				// Inserting html into the result div on success
				$('#results').html(data);
				window.setTimeout(function(){location.reload()},500)
			},
			error: function(jqXHR, text, error){
            // Displaying if there are any errors
            	$('#result').html(error);           
        }
    });
		return false;
	});
});
</script>


</body>
</html>