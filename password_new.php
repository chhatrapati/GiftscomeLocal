<?php 
require_once 'includes/config.php'; 
include ('function.php');
if(isset($_POST['submit']) && @$_SESSION["csrf_token"] == @$_POST['csrf_token'])
{
	$email = $_POST['email'];
	$email = mysqli_real_escape_string($con, $email);
	
	if(checkUser($email) == "true")
	{
	     $userID = UserID($email);
		 $token = generateRandomString();
		//echo "INSERT INTO recovery_keys (userID, token) VALUES ('$userID','$token')";
		$query = mysqli_query($con,"INSERT INTO recovery_keys (userID, token) VALUES ('$userID','$token')");
		
		if($query)
		{
			 $send_mail = send_mail($email, $token);
			if($send_mail === 'success')
			{
				 $_SESSION['msg']="A mail with recovery link has sent to your email.";
				 $cls = "success";
			}
			else
			{
				$_SESSION['msg']="There is something wrong.";
				$cls = "error";
			}
		}
		else
		{
				$_SESSION['msg']="There is something wrong";
				$cls = "error";
		}
	}
	else
	{
		$_SESSION['msg']="This email doesn't exist in our database";
		$cls = "error";
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
<style>
.success,.normal {color: #3c763d; display: block;padding-top: 10px;text-align: center;}
.error {color: red; display: block;padding-top: 10px;text-align: center;}
}
</style>
  </head>
<body class="animsition">
<?php require_once('templates/header.php'); ?>
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/login_banner1.jpg);">
		<h2 class="l-text2 t-center">Forget Passowrd</h2>
	</section>
<section class="bgwhite p-t-66 p-b-38">
		<div class="container">
	    <div class="row">
		<div class="login-form">
			<div class="form-header">
				<i class="fa fa-user"></i>
			</div>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="forgetpassword-form" method="post"  class="form-register" role="form">
				<div>
					 <input class="form-control" name="email" id="email" type="email" placeholder="Enter your email here..." required> 
					<span class="help-block"></span>
					 <span id="email-availability-status"></span>
				</div>
				<?php $_SESSION["csrf_token"] = md5(rand(0,10000000)).time(); ?>
			<input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION["csrf_token"]);?>">
				<button class="btn btn-block bt-login" name="submit" type="submit">Reset Password</button>
				 <?php if(!empty($_SESSION['msg'])){?>
				 <span class="<?php echo $cls;?>" id="successMessage"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></span>
				 <?php } ?>
			</form>
			<div class="form-footer">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<i class="fa fa-lock"></i>
						<a href="login.php" class="login-link"> Sign In </a>
					
					</div>
					
					<div class="col-xs-6 col-sm-6 col-md-6">
						<i class="fa fa-check"></i>
						<a href="register.php" class="login-link"> Sign Up </a>
					</div>
				</div>
			</div>
		</div>
	</div></div>
	</section>
	<?php require_once('templates/footer.php');?>
	<?php require_once('templates/common_js.php');?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/forgetpassword.js"></script>
 <script>
 $(document).ready(function(){
        setTimeout(function() {
          $('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    });
</script>
  </body>
</html>