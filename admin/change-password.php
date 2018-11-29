<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
if(!empty($_POST))
{
$sql=mysqli_query($con,"SELECT password FROM  admin where password='".md5($_POST['password'])."' && username='".$_SESSION['user']."'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $con=mysqli_query($con,"update admin set password='".md5($_POST['newpassword'])."', updationDate='$currentTime' where username='".$_SESSION['user']."'");
 $_SESSION['msg'] ='Your password changed successfully.';
 ?>
<script type="text/javascript">
setTimeout(function () {
var basepath = window.location.protocol + '//' + window.location.hostname;
var path = basepath + '/admin/change-password.php';
window.location.href= path; // the redirect goes here
},100); // 5 seconds
</script>
<?php 
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Change Password</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
</head>
<body>
<?php require_once('include/header.php');?>
<!--sidebar-menu-->
<?php require_once('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Admin</a> <a href="#" class="current">Change Password</a> </div>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-content nopadding">
		  <?php if(!empty($_SESSION['msg'])){?>
								<div class="alert alert-success alert-block" id="successMessage">
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
								</div>
								<?php } ?>
		  
              <form class="form-horizontal" method="post"  name="password_validate" id="password_validate" novalidate="novalidate">
                 <div class="control-group">
                  <label class="control-label">Old Password</label>
                  <div class="controls">
                    <input type="password" name="password" id="password" />
                  </div>
                </div>
				<div class="control-group">
                  <label class="control-label">New Password</label>
                  <div class="controls">
                    <input type="password" name="newpassword" id="newpassword" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Confirm password</label>
                  <div class="controls">
                    <input type="password" name="confirmpassword" id="confirmpassword" />
                  </div>
                </div>
                <div class="form-actions">
                  <input type="submit" value="Submit" class="btn btn-success">
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
<script src="js/matrix.form_validation.js"></script>
<script>
 $(document).ready(function(){
        setTimeout(function() {
          $('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    });
</script>
</body>
</html>
