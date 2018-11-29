<?php
session_start();
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
$ticket_id = $_GET["id"];
$ticket_id = base64_decode(urldecode($ticket_id));
$sql2=mysqli_query($con,"Select * from comments where ticket_id = '$ticket_id' order by created_at desc");
$num_rows = mysqli_fetch_row($sql2);
$Invoice_number1 = $num_rows[0];

if(isset($_POST['reply']))
{
$body=$_POST['message'];

$sql2=mysqli_query($con,"insert into comments (ticket_id,user_id,comment,created_at) values('$ticket_id',-1,'$body',NOW())");

$update_query = "UPDATE comments SET comment_status = 1 WHERE comment_status=0 and ticket_id = '$ticket_id'";
mysqli_query($con, $update_query);

$_SESSION['msg']="Ticket Reply updated Successfully!!";

}?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Reply Ticket | Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
<link rel="stylesheet" href="css/support_ticket.css" />
<style>
span.help-block {
    color: red !important;
    display: block !important;
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Reply Ticket</a> </div>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<?php if(isset($_POST['reply'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									setTimeout(function () {
									var basepath = window.location.protocol + '//' + window.location.hostname;
									var path = basepath + '/admin/support_us.php';
									window.location.href= path; // the redirect goes here
									},1000); // 5 seconds
								   </script>
								
									</div>
		<?php } ?>
      <div class="col-sm-8">
	  <?php $select_tic = mysqli_query($con,"Select * from tickets where `ticket_id` = '$ticket_id'");
								while ($row = $select_tic->fetch_assoc()) {
									 $sub = $row['sub']; ?>
	  <h4 style="margin-bottom:20px;">Subject: <?php echo $sub; ?></h4>
	   <?php } ?>
      <?php $select_tic = mysqli_query($con,"Select * from comments c left join users u on c.`user_id` = u.`id` where c.`ticket_id` = '$ticket_id' order by c.created_at desc");
								while ($row = $select_tic->fetch_assoc()) {
									 $sub = $row['sub'];
									 $msg = $row['comment'];
									 $msg_from = $row['user_id'] == -1 ? "Admin" :  $row['name'];
									 
					 ?>
      <div class="panel panel-default card-view">
        <div class="panel-heading">
          <div class="pull-left">
            <h6 class="panel-title txt-dark"><?php echo $msg_from; ?></h6><span style="font-size: 12px;font-style: italic; color:#FFFFFF;"><?php echo $row['created_at']; ?></span>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
          <div class="panel-body txt-dark"> <?php echo  $msg; ?> </div>
        </div>
      </div>
      <?php } ?>
    </div>
    </div>
	
	
	<div class="row-fluid">

	<div class="col-sm-12">
      <div class="panel panel-default card-view">
        <div class="panel-heading">
          <h3 class="panel-title">Reply Message</h3>
        </div>
        <div class="panel-body">
          <?php if(isset($_POST['submit'])){?>
          <div class="alert alert-success" id="successMessage">
            <button type="button" class="close" data-dismiss="alert"><i class="fa fa-times" aria-hidden="true"></i></button>
            <strong>Well done!</strong> <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?> </div>
          <?php } ?>
          <div id="welcomeDiv"  style="" class="answer_list" >
            <div class="">
              <div class="col-sm-8">
                <div class="form-wrap">
                  <form method="post" action=""  name="gen_tct" id="gen_tct" method="post">
                    <div class="form-group">
                      <label class="control-label mb-10 text-left">Message*</label>
                      <textarea class="tinymce" name="message" rows="6" cols="6" style="width:100%"></textarea>
					  <span class="help-block"></span>
                    </div>
                    <input type="submit" class="btn btn-success btn-anim" name="reply" value="Reply">
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
</div>
<!--Footer-part-->
<?php require_once('include/footer.php');?>
<!--end-Footer-part--> 
<?php require_once('include/common_js.php');?>
<script src="js/jquery.validate.js"></script>
<script type="text/javascript"> 
	$(document).ready(function(){
 // Setup form validation on the #register-form element
 $("#gen_tct").validate({
 	submitHandler : function(e) {
 		$(form).submit();
 	},
        // Specify the validation rules
        rules : {
        	message : {
				required : true
				
			}
			},
        // Specify the validation error messages
        messages: {
			message : {
				required : "Please enter message"
			},
		},
		errorPlacement : function(error, element) {
			$(element).closest('div').find('.help-block').html(error.html());
		},
		highlight : function(element) {
			$(element).closest('div').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).closest('div').removeClass('has-error').addClass('has-success');
			$(element).closest('div').find('.help-block').html('');
		}
	});

});
</script>
<!--<script src="vendor/bower_components/tinymce/tinymce.min.js"></script>
<script src="js/tinymce-data.js"></script>-->
<script>
 $(document).ready(function(){
        setTimeout(function() {
          $('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    });
</script>
</body>
</html>
<?php }?>
