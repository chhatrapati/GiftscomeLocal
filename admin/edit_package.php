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
	$package_id=toInternalId($_GET['package_id']);
	$package_name=$_POST['package_name'];
	$package_price=$_POST['package_price'];
	$package_validity=$_POST['package_validity'];
	$gift_coins=$_POST['gift_coins'];
	$package_description=$_POST['package_description'];
	$pack_image = $_FILES['image']['name'];
	$tmp_pack_img = $_FILES['image']['tmp_name'];
	
	if(is_uploaded_file($tmp_pack_img))
										{
									
		move_uploaded_file($tmp_pack_img,"images/$pack_image");
	
$sql=mysqli_query($con, "update package set package_name='$package_name',package_image='$pack_image',package_price='$package_price', package_validity= '$package_validity', gift_coins='$gift_coins',package_description='$package_description' where package_id='$package_id'");
$_SESSION['msg']="package Updated !!";
}
else{
	$sql=mysqli_query($con, "update package set package_name='$package_name',package_price='$package_price', package_validity= '$package_validity',gift_coins='$gift_coins',package_description='$package_description' where package_id='$package_id'");
	$_SESSION['msg']="package Updated !!";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit Package | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Package</a> </div>
  <h1>Edit Package</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Package</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(isset($_POST['submit'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									setTimeout(function () {
									var basepath = window.location.protocol + '//' + window.location.hostname;
									var path = basepath + '/admin/add_package.php';
									window.location.href= path; // the redirect goes here
									},1000); // 5 seconds
								   </script>
								
									</div>
		<?php } ?>
				
		<form class="form-horizontal" name="package_edit" id="package_edit" method="post"  enctype="multipart/form-data" >
								<?php
								$package_id=toInternalId($_GET['package_id']);
								$query=mysqli_query($con,"select * from package where package_id='$package_id'");
								while($row=mysqli_fetch_array($query))
								{
								?>									
								<div class="control-group">
								<label class="control-label" for="basicinput">Package Name</label>
								<div class="controls">
								<input type="text" placeholder="Enter category Name"  name="package_name" id="package_name" value="<?php echo  htmlentities($row['package_name']);?>" class="span8 tip" required>
								</div>
								</div>

								<div class="control-group">
								<label class="control-label" for="basicinput">Package Image</label>
								<div class="controls">
								<input type="file"  name="image" id="image">
								<img src="images/<?php echo $row['package_image'];?>" width="100px" height="100px">
								</div>
								</div>


								<div class="control-group">
								<label class="control-label" for="basicinput">Package Price</label>
								<div class="controls">
								<input type="text" placeholder="Enter Package Price"  name="package_price" id="package_price" value="<?php echo  htmlentities($row['package_price']);?>" class="span8 tip" required>
								</div>
								</div>

								<div class="control-group">
								<label class="control-label" for="basicinput">Package Validity (In Days)</label>
								<div class="controls">
								<input type="text" placeholder="Enter Package Validity"  name="package_validity" id="package_validity" value="<?php echo  htmlentities($row['package_validity']);?>" class="span8 tip" required>
								</div>
								</div>

								<div class="control-group">
								<label class="control-label" for="basicinput">Gift Coins Value</label>
								<div class="controls">
								<input type="text" placeholder="Enter Gift Coins Value"  name="gift_coins" id="gift_coins" value="<?php echo  htmlentities($row['gift_coins']);?>" class="span8 tip" required>
								</div>
								</div>


								<div class="control-group">
								<label class="control-label" for="basicinput">Description</label>
								<div class="controls">
								<textarea class="span8" name="package_description" id="description" rows="5"><?php echo  htmlentities($row['package_description']);?></textarea>
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
<script src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="js/jquery.validate.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#package_edit").validate({
    
        // Specify the validation rules
       rules: {
            package_name: "required",
            package_price: {
                required: true,
				digits: true
            },
			package_description: "required",
			image: {required : false,accept:"image/jpg,image/jpeg,image/png"},
		    package_validity: {
                required: true,
				minlength:1,
				maxlength:3,
				digits: true
            },
			gift_coins: {
                required: true,
				digits: true
            },

               
        },
        
        // Specify the validation error messages
         messages: {
            package_name: {required:"Please enter package name"},
			package_price: {required:"Please enter package price",digits:"Please enter digits only"},
			package_validity: {required:"Please enter package validity",digits:"Please enter digits only"},
			gift_coins: {required:"Please enter gift coins value",digits:"Please enter digits only"},
            package_description: {required:"Please enter package description"},
			image: {required:"Please upload package image",accept:"Please upload .jpg or .png or .jpeg file of notice."},
			          
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
