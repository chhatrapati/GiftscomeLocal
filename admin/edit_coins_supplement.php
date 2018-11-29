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


if(isset($_POST['submit']) && @$_SESSION["csrf_token"] == @$_POST['csrf_token'])
{
	$id=toInternalId($_GET['id']);
	$gift_coins_value=$_POST['gift_coins_value'];
	//$user_type=$_POST['user_type'];
	$minimum_gift_coins_value=$_POST['minimum_gift_coins_value'];
	$daily_click_button_limit=$_POST['daily_click_button_limit'];
	
	$sql=mysqli_query($con, "update coins_supplement set gift_coins_value='$gift_coins_value',minimum_gift_coins_value='$minimum_gift_coins_value',daily_click_button_limit='$daily_click_button_limit' where id='$id'");
	$_SESSION['msg']="Coins Value Updated !!";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Update Coins Supplement On Click | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Coins Supplement On Click</a> </div>
  <h1>Update Coins Supplement On Click</h1>
</div>
<div class="container-fluid">
  <hr>
   <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Update Coins Supplement On Click</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(!empty($_SESSION['msg'])){?>
									<div class="alert alert-success" id="successMessage">
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									setTimeout(function () {
									var basepath = window.location.protocol + '//' + window.location.hostname;
									var path = basepath + '/admin/coins_supplement.php';
									window.location.href= path; // the redirect goes here
									},1000); // 5 seconds
								</script>
									</div>
		<?php } ?>
		
		<form class="form-horizontal" name="Update_coins_supplement" id="Update_coins_supplement" method="post"  enctype="multipart/form-data" >
			<?php
			$id=toInternalId($_GET['id']);
			$query=mysqli_query($con,"select * from coins_supplement where id='$id'");
			while($row=mysqli_fetch_array($query)) { ?>							
					<!--<div class="control-group">
			<label class="control-label" for="basicinput">User type</label>
			<div class="controls">
			<select name="user_type" id="user_type">
			<option value=""> Select User Type</option>
			<option value="normal" <?php if($row['user_type'] =='normal') { ?> selected <?php }?>/>Normal</option>
			<option value="vip" <?php if($row['user_type'] =='vip') { ?> selected <?php }?>/>Vip</option>
			</select>
			</div>
			</div>-->

			<div class="control-group">
			<label class="control-label" for="basicinput">Gift 	Coins Value</label>
			<div class="controls">
			<input type="text" placeholder="Enter Gift Coins Value" name="gift_coins_value" id="gift_coins_value" value="<?php echo  htmlentities($row['gift_coins_value']);?>" class="span8 tip" required>
			</div>
			</div>

			<div class="control-group">
			<label class="control-label" for="basicinput">Minimum No Of Gift Coins Limit</label>
			<div class="controls">
			<input type="text" placeholder="Enter Minimum No Of Gift Coins Limit" name="minimum_gift_coins_value" id="minimum_gift_coins_value" value="<?php echo  htmlentities($row['minimum_gift_coins_value']);?>" class="span8 tip" required>
			</div>
			</div>
			
			<div class="control-group">
			<label class="control-label" for="basicinput">Number Of Request Time (In a day)</label>
			<div class="controls">
			<input type="text" placeholder="Enter Daily Click Time limit Of Button" name="daily_click_button_limit" id="daily_click_button_limit" value="<?php echo  htmlentities($row['daily_click_button_limit']);?>" class="span8 tip" required>
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
<script src="js/matrix.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 
  $("#Update_coins_supplement").validate({
    
        // Specify the validation rules
		rules : { 
		
		gift_coins_value: {
            required: true,
			digits: true
            },
	    minimum_gift_coins_value: {
            required: true,
			digits: true
            },
	   daily_click_button_limit: {
            required: true,
			digits: true
            }
       },
        // Specify the validation error messages
        messages: {
            /*user_type: "Please select user type"*/
			
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
