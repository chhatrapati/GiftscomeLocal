<?php
session_start();
require_once 'includes/config.php'; 
include ('function.php');

$email = $_GET['email'];
$token = $_GET['token'];

$userID = UserID($email); 

$verifytoken = verifytoken($userID, $token);
if($_POST)
{
    //print_r($_POST);
	$new_password = $_POST['password'];
	$new_password = md5($new_password);
	$retype_password = $_POST['confirm_password'];
    $retype_password = md5($retype_password);
    $update_password = mysqli_query($con, "UPDATE users SET password = '$new_password' WHERE id = '$userID'");
	if($new_password == $retype_password)
	{
		$update_password = mysqli_query($con, "UPDATE users SET password = '$new_password' WHERE id = '$userID'");
		if($update_password)
		{
				mysqli_query($con, "UPDATE recovery_keys SET valid = 0 WHERE userID = $userID AND token ='$token'");
				$msg = 'Your password has changed successfully. Please login with your new passowrd.';
				$msgclass = 'bg-success';
				echo "<script>window.location.href = 'login.php';</script>";
		}
	}else
	{
		 $msg = "Password doesn't match";
		 $msgclass = 'bg-danger';
	}	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="">
<meta http-equiv="pragma" content="no-cache" />
<meta name="robots" content="all">
<title>Forget Passowrd</title>
<?php require_once('templates/common_css.php');?>
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/login.css" rel="stylesheet">
<style>
 .pw{text-align:center;padding-top:10px;color:skyblue;}
 .form-control {width:100% !important;}
.form-register{   border-bottom: 1px solid rgba(0,0,0,0.1) !important;}
</style>
</head>
<body class="animsition">
<?php require_once('templates/header.php'); ?>
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/login_banner1.jpg);">
		<h2 class="l-text2 t-center" style="margin-left:10%;">Reset Your Password</h2>
</section>
<section class="bgwhite p-t-66 p-b-38">
		<div class="container">
	    <div class="row">
		<div class="login-form">
			<div class="form-header">
				<i class="fa fa-user"></i>
			</div>
			<?php if($verifytoken == 1) { ?>
			<div class="">
			<?php if(isset($msg)) { ?>
					<div class="<?php echo $msgclass; ?>" style="padding:5px;"><?php echo $msg; ?></div>
		    <?php } ?>
			<form action="" role="form" class="form-register" id="register-form" method="post" >
				<div>
					 <input placeholder="Password" name="password" id="password" class="form-control" type="password" required="">
					<span class="help-block"></span>
				</div>
				<div>
					 <input placeholder="Confirm Password" name="confirm_password" id="confirm_password" class="form-control" type="password" required="">
					<span class="help-block"></span>
				</div>
				<button class="btn btn-block bt-login" name="submit" type="submit">Submit</button>
				
			</form>
			</div>
			<?php }else {?>
				<div class="col-lg-12">
						<h1><span>Link is expired or Used</span></h1>
						<p>Opps! The link you have come with is maybe expired or already used. Please make sure that you copied the link correctly or request another token from <a href="/password_new.php">here</a>.</p>
				</div>
				<?php }?>
			
		</div>
		</div>
		</div>
	</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
<script type="text/javascript" src="js/jquery.validate_new.js"></script>
<script type="text/javascript" src="js/additional-methods_new.js"></script>
<script>
 $.validator.addMethod("pwcheck", function(value) {
   return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
       && /[a-z]/.test(value) // has a lowercase letter
       && /\d/.test(value) // has a digit
});
$.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0; 
}, "No space please");
$("#register-form" ).validate({
            rules: {
			password : {
				required : true,
				minlength:6,
				pwcheck: true,
			},
			confirm_password : {
				required : true,
				minlength: 6,
				equalTo: "#password"
			},
			},
			
			messages: {
				
			password : {
				required : "Please enter password",
				pwcheck: "Use alphanumeric format(ex:- qwer123) "
			},
			confirm_password : {
				required : "Please enter confirm password",
				equalTo: "Password and confirm password doesn't match"
			},
			
            },
			errorPlacement : function(error, element) {
			$(element).closest('div').find('.help-block').html(error.html());
		},
		highlight : function(element) {
			$(element).closest('div').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
			 $(element).closest('div').removeClass('has-error').addClass('has-success');
			 $(element).closest('div').find('.help-block').html('');
		},
		
            submitHandler: function(form) {
                form.submit();
            }
        });
</script>
</body>
</html>