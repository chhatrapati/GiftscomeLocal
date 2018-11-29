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
</head>
<body>

<?php require_once('include/header.php');?>
<!--sidebar-menu-->
<?php require_once('include/sidebar.php');?>
<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Support Email List</a> </div>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Support Email</h5>
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
		
		<form class="form-horizontal"name="insertproduct" id ="addproduct" method="post"  enctype="multipart/form-data" >
									
	 <table class="table table-inbox table-hover">
                            <tbody>
                              <tr class="unread">
							    <?php
							  $member_id=$_SESSION['id'];
                     				
					$query = "SELECT * FROM support WHERE receiver_id='$member_id'";
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                       while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
						   ?>
						    <input type="hidden" value="<?php echo $row1['sender_id'];?>">
						   <input type="hidden" value="<?php echo $row1['receiver_name'];?>">
						   <input type="hidden" value="<?php echo $row1['support_id'];?>">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox">
                                  </td>
								  
                                  <td class="inbox-small-cells s-text13"><i class="fa fa-star"></i></td>
								     <td class="view-message  dont-show s-text13 " >
								  <form action="support_chat.php" method="post">
								     <input type="hidden" name="msg" value="<?php echo $row['msg'];?>">
							    <input type="hidden" name="sender_id" value="<?php echo $row['sender_id'];?>">
								 <input type="hidden" name="support_id" value="<?php echo $row['support_id'];?>">
								  <input type="hidden" name="sender_name" value="<?php echo $row['sender_name'];?>">
								   <input type="hidden" name="sender_img" value="<?php echo $row['sender_img'];?>">
							 <input type="hidden" name="receiver_name" value="<?php echo $row['receiver_name'];?>">
						       <input type="hidden" name="receiver_img" value="<?php echo $row['receiver_img'];?>">
								  <input type="submit" name="submit" value="<?php echo $row['sender_name'];?>" style="background:white;border: none;">
								  </form>
								  </td>
								   <td class="view-message  dont-show s-text13 ">
                                 <form action="support_chat.php" method="post">
								   <input type="hidden" name="msg" value="<?php echo $row['msg'];?>">
							    <input type="hidden" name="sender_id" value="<?php echo $row['sender_id'];?>">
								 <input type="hidden" name="support_id" value="<?php echo $row['support_id'];?>">
								  <input type="hidden" name="sender_name" value="<?php echo $row['sender_name'];?>">
								   <input type="hidden" name="sender_img" value="<?php echo $row['sender_img'];?>">
							<input type="hidden" name="receiver_name" value="<?php echo $row['receiver_name'];?>">
						   <input type="hidden" name="receiver_img" value="<?php echo $row['receiver_img'];?>">
								  <input type="submit" name="submit" value="<?php echo $row['msg'];?>" style="background:white;border: none;">
								  </form></td>
								  
                         <!--<td class="view-message  dont-show s-text13 "><a href="support_chat.php?sender_name=<?php //echo $row['sender_name'];?>&msg=<?php //echo $row['msg'];?>&sender_id=<?php //echo $row['sender_id'];?>&reciver_name=<?php //echo $row['receiver_name'];?>&support_id=<?php //echo $row['support_id'];?>"><?php //echo $row['sender_name'];?></a></td>
                                  <td class="view-messag s-text13e"><a href="support_chat.php?sender_name=<?php //echo $row['sender_name'];?>&msg=<?php //echo $row['msg'];?>&sender_id=<?php //echo $row['sender_id'];?>&reciver_name=<?php //echo $row['receiver_name'];?>&support_id=<?php //echo $row['support_id'];?>"><?php //echo $row['msg'];?></a></td>-->
                                  <!--<td class="view-message  inbox-small-cells s-text13"><i class="fa fa-paperclip"></i></td>-->
                                  <td class="view-message  text-right s-text13"><?php echo $row['msg_date'];?></td>
                              </tr>
							    <?php
					   }
                           ?>
						      <tr class="unread">
							  <?php
							  $member_id=$_SESSION['id'];
							  $query2 = "SELECT * FROM support_reply where receiver_id='$member_id'";
                       $result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
                       while ($row2 = mysqli_fetch_array($result2, MYSQLI_BOTH)) {
					  ?>
					
					     
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
								   
								     <td class="view-message  dont-show s-text13 " >
								  <form action="support_chat.php" method="post">
								     <input type="hidden" name="msg" value="<?php echo $row2['msg'];?>">
							    <input type="hidden" name="sender_id" value="<?php echo $row2['sender_id'];?>">
								 <input type="hidden" name="support_id" value="<?php echo $row2['support_id'];?>">
								  <input type="hidden" name="sender_name" value="<?php echo $row2['sender_name'];?>">
								   <input type="hidden" name="sender_img" value="<?php echo $row2['sender_img'];?>">
							 <input type="hidden" name="receiver_name" value="<?php echo $row2['receiver_name'];?>">
						       <input type="hidden" name="receiver_img" value="<?php echo $row['receiver_img'];?>">
								  <input type="submit" name="submit" value="<?php echo $row2['sender_name'];?>" style="background:white;border: none;">
								  </form>
								  </td>
								   <td class="view-message  dont-show s-text13 ">
                                 <form action="support_chat.php" method="post">
								   <input type="hidden" name="msg" value="<?php echo $row2['msg'];?>">
							    <input type="hidden" name="sender_id" value="<?php echo $row2['sender_id'];?>">
								 <input type="hidden" name="support_id" value="<?php echo $row2['support_id'];?>">
								  <input type="hidden" name="sender_name" value="<?php echo $row2['sender_name'];?>">
								   <input type="hidden" name="sender_img" value="<?php echo $row2['sender_img'];?>">
							<input type="hidden" name="receiver_name" value="<?php echo $row2['receiver_name'];?>">
						   <input type="hidden" name="receiver_img" value="<?php echo $row2['receiver_img'];?>">
								  <input type="submit" name="submit" value="<?php echo $row2['msg'];?>" style="background:white;border: none;">
								  </form></td>
                                <!--<td class="view-message  dont-show">
								<a href="support_chat.php?sender_name=<?php //echo $row2['sender_name'];?>&msg=<?php //echo $row2['msg'];?>&sender_id=<?php //echo $row2['sender_id'];?>&reciver_name=<?php //echo $row2['receiver_name'];?>&support_id=<?php //echo $row2['support_id'];?>"><?php //echo $row2['sender_name'];?></a></td>
                                  <td class="view-message "><a href="support_chat.php?sender_name=<?php// echo $row2['sender_name'];?>&msg=<?php //echo $row2['msg'];?>&sender_id=<?php //echo $row2['sender_id'];?>&reciver_name=<?php //echo $row2['receiver_name'];?>&support_id=<?php //echo $row2['support_id'];?>"><?php //echo $row2['msg'];?></a></td>-->
                                  <!--<td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>-->
                                  <td class="view-message  text-right"><?php echo $row2['msg_date'];?></td>
							
                              </tr>
                            <?php
					   }
                           ?>
                          </tbody>
                          </table>
		</form>
		
		
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
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/jquery.validate.js"></script>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#addproduct").validate({
    
        // Specify the validation rules
        rules: {
            category:{ required : true},
       
               
        },
        
        // Specify the validation error messages
        messages: {
            category:  {
				required : "Please select Admin name"
			},
            productName:{ required :"Please enter product name"}
		
           
        },
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		},
        
        submitHandler: function(form) {
            form.submit();
        }
    });
  </script>
  <script>
 $(document).ready(function(){
        setTimeout(function() {
          $('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    });
</script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('#user').change(function () {
            var value = ($(this).val());
            //alert(value);

            $.ajax({

                              type: "POST",

                               url: "script.php",
                 data: {

                    value: value

                               },
                 success: function (result) {

                

                                       $("#display").html(result).show();

                               }

            });
        });
    });
</script>

</body>
</html>
