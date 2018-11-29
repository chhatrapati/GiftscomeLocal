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
	$gift_coins=$_POST['gift_coins'];
	//$user_type=$_POST['user_type'];
	//$game_coins=$_POST['game_coins'];
	$sql=mysqli_query($con, "update coins_transfer_value set gift_coins='$gift_coins' where id='$id'");
	$_SESSION['msg']="Coins Value Updated !!";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Update Coins Transfer Limits | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Coins Transfer Limits</a> </div>
</div>
<div class="container-fluid">
  <hr>
   <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Update Coins Transfer Value</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(isset($_POST['submit'])){?>
									<div class="alert alert-success" id="successMessage">
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									setTimeout(function () {
									var basepath = window.location.protocol + '//' + window.location.hostname;
									var path = basepath + '/admin/transfer_coins_value.php';
									window.location.href= path; // the redirect goes here
									},1000); // 5 seconds
								   </script>
								   
									</div>
		<?php } ?>
		
		<form class="form-horizontal" name="transfer_coins" id="transfer_coins" method="post"  enctype="multipart/form-data" >
			<?php
			$id=toInternalId($_GET['id']);
			$query=mysqli_query($con,"select * from coins_transfer_value where id='$id'");
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
			<label class="control-label" for="basicinput">Gift Coins</label>
			<div class="controls">
			<input type="text" placeholder="Enter Gift Coins Value" name="gift_coins" id="gift_coins" value="<?php echo  htmlentities($row['gift_coins']);?>" class="span8 tip" required>
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
 
  $("#transfer_coins").validate({
    
        // Specify the validation rules
		rules : { 
		 user_type: {
            required: true
            },
		gift_coins: {
            required: true,
			digits: true
            }
       },
        // Specify the validation error messages
        messages: {
            user_type: "Please select user type"
			
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
