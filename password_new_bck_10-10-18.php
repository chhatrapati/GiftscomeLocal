<?php 
require_once 'includes/config.php'; 
include ('function.php');
if(isset($_POST['submit']))
{
	$email = $_POST['uemaill'];
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
				 $msg = 'A mail with recovery link has sent to your email.';
				 $msgclass = 'bg-success';
			}else{
				$msg = 'There is something wrong. 1';
				$msgclass = 'bg-danger';
			}
		}else
		{
				$msg = 'There is something wrong. 2';
				 $msgclass = 'bg-danger';
		}
	}else
	{
		$msg = "This email doesn't exist in our database.";
		$msgclass = 'bg-danger';
	}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Foreget Passowrd</title>
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<?php require_once('templates/common_css.php');?>
<!--===============================================================================================-->
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
   
  </head>
<body class="animsition">
<?php require_once('templates/header.php'); ?>
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/login_banner1.jpg);">
		<h2 class="l-text2 t-center">
			Login
		</h2>
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
					 <input class="form-control" name="uemaill" type="email" placeholder="Enter your email here..." required> 
					<span class="help-block"></span>
				</div>
				<button class="btn btn-block bt-login" name="submit" type="submit">Reset Password</button>
				 <?php if (count($_POST)>0) echo "Email sent successfully!"; ?>
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
	<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
	</script>

	<script src="js/main.js"></script>
	<!-- /container -->
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/forgetpassword.js"></script>
  </body>
</html>