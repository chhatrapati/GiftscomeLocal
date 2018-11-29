<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['name'])==0)
	{	
header('location:user_login.php');
}
else{
	$uid=toInternalId($_GET['id']);// product id
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$nick_name=$_POST['nick_name'];
	$email=$_POST['email'];
	$contactno=$_POST['contactno'];
	$gender=$_POST['gender'];
	$shippingAddress=$_POST['shippingAddress'];
	$shippingState=$_POST['shippingState'];
	$shippingCity=$_POST['shippingCity'];
	$shippingPincode=$_POST['shippingPincode'];
	$billingAddress=$_POST['billingAddress'];
	$billingState=$_POST['billingState'];
	$billingCity=$_POST['billingCity'];
	$billingPincode=$_POST['billingPincode'];
	$user_picture = $_FILES['file']['name'];
	$tmp_user_picture = $_FILES['file']['tmp_name'];
	if(is_uploaded_file($tmp_user_picture))
	 {
	 move_uploaded_file($tmp_user_picture,"../users-images/$user_picture");
	 $sql=mysqli_query($con,"update  users set name='$name',nick_name='$nick_name',email='$email',contactno='$contactno',gender='$gender',user_picture='$user_picture',shippingAddress='$shippingAddress',shippingState='$shippingState',shippingCity='$shippingCity',shippingPincode='$shippingPincode',billingAddress='$billingAddress',billingState='$billingState',billingCity='$billingCity',billingPincode='$billingPincode'  where id='$uid' ");
$_SESSION['msg']="Profile Updated Successfully !!";
	 }
else
{	
$sql=mysqli_query($con,"update  users set name='$name',nick_name='$nick_name',email='$email',contactno='$contactno',gender='$gender',shippingAddress='$shippingAddress',shippingState='$shippingState',shippingCity='$shippingCity',shippingPincode='$shippingPincode',billingAddress='$billingAddress',billingState='$billingState',billingCity='$billingCity',billingPincode='$billingPincode'  where id='$uid' ");
$_SESSION['msg']="Profile Updated Successfully !!";
}

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit Profile | Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
</head>
<body>

<?php require_once('include/user_header.php');?>
<!--sidebar-menu-->
<?php require_once('include/userlogin_sidebar.php');?>
<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="welcome_user.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Profile</a> </div>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Profile</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(isset($_POST['submit'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									setTimeout(function () {
									var basepath = window.location.protocol + '//' + window.location.hostname;
									var path = basepath + '/admin/view_users.php?id=<?php echo $_GET['id'];?>';
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
				
		<form class="form-horizontal row-fluid" name="editprofile" id="editprofile" method="post" enctype="multipart/form-data">

<?php 

$query=mysqli_query($con,"select * from users where id='".$uid."'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
  


?>


<div class="control-group">
<label class="control-label" for="basicinput">Name</label>
<div class="controls">
<input type="text"    name="name" id="name"  placeholder="Enter Your Name" value="<?php echo htmlentities($row['name']);?>" class="span8 tip">
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Nick Name</label>
<div class="controls">
<input type="text"    name="nick_name" id="nick_name"  placeholder="Enter Your Nick Name" value="<?php echo htmlentities($row['nick_name']);?>" class="span8 tip">
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Email</label>
<div class="controls">
<input type="text"    name="" id=""  placeholder="Enter Your Email" value="<?php echo htmlentities($row['email']);?>" class="span8 tip" readonly>
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Contact No</label>
<div class="controls">
<input type="text"    name="contactno" id="contactno"  placeholder="Enter Contact No" value="<?php echo htmlentities($row['contactno']);?>"  class="span8 tip">
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Gender</label>
<div class="controls">
<input type="radio" name="gender" value="Male" <?php if ($row['gender'] == 'Male') echo 'checked="checked"'; ?>" /> Male<br />
<input type="radio" name="gender" value="Female" <?php if ($row['gender'] == 'Female') echo 'checked="checked"'; ?>" /> Female
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Profile Picture</label>
<div class="controls">
<input type="file"  name="file" id="file">
<img src="/users-images/<?php echo $row['user_picture'];?>" width="100px" height="100px">
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Shipping Address</label>
<div class="controls">
<input type="text"    name="shippingAddress" id="shippingAddress"  placeholder="Enter Your Shipping Address" value="<?php echo htmlentities($row['shippingAddress']);?>" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Shipping State</label>
<div class="controls">
<input type="text"    name="shippingState" id="shippingState"  placeholder="Enter Your Shipping State" value="<?php echo htmlentities($row['shippingState']);?>" class="span8 tip">
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Shipping City</label>
<div class="controls">
<input type="text"    name="shippingCity" id="shippingCity"  placeholder="Enter Your Shipping City" value="<?php echo htmlentities($row['shippingCity']);?>" class="span8 tip">
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Shipping Pincode</label>
<div class="controls">
<input type="text"    name="shippingPincode" id="shippingPincode"  placeholder="Enter Your Shipping Pincode" value="<?php echo htmlentities($row['shippingPincode']);?>" class="span8 tip">
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Billing Address</label>
<div class="controls">
<input type="text"    name="billingAddress" id="billingAddress"  placeholder="Enter Your Billing Address" value="<?php echo htmlentities($row['billingAddress']);?>" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Billing State</label>
<div class="controls">
<input type="text"    name="billingState" id="billingState"  placeholder="Enter Your Billing State" value="<?php echo htmlentities($row['billingState']);?>" class="span8 tip">
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Billing City</label>
<div class="controls">
<input type="text"    name="billingCity" id="billingCity"  placeholder="Enter Your Billing City" value="<?php echo htmlentities($row['billingCity']);?>" class="span8 tip">
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Billing Pincode</label>
<div class="controls">
<input type="text"    name="billingPincode" id="billingPincode"  placeholder="Enter Your Billing Pincode" value="<?php echo htmlentities($row['billingPincode']);?>" class="span8 tip">
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
<!-- jQuery Form Validation code -->
  <script type="text/javascript"> 
  $.validator.addMethod('filesize', function(value, element, param) {
   return this.optional(element) || (element.files[0].size <= param) 
}); 
 // Setup form validation on the #register-form element
    $("#editprofile").validate({
    
        // Specify the validation rules
        rules : {
			name : {
				required : true
			},
			/*email : {
				required : true,
				email: true
				},*/
				
		  contactno : {
				 minlength:10,
                 maxlength:10,
				digits: true
				},
		shippingPincode : {
				 minlength:5,
                 digits: true
				},
		billingPincode : {
				 minlength:5,
                 digits: true
				}
		
			
		},
        
        // Specify the validation error messages
        messages: {
            name : {
				required : "Please enter name"
			},
			/*email : {
				required : "Please enter email",
			},*/
			
			
           
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
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
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
