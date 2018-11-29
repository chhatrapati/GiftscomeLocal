<?php 
ob_start(); 
require_once 'includes/config.php'; ?>
<?php 
	if(!empty($_POST)){
		try {
			$user_obj = new Cl_User();
			$data = $user_obj->forgetPassword( $_POST );
			if($data)
			{
				echo $success = "PASSWORD_RESET_SUCCESS";
			}
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Forget Passowrd</title>
	<?php require_once('templates/common_css.php');?>
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
		<div class="login-form" style="width: 513px;">
			<div class="form-header">
				<i class="fa fa-user"></i>
			</div>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="forgetpassword-form" method="post"  class="form-register" role="form">
				<div>
					<input id="email" name="email" type="email" class="form-control" placeholder="Email address">  
					<span class="help-block"></span>
				</div>
				<button class="btn btn-block bt-login" type="submit">Reset Password</button>
			</form>
			<div class="form-footer">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 text-center">
						<i class="fa fa-lock"></i>
						<a href="login.php" class="login-link"> Sign In </a>
					
					</div>
					
					<div class="col-xs-6 col-sm-6 col-md-6 text-center ">
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