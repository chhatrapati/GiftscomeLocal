<?php
session_start();
include('include/config.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Assign Menu to user | Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
<style>
	.clearfix {
    display:block !important;
	}
	</style>
</head>
<body>

<?php require_once('include/header.php');?>
<!--sidebar-menu-->
<?php require_once('include/sidebar.php');?>
<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Support Message</a> </div>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Support Message</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(!empty($_SESSION['msg'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									setTimeout(function () {
									   window.location.href= '/admin/role_assign.php'; // the redirect goes here
									},1000); // 5 seconds
									</script>
									</div>
		<?php } ?>
		<?php if(isset($_GET['del'])){?>
									<div class="alert alert-error" id="successMessage">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
		<?php } ?>
		
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
						   <span class="chat-img pull-left">
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
								
                                        <span class="glyphicon glyphicon-time"></span><?php echo $row2['msg_date'];?></small>
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
                        <input  type="text" style="width: 99%;height: 62px;"  name="reply_msg" id="msg" class="form-control input-sm" placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <!--<button class="btn btn-warning btn-sm" id="btn-chat">
                                Send</button>-->
								<input type="submit" name="reply" class="btn btn-warning btn-sm btn btn-success" style="margin-left: 643px;height: 40px;" id="btn-chat" value="Send">
                        </span>
							
						</form>
                    </div>
                </div>
				
				
				
			
				
            </div>
		
		
        </div>
      </div>
    </div>
	</div>

	
  </div>
  
</div>
<!--Footer-part-->
<?php require_once('include/footer.php');?>
<!--end-Footer-part-->
<?php require_once('include/common_js.php');?>
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
