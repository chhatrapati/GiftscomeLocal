<?php
session_start();
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{
	$cat_name=$_POST['cat_name'];
	$id=toInternalId($_GET['id']);
$sql=mysqli_query($con, "update tbl_faq_categories set cat_name='$cat_name' where id='$id'");
$_SESSION['msg']="Category Updated !!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit Category | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Category</a> </div>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Faq Category</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(isset($_POST['submit'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
											setTimeout(function () {
											var basepath = window.location.protocol + '//' + window.location.hostname;
											var path = basepath + '/admin/faq-categories.php';
											window.location.href= path; // the redirect goes here
											},1000); // 5 seconds
						          </script>
									</div>
		<?php } ?>
				
		<form class="form-horizontal" name="Category" id="category" method="post"  enctype="multipart/form-data" >
		<?php
		$id=toInternalId($_GET['id']);
		$query=mysqli_query($con,"select * from tbl_faq_categories where id='$id'");
		while($row=mysqli_fetch_array($query)) { ?>								
		<div class="control-group">
		<label class="control-label" for="basicinput">Category Name</label>
		<div class="controls">
		<input type="text" placeholder="Enter faq category name"  name="cat_name" id="cat_name" value="<?php echo  htmlentities($row['cat_name']);?>" class="span8 tip" required>
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
<script src="js/jquery.validate.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#category").validate({
    
        // Specify the validation rules
        rules: {
            cat_name: "required",
              
        },
        // Specify the validation error messages
        messages: {
            cat_name: "Please enter category name",
            
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