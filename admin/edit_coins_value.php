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
	$id=toInternalId($_GET['id']);
	$coins_tag=$_POST['coins_tag'];
	$coins_value=$_POST['coins_value'];
	$sql=mysqli_query($con, "update coins_setting set coins_tag='$coins_tag',coins_value='$coins_value' where id='$id'");
	$_SESSION['msg']="Coins Value Updated !!";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit Coins Value | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Coins Value</a> </div>
  <h1>Edit Coins Value</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Coins Value</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(isset($_POST['submit'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									setTimeout(function () {
									var basepath = window.location.protocol + '//' + window.location.hostname;
									var path = basepath + '/admin/add_coins_value.php';
									window.location.href= path; // the redirect goes here
									},1000); // 5 seconds
								</script>
								
									</div>
		<?php } ?>
				
		<form class="form-horizontal"  name="coins_setting" id="coins_setting"  method="post"  enctype="multipart/form-data" >
		<?php
		$id=toInternalId($_GET['id']);
		$query=mysqli_query($con,"select * from coins_setting where id='$id'");
		while($row=mysqli_fetch_array($query)) { ?>							
		<div class="control-group">
		<label class="control-label" for="basicinput">Coins Tag</label>
		<div class="controls">
		<input type="text" placeholder="Enter category Name"  name="coins_tag" id="coins_tag" value="<?php echo  htmlentities($row['coins_tag']);?>" class="span8 tip" required>
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="basicinput">Coins Value</label>
		<div class="controls">
		<input type="text" placeholder="Enter price"  name="coins_value" id="coins_value" value="<?php echo  htmlentities($row['coins_value']);?>" class="span8 tip" required>
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
<script src="js/matrix.js"></script>
<script src="js/jquery.validate.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
  $("#coins_setting").validate({
    
        // Specify the validation rules
		rules : {
			coins_tag: {
            required: true
            },
	    coins_value: {
            required: true,
			digits: true
            },
		},
        // Specify the validation error messages
        messages: {
            coins_tag: "Please enter coins tag",
            //coins_value: "Please enter coins value",
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
