<?php
session_start();
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']))
{
	$page_name=$_POST['page_name'];
	$meta_title=$_POST['meta_title'];
	$meta_keyword=$_POST['meta_keyword'];
	$meta_robots=$_POST['meta_robots'];
	$meta_description=$_POST['meta_description'];
	$id=toInternalId($_GET['id']);
$sql=mysqli_query($con, "update manage_seo set page_name='$page_name',meta_title='$meta_title',meta_keyword='$meta_keyword',meta_robots='$meta_robots',meta_description='$meta_description' where id='$id'");
$_SESSION['msg']="SEO Updated !!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit Category | Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/colorpicker.css" />
<link rel="stylesheet" href="css/datepicker.css" />
<link rel="stylesheet" href="css/uniform.css" />
<link rel="stylesheet" href="css/select2.css" />
<link rel="stylesheet" href="css/matrix-style.css" />
<link rel="stylesheet" href="css/matrix-media.css" />
<link rel="stylesheet" href="css/bootstrap-wysihtml5.css" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<?php require_once('include/header.php');?>
<!--sidebar-menu-->
<?php require_once('include/sidebar.php');?>
<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to SEO" class="tip-bottom"><i class="icon-home"></i> Manage SEO</a> <a href="#" class="current">Edit SEO</a> </div>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit SEO</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(isset($_POST['submit'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									setTimeout(function () {
									var basepath = window.location.protocol + '//' + window.location.hostname;
									var path = basepath + '/admin/manage_seo.php';
									window.location.href= path; // the redirect goes here
									},1000); // 5 seconds
								   </script>
								  
									</div>
		<?php } ?>
				
		<form class="form-horizontal" name="Category" id="category" method="post"  enctype="multipart/form-data" >
		<?php
		$id=toInternalId($_GET['id']);
		$query=mysqli_query($con,"select * from manage_seo where id='$id'");
		while($row=mysqli_fetch_array($query)) { ?>	
		<div class="control-group">
                <label class="control-label" for="basicinput">Page Name</label>
				<?php $options =  htmlentities($row['page_name']);?>
                <div class="controls">
                  <select name="page_name" id="page_name" class="span8 tip" required>
				  <option value="">Select Page</option>
                    <option value="About Us" <?php if($options=="About Us") echo "selected"; ?>>About Us</option>
					<option value="Contact Us" <?php if($options=="Contact Us") echo "selected"; ?>>Contact Us</option>
                  </select>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label" for="basicinput">Meta Title</label>
                <div class="controls">
                  <input type="text" placeholder="Meta Title"  name="meta_title" id="meta_title" value="<?php echo  htmlentities($row['meta_title']);?>" class="span8 tip" required>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label" for="basicinput">Meta Keyword</label>
                <div class="controls">
                  <input type="text" placeholder="Meta Keyword"  name="meta_keyword" id="meta_keyword" value="<?php echo  htmlentities($row['meta_keyword']);?>" class="span8 tip" required>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label" for="basicinput">Meta Robots</label>
                <div class="controls">
                  <input type="text" placeholder="Meta Robots"  name="meta_robots" id="meta_robots" value="<?php echo  htmlentities($row['meta_robots']);?>" class="span8 tip" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="basicinput">Meta Description</label>
                <div class="controls">
                  <textarea class="span8" name="meta_description" id="meta_description" rows="5"><?php echo  htmlentities($row['meta_description']);?></textarea>
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
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script>
<script src="js/jquery.validate.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#category").validate({
    
        // Specify the validation rules
        rules: {
            category: "required",
            description: "required",
               
        },
        
        // Specify the validation error messages
        messages: {
            category: "Please enter category name",
            description: "Please enter category description",
           
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
