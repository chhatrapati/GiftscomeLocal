 <?php
session_start();
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['name'])==0)
	{	
header('location:user_login.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

echo $user_id=$_SESSION['id'];
$name = $_SESSION['name'];

if(!empty($_POST))
{
$sql=mysqli_query($con,"SELECT password FROM users where password='".md5(@$_POST['password'])."' && name='".$name."'");
$num=mysqli_fetch_array($sql);
//echo $num;

if($num>0)
{
$query=mysqli_query($con,"update users set password='".md5($_POST['newpassword'])."', updationDate='$currentTime' where name='".$name."'");
$_SESSION['msg']="Password Changed Successfully !!";
}
else
{
$_SESSION['msg']="Old Password not match !!";
}
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
<?php require_once('include/user_header.php');?>
<!--sidebar-menu-->
<?php require_once('include/userlogin_sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">User</a> <a href="#" class="current">Change Password</a> </div>
    <h1>User Change Password</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>User Change Password</h5>
          </div>
          <div class="widget-content nopadding">
		  <?php if(!empty($_POST)) { ?>
		 <div class="alert alert-success alert-block" id="successMessage">Password Changed Successfully	</div>
		  <?php } ?>
              <form class="form-horizontal" method="post" action="#" name="password_validate_new" id="password_validate_new" novalidate="novalidate">
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
                  <input type="submit" name="submit" value="Submit" class="btn btn-success">
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
<script>

$(document).ready(function(){
	
	$("#password_validate_new").validate({
		submitHandler : function(e) {
		    $(form).submit();
		},
		rules:{
			password : {
				required : true,
				remote: {
					url: "check-user-password.php",
					type: "post",
					data: {
						password: function() {
							return $( "#password" ).val();
						}
					}
				}
			},
			newpassword:{
				required: true,
				minlength:6,
				maxlength:20
			},
			confirmpassword:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#newpassword"
			}
		},
		messages: {
    password: {required: "Please enter old password",
			remote: "Old password does not match."}
    },
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
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
