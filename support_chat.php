<?php //session_start();
require_once('includes/config.php');

?>
<!DOCTYPE html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php require_once('templates/common_css.php');?>
	<style>
	   img.img-circle {
              margin: 4px;
			  border-radius:50%;
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
		<a href="view_friends.php" style="color:red"><strong><i class="fa fa-long-arrow-left" style="font-size:18px;color:red">Back</i></strong></a>
			<div class="row">
	
			
			
			<?php// require_once('templates/friends_sidebar.php');?>
				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					
				<div class="panel panel-primary">
               
                <div class="panel-body">
				
                    <ul class="chat">
					<?php
					$sender_name=$_POST['sender_name'];
					$msg=$_POST['msg'];
					$sender_id=$_POST['sender_id'];
					$reciver_name=$_POST['receiver_name'];
					$support_id=$_POST['support_id'];
					$member_id = $_SESSION['id'];
					?>
					<input type="hidden" name="mid" id="mid" value='<?php echo $member_id ;?>'>
					<input type="hidden" name="sid" id="sid" value='<?php echo $sender_id ;?>'>
					<input type="hidden" name="rname" id="rname" value ='<?php echo $reciver_name ;?>'>
					<input type="hidden" name="msgid" id="msgid" value='<?php echo $support_id ;?>'>
					<input type="hidden" name="sname"  id="sname" value='<?php echo $sender_name ;?>'>
									
									 <li class="left clearfix">
						    <?php
							  $member_id=$_SESSION['id'];
                     				
					$query = "SELECT * FROM support WHERE receiver_id='$member_id' and sender_id='$sender_id'";
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                       while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
						   ?>
						   <span class="chat-img pull-left" >
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
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
									
									
									<?php
                             
    $query2 = "SELECT * FROM support_reply where receiver_id='$member_id' and sender_id='$sender_id' or sender_id='$member_id' and receiver_id='$sender_id'";
                       $result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
                       while ($row2 = mysqli_fetch_array($result2, MYSQLI_BOTH)) {
					  ?>
					
					
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font"><?php echo $row2['sender_name'];?></strong> <small class="pull-right text-muted">
								
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>
                                <p>
                               <?php echo $row2['msg'];?>
                                </p>
                            </div>
                        </li>
					   <?php } ?>
				      
						
						
 
						
                  </ul>
                </div>
			
                <div class="panel-footer">
				<form method="post" id="compose">
                    <div class="input-group">
					<input type="hidden" name="mid" id="mid" value='<?php echo $member_id ;?>'>
					<input type="hidden" name="sid" id="sid" value='<?php echo $sender_id ;?>'>
					<input type="hidden" name="rname" id="rname" value ='<?php echo $reciver_name ;?>'>
					<input type="hidden" name="msgid" id="msgid" value='<?php echo $support_id ;?>'>
					<input type="hidden" name="sname"  id="sname" value='<?php echo $sender_name ;?>'>
                        <input  type="text"  name="reply_msg" autocomplete="off" id="msg" class="form-control input-sm" placeholder="Type your message here..." /    style=" margin-top: 44px";>
                        <span class="input-group-btn">
                            <!--<button class="btn btn-warning btn-sm" id="btn-chat">
                                Send</button>-->
								<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit" name="send_email" value="Send"><i class="fa fa-paper-plane" aria-hidden="true" style="padding-right:20px;padding-left:20px ">Send</i></button>
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
			url: 'support_reply.php',
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