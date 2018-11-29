<?php
session_start();
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
if(isset($_POST['submit']) && @$_SESSION["csrf_token"] == @$_POST['csrf_token'])
{
	$id=toInternalId($_GET['id']);
	date_default_timezone_set('Asia/Kolkata');// change according timezone
	$currentDate = date( 'd-m-Y', time () );
	$currentTime = date( 'h:i A', time () );
	$title=$_POST['title'];
	$announcement=$_POST['announcement'];
	$sql=mysqli_query($con, "update announcement set title='$title',announcement='$announcement',announcement_date='$currentDate',announcement_time='$currentTime' where id='$id'");
	$_SESSION['msg']="Record Updated !!";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Update Admin Announcement | Admin</title>
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
  <div id="breadcrumb"> <a href="manage-users.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Update Admin Announcement</a> </div>
</div>
<div class="container-fluid">
   <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Update Admin Announcement</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(!empty($_SESSION['msg'])){?>
									<div class="alert alert-success" id="successMessage">
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									setTimeout(function () {
									var basepath = window.location.protocol + '//' + window.location.hostname;
									var path = basepath + '/admin/announcement.php';
									window.location.href= path; // the redirect goes here
									},1000); // 5 seconds
								</script>
									</div>
		<?php } ?>
		
		<form class="form-horizontal" name="update_announcement" id="update_announcement" method="post"  enctype="multipart/form-data" >
			<?php
			$id=toInternalId($_GET['id']);
			$query=mysqli_query($con,"select * from announcement  where id='$id'");
			while($row=mysqli_fetch_array($query)) { ?>							
			
		<div class="control-group">
		<label class="control-label" for="basicinput">Title</label>
		<div class="controls">
		<input type="text" class="span8" name="title" id="title" value="<?php echo  htmlentities($row['title']);?>">
		</div>
	    </div>
		<div class="control-group">
		<label class="control-label" for="basicinput">Announcement</label>
		<div class="controls">
		<textarea class="span8" name="announcement" id="announcement" rows="5" value="<?php echo  htmlentities($row['announcement']);?>"><?php echo  htmlentities($row['announcement']);?></textarea>
		</div>
	    </div>
        <?php } ?>	
		  <div class="control-group">
			<div class="controls">
			<?php $_SESSION["csrf_token"] = md5(rand(0,10000000)).time(); ?>
					  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION["csrf_token"]);?>">
				<button type="submit" name="submit" class="btn btn-success">Update</button>
			</div>
		  </div>
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
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.validate.js"></script>
<?php require_once('tiny-myc.php');?>
<script src="js/matrix.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#update_announcement").validate({
    
        // Specify the validation rules
        rules: {
            title: "required",
			announcement: "required",
               
        },
        
        // Specify the validation error messages
        messages: {
            title: "Please enter title",
			announcement: "Please enter announcement description",
           
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
</body>
</html>