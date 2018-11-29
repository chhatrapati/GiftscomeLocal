<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
	
if(isset($_POST['submit']) && @$_SESSION["csrf_token"] == @$_POST['csrf_token'])
{
	$site_title=$_POST['site_title'];
	$site_tagline=$_POST['site_tagline'];
	//$site_base_url=$_POST['site_base_url'];
	$site_email=$_POST['site_email'];
	$site_contact_no=$_POST['site_contact_no'];
	$discount_vip=$_POST['discount_vip'];
	$gift_exchange_rate=$_POST['gift_exchange_rate'];
	$paypal_id=$_POST['paypal_id'];
	$paypal_url=$_POST['paypal_url'];
	$paypal_success_url=$_POST['paypal_success_url'];
	$paypal_cancel_url=$_POST['paypal_cancel_url'];
		
$sql=mysqli_query($con,"update  general_settings set site_title='$site_title',site_tagline='$site_tagline',site_email='$site_email',site_contact_no='$site_contact_no',discount_vip='$discount_vip',gift_exchange_rate='$gift_exchange_rate',paypal_id='$paypal_id',paypal_url='$paypal_url',paypal_success_url='$paypal_success_url',paypal_cancel_url='$paypal_cancel_url' ");
$_SESSION['msg']="Records Updated Successfully !!";

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>General Settings | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">General Settings</a> </div>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span10">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>General Settings</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(!empty($_SESSION['msg'])){?>
									<div class="alert alert-success" id="successMessage">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									 setTimeout(function () {
									},1000); // 5 seconds
									</script>
									</div>
		<?php } ?>
        <form class="form-horizontal" name="generl-settings" id="generl-settings" method="post" enctype="multipart/form-data">
		<?php 
		$query=mysqli_query($con,"select * from general_settings");
		$cnt=1;
		while($row=mysqli_fetch_array($query)) {?>
			<div class="control-group">
			<label class="control-label" for="basicinput">Site Title</label>
			<div class="controls">
			<input type="text"  name="site_title" id="site_title"  placeholder="Enter Site Title" value="<?php echo htmlentities($row['site_title']);?>" class="span11" required>
			</div>
			</div>

			<!--<div class="control-group">
			<label class="control-label" for="basicinput">Site Url</label>
			<div class="controls">
			<input type="text"    name="site_base_url" id="site_base_url"  placeholder="Enter Site Url" value="<?php //echo htmlentities($row['site_base_url']);?>" class="span11" required>
			</div>
			</div>-->

			<div class="control-group">
			<label class="control-label" for="basicinput">Tagline</label>
			<div class="controls">
			<input type="text"    name="site_tagline" id="site_tagline"  placeholder="Enter Tagline" value="<?php echo htmlentities($row['site_tagline']);?>" class="span11" required>
			</div>
			</div>
			<div class="control-group">
			<label class="control-label" for="basicinput">Email Address</label>
			<div class="controls">
			<input type="text"    name="site_email" id="site_email"  placeholder="Enter Email Address" value="<?php echo htmlentities($row['site_email']);?>"  class="span11" required>
			</div>
			</div>

			<div class="control-group">
			<label class="control-label" for="basicinput">Contact No.</label>
			<div class="controls">
			<input type="text"    name="site_contact_no" id="site_contact_no"  placeholder="Enter Contact No." value="<?php echo htmlentities($row['site_contact_no']);?>" class="span11" required>
			</div>
			</div>
			
			<div class="control-group">
			<label class="control-label" for="basicinput">Gift Coins Exchange Rate ($1 equal to coins)</label>
			<div class="controls">
			<input type="text"    name="gift_exchange_rate" id="gift_exchange_rate"  placeholder="Enter Gift Coins Exchange Rate" value="<?php echo htmlentities($row['gift_exchange_rate']);?>" class="span11" required>
			</div>
			</div>

			<div class="control-group">
			<label class="control-label" for="basicinput">Discount On Products To Vip Users (%)</label>
			<div class="controls">
			<input type="text"    name="discount_vip" id="discount_vip"  placeholder="Enter Discount On Products To Vip Users" value="<?php echo htmlentities($row['discount_vip']);?>" class="span11" required>
			</div>
			</div>
			
			<div class="control-group">
			<label class="control-label" for="basicinput">Paypal Account Id</label>
			<div class="controls">
			<input type="text"    name="paypal_id" id="paypal_id"  placeholder="Enter Paypal Account Id." value="<?php echo htmlentities($row['paypal_id']);?>" class="span11" required>
			</div>
			</div>
			
			<div class="control-group">
			<label class="control-label" for="basicinput">Paypal Account Url</label>
			<div class="controls">
			<input type="text"    name="paypal_url" id="paypal_url"  placeholder="Enter Paypal Account Url." value="<?php echo htmlentities($row['paypal_url']);?>" class="span11" required>
			</div>
			</div>
			
			<div class="control-group">
			<label class="control-label" for="basicinput">Paypal Return Url</label>
			<div class="controls">
			<input type="text"    name="paypal_success_url" id="paypal_success_url"  placeholder="Enter Paypal Return Url." value="<?php echo htmlentities($row['paypal_success_url']);?>" class="span11" required>
			</div>
			</div>
			
			<div class="control-group">
			<label class="control-label" for="basicinput">Paypal Cancel Url</label>
			<div class="controls">
			<input type="text"    name="paypal_cancel_url" id="paypal_cancel_url"  placeholder="Enter Paypal Cancel Url." value="<?php echo htmlentities($row['paypal_cancel_url']);?>" class="span11" required>
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
  
</div></div>
<!--Footer-part-->
<?php require_once('include/footer.php');?>
<!--end-Footer-part--> 
<?php require_once('include/common_js.php');?>
<script>
 $(document).ready(function(){
        setTimeout(function() {
          $('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    });
</script>
<script src="js/jquery.validate.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
    $("#generl-settings").validate({
    
        // Specify the validation rules
        rules : {
			site_title : {
				required : true
			},
			site_email : {
				required : true,
				email: true,
				},
		  site_base_url : {
				required : true
				//url: true
			},
		
		site_tagline : {
				required : true
			},
		
		site_contact_no : {
				required : true,
				 minlength:10,
                 maxlength:10,
				digits: true
			},
		gift_exchange_rate : {
				required : true,
				 minlength:1,
                 maxlength:10,
				digits: true
			},
		paypal_id : {
				required : true
			},
		paypal_url : {
				required : true
			},
		paypal_success_url : {
				required : true
			},
		paypal_cancel_url : {
				required : true
			},
		
		},
        
        // Specify the validation error messages
        messages: {
            site_title : {
				required : "Please enter site title"
			},
			site_email : {
				required : "Please enter email",
			},
			site_base_url : {
				required : "Please enter site base url",
			},
			site_tagline : {
				required : "Please enter site tagline",
			},
			site_contact_no : {
				required : "Please enter site contact no.",
			},
			gift_exchange_rate : {
				required : "Please enter gift coins exchange rate.",
			},
			paypal_id : {
				required : "Please enter paypal id.",
			},
			paypal_url : {
				required : "Please enter paypal url.",
			},
			paypal_success_url : {
				required : "Please enter gift paypal success url.",
			},
			paypal_cancel_url : {
				required : "Please enter paypal cancel url.",
			},
           
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
</body>
</html>
<?php }?>
