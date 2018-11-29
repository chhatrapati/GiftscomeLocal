<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="application/x-javascript">
		     addEventListener("load", function ()
		      {
			 setTimeout(hideURLbar, 0);
		      }, false);
		function hideURLbar(){window.scrollTo(0, 1);}
	</script>
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="vendor/Login Form/css/style.css" type="text/css" media="all">
	<link rel="stylesheet" href="vendor/Login Form/css/font-awesome.min.css">
	<link href="vendor/Login Form/css/css" rel="stylesheet">
	<?php require_once('templates/common_css.php');?>
	<link href="css/login.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<style>
	.sub-main-w3{
		margin:112px auto;}
	.sub-w3l {
    padding: 0px 0 30px;}
	.right-w3l input[type="submit"]{
		background:#0daacf;}
	.pom-agile {
    padding: 12px 15px;
    border-bottom: 2px solid #0daacf;
    background: #fff;}
    .radio-opt {
    vertical-align: middle;
    margin: 3px 9px 0 16px;}
    .pom-agile:nth-child(1) {
    margin-bottom: 0px;}	
	</style>
</head>
<body>
	<!--header-->
	<?php require_once('templates/header.php');
	if(!empty($_POST))
	{ 
		echo"hello";
		if(isset($_FILES['file']['name']))
			{
			$user_picture = $_FILES['file']['name'];
			}
			$tmp_user_picture = $_FILES['file']['tmp_name'];
			move_uploaded_file($tmp_user_picture,"users-images/$user_picture");
		try {
			$user_obj = new Cl_User();
			@$data = $user_obj->registration( $_POST );
			if($data) print_r($data);
			$success = USER_REGISTRATION_SUCCESS;
			 echo "<script type='text/javascript' language='javascript'>
               window.location = 'login.php?success=1';
            </script>";			
			} catch (Exception $e) { $error = $e->getMessage();	}
	}
	?>	
	<div class="main-content-agile">
		<div class="sub-main-w3">
			<h2>Register here</h2>
			  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="register-form" enctype="multipart/form-data">
				<div class="pom-agile">
					<span class="fa fa-user" aria-hidden="true"></span>
					<input placeholder="Name" name="name" id="name" type="text" required="">
				</div>
				<div class="pom-agile">
					<span class="fa fa-user" aria-hidden="true"></span>
					<input placeholder="Nick name" name="nick_name" id="nick_name" type="text" >
					<span class="help-block"></span>
				</div>
				<div class="pom-agile">
					<span class="fa fa-user" aria-hidden="true"></span>
					<input placeholder="Email "  name="email" id="email" type="email" required="">
					<span class="help-block"></span>
				</div>
				<div class="pom-agile">
					<span class="fa fa-key" aria-hidden="true"></span>
					<input placeholder="Password" name="password" id="password" class="pass" type="password" required="">
					<span class="help-block"></span>
				</div>
				<div class="pom-agile">
					<span class="fa fa-key" aria-hidden="true"></span>
					<input placeholder="Confirm Password" name="confirm_password" id="confirm_password" class="pass" type="password" required="">
				</div>
				<div>
				
					 <div class="row">
					 <div class="gender">
					 	<input type="radio" name="gender" value="Male" checked class="radio-opt">
					 	<span class="form-opt" style="color:white"><i class="fa fa-male"></i> Male </span><span class="help-block"></span></div>
					 <div class="gender"><input type="radio" name="gender" value="Female" class="radio-opt"><span class="form-opt" style="color:white"><i class="fa fa-female"></i> Female </span><span class="help-block"></span>
					</div>
				</div>
				<h6 class="text-center login-txt-center" style="color:white">Alternatively, you can log in using:</h6>
				<div class="row">
			    <div class="col-lg-4"></div> 
			    <div class="col-lg-2">
				<a class="btn btn-default facebook_rnd" href="login-account.php?type=facebook"> <i class="fa fa-facebook modal-icons-rnd"></i></a> 
                </div>
               <div class="col-lg-2">				
				<a class="btn btn-default google_rnd" href="login-account.php?type=google"> <i class="fa fa-google modal-icons-rnd"></i> </a>
               </div>
			    <div class="col-lg-4"></div>
              </div>
				<div class="sub-w3l">
					<div class="sub-agile">
						<input type="checkbox" id="brand1" value="">
						
						</div>
						
						<div class="clear"></div>
					</div>
					<div class="right-w3l">
						<button class="btn btn-block bt-login" type="submit">Sign Up</button>
					</div>
					<div class="form-footer1">
				<div class="row">									
					<div class="col-xs-12 col-sm-12 col-md-12">
						<i class="fa fa-check"></i>
						<a href="login.php" class="login-link" class="footer"> Sign In </a>
					</div>
				</div>
			</div>
				</form>
			</div>
		</div>
		<?php require_once('templates/footer.php'); ?>
	<?php require_once('templates/common_js.php');?>
	<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
<script type="text/javascript" src="js/jquery.validate_new.js"></script>
<script type="text/javascript" src="js/additional-methods_new.js"></script>
    <!--<script src="js/jquery.validate.min.js"></script>-->
    <script src="js/register-new.js"></script>
</body>
</html>