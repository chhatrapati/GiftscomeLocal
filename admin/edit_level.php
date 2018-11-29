<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
$pid=toInternalId($_GET['id']);// product id
if(isset($_POST['submit']))
{
    $level_points=$_POST['level_points'];
    $slider_image = $_FILES['level_image']['name'];
    $tmp_img = $_FILES['level_image']['tmp_name'];
	
	if(is_uploaded_file($tmp_img))
			{
				//echo $tmp_img; die();
	$pid=toInternalId($_GET['id']);
	move_uploaded_file($tmp_img,"images/$slider_image");
	$sql=mysqli_query($con,"update tbl_users_level set level_image='$level_image',level_points='$level_points' where id='$pid'");
     $_SESSION['msg']="tbl_users_level Updated Successfully !!";
	 header('location:manage-level.php');
			}
		else
			{
	$sql=mysqli_query($con,"update tbl_users_level set level_points='$level_points' where id='$pid'");
	$_SESSION['msg']="level Updated Successfully !!";
	 header('location:manage-level.php');

			}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit level | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Level Image</a> </div>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-content nopadding">
		<?php if(isset($_POST['submit'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<!--<script type="text/javascript">
											setTimeout(function () {
											var basepath = window.location.protocol + '//' + window.location.hostname;
											var path = basepath + '/admin/manage-level.php';
											window.location.href= path; // the redirect goes here
											},1000); // 5 seconds
						          </script>-->
									</div>
		<?php } ?>
		<?php if(isset($_GET['del'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
		<?php } ?>
				
		<form class="form-horizontal" name="level_manage" id="level_manage" method="post"  enctype="multipart/form-data" >
		<?php 
		$query=mysqli_query($con,"select * from tbl_users_level where id=$pid");
		$cnt=1;
		while($row=mysqli_fetch_array($query))
		{ ?>							

		<div class="control-group">
		<label class="control-label" for="basicinput">level points</label>
		<div class="controls">
		<input type="text" name="level_points" id="productShippingcharge" value="<?php echo htmlentities($row['level_points']);?>"  placeholder="Enter Level points" class="span8 tip" required>
		</div>
		</div>
	     <div class="control-group">
		<label class="control-label" for="basicinput">level Image</label>
		<div class="controls">
			<input type="file" name="level_image" id="productimage1" value="" class="span8 tip" >
		<img src="images/<?php echo htmlentities($row['level_image']);?>" width="50" height="50">
		</div>
		</div>
		<?php } ?>
		<div class="control-group">
			<div class="controls">
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
<?php require_once('include/common_js.php');?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#level_manage").validate({
    
        // Specify the validation rules
        rules: {
            user_levels_name:{ required : true},
            user_levels_complete:{ required : true},
			  
        },
        
        // Specify the validation error messages
        messages: {
           
            user_levels_name:{ required :"Please enter level title"},
			user_levels_complete:{ required :"Please enter level description"}
           
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
<?php }?>