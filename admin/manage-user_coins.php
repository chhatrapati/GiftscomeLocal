<?php
session_start();
error_reporting(0);
require_once('include/config.php');
require_once('include/function.php');
require_once('Coins.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(!empty($_POST)){ 
		try {
			$user_obj = new User_Coins();
			$data = $user_obj->update_user_wallet( $_POST );
			//if($data)$success = USER_REGISTRATION_SUCCESS;
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin| Manage Users</title>
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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current"> Manage Users</a> </div>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
  
        <div class="widget-box">
       <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5><a href="manage-users.php">BACK TO MANAGE USERS</a></h5>
          </div>
          <div class="widget-content nopadding">
		  <div class="widget-box">
          <div class="widget-title">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab1">Overview</a></li>
              <li><a data-toggle="tab" href="#tab2">Add Coins</a></li>
              <li><a data-toggle="tab" href="#tab3">Deduct Coins</a></li>
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
             <?php
$id=toInternalId($_GET['id']);
$query=mysqli_query($con,"select name, gift_coins from users where id='$id'");
while($row=mysqli_fetch_array($query))
{
?>
<div class="control-group">
<label class="control-label" for="basicinput">User Name</label>
<div class="controls">
<input type="text"  name="name" id="name" value="<?php echo  htmlentities($row['name']);?>" class="span8 tip" readonly>
</div>
</div>
									
<!--<div class="control-group">
<label class="control-label" for="basicinput">Game Coins</label>
<div class="controls">
<input type="text" placeholder=""  name="" id="" value="<?php //echo  htmlentities($row['game_coins']);?>" class="span8 tip" readonly>
</div>
</div>
-->
<div class="control-group">
<label class="control-label" for="basicinput">Gift Coins</label>
<div class="controls">
<input type="text"  value="<?php echo  htmlentities($row['gift_coins']);?>" class="span8 tip" readonly>
</div>
</div>

<?php } ?>	
            </div>
            <div id="tab2" class="tab-pane">
             <!-- <form class="form-horizontal row-fluid" name="game_coins_update" id="game_coins_update" method="post" enctype="multipart/form-data" >
<?php
//$id=toInternalId($_GET['id']);
//$query=mysqli_query($con,"select name, game_coins, gift_coins from users where id='$id'");
//while($row=mysqli_fetch_array($query))
//{
?>
<div class="control-group">
<label class="control-label" for="basicinput">Enter Game Coins</label>
<div class="controls">
<input type="text" placeholder="Enter Game Coins Value"  name="game_coins" id="game_coins" value="" class="span8 tip" required>
</div>
</div>

<input type="hidden" name="id" value="<?php //echo $id;?>" >
<input type="hidden" name="reason_mode_of_coins" value="by_admin" >
<input type="hidden" name="action_perform" value="add" >
<input type="hidden" placeholder=""  name="previous_game_coins" id="previous_game_coins" value="<?php //echo  $row['game_coins'];?>" class="span8 tip">

<?php //} ?>	

	<div class="control-group">
											<div class="controls"><br/>
												<button type="submit" name="submit" class="btn btn-success btn-large">Update</button>
											</div>
										</div>
									</form><br />-->
									
<form class="form-horizontal row-fluid" name="gift_coins_update" id="gift_coins_update" method="post" enctype="multipart/form-data" >
<?php
$id=toInternalId($_GET['id']);
$query=mysqli_query($con,"select name, gift_coins from users where id='$id'");
while($row=mysqli_fetch_array($query))
{ ?>
<div class="control-group">
<label class="control-label" for="basicinput">Enter Gift Coins</label>
<div class="controls">
<input type="text" placeholder="Enter Gift Coins Value"  name="gift_coins" id="gift_coins" value="" class="span8 tip" required>
</div>
</div>
<input type="hidden" name="id" value="<?php echo $id;?>" >
<input type="hidden" name="reason_mode_of_coins" value="by_admin" >
<input type="hidden" name="action_perform" value="add" >
<input type="hidden" placeholder=""  name="previous_gift_coins" id="previous_gift_coins" value="<?php echo  $row['gift_coins'];?>" class="span8 tip">

<?php } ?>	

	<div class="control-group">
											<div class="controls"><br/>
												<button type="submit" name="submit" class="btn btn-success btn-large">Update</button>
											</div>
										</div>
</form>
            </div>
            <div id="tab3" class="tab-pane">
             <!-- <form class="form-horizontal row-fluid" name="game_coins_deduct" id="game_coins_deduct" method="post" enctype="multipart/form-data" >
<?php
// $id=toInternalId($_GET['id']);
// $query=mysqli_query($con,"select name, game_coins, gift_coins from users where id='$id'");
// while($row=mysqli_fetch_array($query))
// {
?>
<div class="control-group">
<label class="control-label" for="basicinput">Enter Game Coins</label>
<div class="controls">
<input type="text" placeholder="Enter Game Coins Value"  name="game_coins" id="game_coins" value="" class="span8 tip" required>
</div>
</div>

<input type="hidden" name="id" value="<?php //echo $id;?>" >
<input type="hidden" name="reason_mode_of_coins" value="by_admin" >
<input type="hidden" name="action_perform" value="deduct" >
<input type="hidden" placeholder=""  name="previous_game_coins" id="previous_game_coins" value="<?php //echo  $row['game_coins'];?>" class="span8 tip">
<?php //} ?>	

	<div class="control-group">
											<div class="controls"><br/>
												<button type="submit" name="submit" class="btn btn-success btn-large">Update</button>
											</div>
										</div>
									</form><br />
									-->
<form class="form-horizontal row-fluid" name="gift_coins_deduct" id="gift_coins_deduct" method="post" enctype="multipart/form-data" >
<?php
$id=toInternalId($_GET['id']);
$query=mysqli_query($con,"select name, gift_coins from users where id='$id'");
while($row=mysqli_fetch_array($query))
{
?>


<div class="control-group">
<label class="control-label" for="basicinput">Enter Gift Coins</label>
<div class="controls">
<input type="text" placeholder="Enter Gift Coins Value"  name="gift_coins" id="gift_coins" value="" class="span8 tip" required>
</div>
</div>
<input type="hidden" name="id" value="<?php echo $id;?>" >
<input type="hidden" name="reason_mode_of_coins" value="by_admin" >
<input type="hidden" name="action_perform" value="deduct" >
<input type="hidden" placeholder=""  name="previous_gift_coins" id="previous_gift_coins" value="<?php echo  $row['gift_coins'];?>" class="span8 tip">
<?php } ?>	

											<div class="control-group">
											<div class="controls"><br/>
												<button type="submit" name="submit" class="btn btn-success btn-large">Update</button>
											</div>
										</div>
</form>
									<?php if(isset($_POST['submit'])){?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									 setTimeout(function () {
									   window.location.href= '/admin/manage-users.php'; // the redirect goes here
									},1000); // 5 seconds
									</script>
									</div>
									<?php } ?>
            </div>
          </div>
        </div>
           
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
   /* $("#game_coins_update").validate({
        rules : {
        // Specify the validation rules
		game_coins: {
            required: true,
			digits: true
            }
		
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
    });*/
	
	 $("#gift_coins_update").validate({
        rules : {
        // Specify the validation rules
		
	    gift_coins: {
            required: true,
			digits: true
            }
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
	
	/*$("#game_coins_deduct").validate({
        rules : {
        // Specify the validation rules
		
	    game_coins: {
            required: true,
			digits: true
            }
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
    });*/
	
	$("#gift_coins_deduct").validate({
        rules : {
        // Specify the validation rules
		
	    gift_coins: {
            required: true,
			digits: true
            }
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
</body>
</html>
<?php }?>
