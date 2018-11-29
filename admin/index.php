<?php
session_start();
include_once 'include/config.php';
if(isset($_SESSION['user'])!="")
{
	header("Location: dashboard.php");
}
if(isset($_POST['submit']))
{
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$res=mysqli_query($con, "SELECT * FROM admin WHERE username='$username'");
	$row=mysqli_fetch_array($res);
	
	if($row['password']==md5($password))
	{
		$_SESSION['id'] = $row['id'];
		$_SESSION['user'] = $row['username'];
		$_SESSION['role'] = $row['role'];
		
		header("Location: dashboard.php");
	}
	if($_SESSION['role']=='manager'){
 header('location:manager.php');
}
	else
	{
	$err = "<p style='color: red'>Wrong Username or Password</p>";
		?>
        <?php
	}
}
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
        <title>Gifts Come Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/matrix-login.css" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/custom.css" />
    </head>
    <body>
        <div id="loginbox">
            <form id="loginform" class="form-vertical" method="post" action="">
				 <div class="control-group normal_text"> <h3><img src="img/logo.png" alt="Logo" /></h3></div>
				 <?php if (@$err !=''){?><div class="alert alert-error alert-block"><?php echo @$err;?></div><?php }?>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="fa fa-user"> </i></span><input type="text" id="inputEmail" name="username" placeholder="Username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="fa fa-key"></i></span><input type="password" id="inputPassword" name="password" placeholder="Password" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <!--<span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>-->
                    <span class="pull-right"><button type="submit" name="submit" class="btn btn-success" /> Login </button></span>
                </div>
            </form>
            <!--<form id="recoverform" action="#" class="form-vertical">
				<p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><a class="btn btn-info"/>Reecover</a></span>
                </div>
            </form>-->
        </div>
        <script src="js/jquery.min.js"></script>  
        <script src="js/matrix.login.js"></script> 
    </body>
</html>