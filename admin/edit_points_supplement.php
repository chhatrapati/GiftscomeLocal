<?php
session_start();
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']) && @$_SESSION["csrf_token"] == @$_POST['csrf_token'])
{
	$id=toInternalId($_GET['id']);
	$points_by_login=$_POST['points_by_login'];
	$points_by_register=$_POST['points_by_register'];
	$points_by_social_share=$_POST['points_by_social_share'];
	$points_by_game_won=$_POST['points_by_game_won'];
	$sql=mysqli_query($con, "update user_points_supplement set points_by_login='$points_by_login',points_by_register='$points_by_register',points_by_social_share='$points_by_social_share',points_by_game_won='$points_by_game_won' where id='$id'");
	$_SESSION['msg']="Coins Value Updated !!";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Update Points Supplement | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Points Supplement To Users</a> </div>
  <h1>Update Points Supplement</h1>
</div>
<div class="container-fluid">
  <hr>
   <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Update Points Supplement</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(!empty($_SESSION['msg'])){?>
									<div class="alert alert-success" id="successMessage">
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									setTimeout(function () {
									var basepath = window.location.protocol + '//' + window.location.hostname;
									var path = basepath + '/giftscome/admin/points_supplement.php';
									window.location.href= path; // the redirect goes here
									},1000); // 5 seconds
								</script>
									</div>
		<?php } ?>
		<form class="form-horizontal" name="Update_point_supplement" id="Update_point_supplement" method="post"  enctype="multipart/form-data" >
			<?php
			$id=toInternalId($_GET['id']);
			$query=mysqli_query($con,"select * from user_points_supplement where id='$id'");
			while($row=mysqli_fetch_array($query)) { ?>
			<div class="control-group">
			<label class="control-label" for="basicinput">Points By Login</label>
			<div class="controls">
			<input type="text"   name="points_by_login" id="points_by_login" class="span8 tip" placeholder="Enter Points Value By Login" value="<?php echo  htmlentities($row['points_by_login']);?>"  required>
			</div>
			</div>
			<div class="control-group">
			<label class="control-label" for="basicinput">Points By Reigster</label>
			<div class="controls">
			<input type="text"   name="points_by_register" id="points_by_register" class="span8 tip" placeholder="Enter Points Value By Reigster" value="<?php echo  htmlentities($row['points_by_register']);?>"  required>
			</div>
			</div>
			<div class="control-group">
			<label class="control-label" for="basicinput">Points By Social Share</label>
			<div class="controls">
			<input type="text"   name="points_by_social_share" id="points_by_social_share" class="span8 tip" placeholder="Enter Points Value By Social Share" value="<?php echo  htmlentities($row['points_by_social_share']);?>"  required>
			</div>
			</div>
			<div class="control-group">
			<label class="control-label" for="basicinput">Points By Game Won</label>
			<div class="controls">
			<input type="text"   name="points_by_game_won" id="points_by_game_won" class="span8 tip" placeholder="Enter Points Value By Game Won" value="<?php echo  htmlentities($row['points_by_game_won']);?>"  required>
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
  $("#Update_point_supplement").validate({
        // Specify the validation rules
		rules : { 
		points_by_login: {
            required: true,
			digits: true
            },
		points_by_register: {
            required: true,
			digits: true
            },
		points_by_social_share: {
            required: true,
			digits: true
            },
		points_by_game_won: {
            required: true,
			digits: true
            }
	    
       },
        // Specify the validation error messages
        messages: {
            //points_value: "Please enter points value"
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