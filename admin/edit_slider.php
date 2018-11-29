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
	$slider_title=$_POST['slider_title'];
    $slider_description=$_POST['slider_description'];
    $slider_image = $_FILES['slider_image']['name'];
    $tmp_img = $_FILES['slider_image']['tmp_name'];
	
	if(is_uploaded_file($tmp_img))
			{
				//echo $tmp_img; die();
	$pid=toInternalId($_GET['id']);
	move_uploaded_file($tmp_img,"images/$slider_image");
	$sql=mysqli_query($con,"update slider set slider_image='$slider_image',slider_title='$slider_title',slider_description='$slider_description' where slider_id='$pid'");
     $_SESSION['msg']="Slider Updated Successfully !!";
			}
		else
			{
	$sql=mysqli_query($con,"update slider set slider_title='$slider_title',slider_description='$slider_description' where slider_id='$pid'");
	$_SESSION['msg']="Slider Updated Successfully !!";

			}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit Slider | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Categorye</a> </div>
  <h1>Edit Category</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Category</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(isset($_POST['submit'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
											setTimeout(function () {
											var basepath = window.location.protocol + '//' + window.location.hostname;
											var path = basepath + '/admin/manage-slider.php';
											window.location.href= path; // the redirect goes here
											},1000); // 5 seconds
						          </script>
									</div>
		<?php } ?>
		<?php if(isset($_GET['del'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
		<?php } ?>
				
		<form class="form-horizontal" name="editslider" id="editslider" method="post"  enctype="multipart/form-data" >
		<?php 
		$query=mysqli_query($con,"select * from slider where slider_id=$pid");
		$cnt=1;
		while($row=mysqli_fetch_array($query))
		{ ?>							


		<div class="control-group">
		<label class="control-label" for="basicinput">Slider Title</label>
		<div class="controls">
		<input type="text" name="slider_title" id="productName"  placeholder="Enter Slider Tile" value="<?php echo htmlentities($row['slider_title']);?>" class="span8 tip">
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="basicinput">Slider Description</label>
		<div class="controls">
		<textarea  name="slider_description" id="productDescription"  placeholder="Enter Slider Description" rows="6" class="span8 tip">
		<?php echo htmlentities($row['slider_description']);?>
		</textarea>  
		</div>
		</div>

	     <div class="control-group">
		<label class="control-label" for="basicinput">Slider Image</label>
		<div class="controls">
			<input type="file" name="slider_image" id="productimage1" value="" class="span8 tip" required>
		<img src="images/<?php echo htmlentities($row['slider_image']);?>" style="width:30%;">
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
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#editslider").validate({
    
        // Specify the validation rules
        rules: {
            slider_title:{ required : true},
            slider_description:{ required : true},
			slider_image: {required : false,accept:"image/jpg,image/jpeg,image/png"},
	
               
        },
        
        // Specify the validation error messages
        messages: {
           
            slider_title:{ required :"Please enter slider title"},
			slider_description:{ required :"Please enter slider description"},
			slider_image: {required :"Please enter slider image",accept:"Please upload .jpg or .png or .jpeg file of notice."}
		
           
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
