<?php
session_start();
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
$game_name_def = "Game#000";
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']) && @$_SESSION["csrf_token"] == @$_POST['csrf_token'])
{
	$id=toInternalId($_GET['id']);
	$game_name=$_POST['game_name'];
	if($game_name=='')
	{
		$game_name = $game_name_def.$id;
	}
	$game_start_time=$_POST['game_start_time'];
	$game_duration=$_POST['game_duration'];
	$sql=mysqli_query($con, "update tbl_game set game_name='$game_name',game_start_time='$game_start_time',game_duration='$game_duration' where id='$id'");
	$_SESSION['msg']="Record Updated !!";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Update Game Setup Process | Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />
</head>
<body>

<?php require_once('include/header.php');?>
<!--sidebar-menu-->
<?php require_once('include/sidebar.php');?>
<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Update Game Setup Process</a> </div>
  
</div>
<div class="container-fluid">
  <hr>
   <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
	 <?php if(!empty($_SESSION['msg'])){?>
									<div class="alert alert-success" id="successMessage">
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									setTimeout(function () {
									var basepath = window.location.protocol + '//' + window.location.hostname;
									var path = basepath + '/giftscome/admin/game_setup.php';
									window.location.href= path; // the redirect goes here
									},1000); // 5 seconds
								</script>
									</div>
		<?php } ?>
        <div class="widget-title panel-heading"> <span class="icon"> <i class="icon-align-justify"></i> </span>
        <h5>Update Game Setup Process</h5>
        </div>
        <div class="widget-content nopadding">
		<form class="form-horizontal" name="game_start_update" id="game_start_update" method="post"  enctype="multipart/form-data" >
		<?php 
			$id=toInternalId($_GET['id']);
			$query_new=mysqli_query($con,"select * from tbl_game where id='$id'");
			while($res=mysqli_fetch_array($query_new)) {
			?>			
		
		<div class="control-group">	
		<label class="control-label">Game Name</label>
		<div class="controls">
	    <input size="16" type="text" name="game_name" id="game_name" class="" value="<?php if($res['game_name']!=''){ echo $res['game_name']; } else {echo $game_name_def.$id; } ?>" placeholder="Enter Game Name">
	    </div>
	    </div>
		
		<div class="control-group">
		<label class="control-label">Game Starting Time</label>
		<div class="controls">
	    <input size="16" type="text" value="<?php echo $res['game_start_time'];?>" name="game_start_time" id="game_start_time" class="form_datetime" placeholder="Select Game Starting Time" required>
	    </div>
	    </div>
		<div class="control-group">
		<label class="control-label" for="basicinput">Duration Of Game <br/> (In Minutes)</label>
		<div class="controls">
		<input type="number" value="<?php echo $res['game_duration'];?>" name="game_duration" id="game_duration" class="" placeholder="Enter Duration Of Game" required>
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
<?php require_once('include/common_js.php');?>
<script src="js/jquery.validate.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 
  $("#game_start_update").validate({
    
        // Specify the validation rules
		rules : {
		 game_start_time: {
            required: true
            },
		game_duration: {
            required: true,
			digits: true
	    },
		
		
       },
        // Specify the validation error messages
        messages: {
            game_start_time: "Please enter game starting time",
			game_duration: {required: "Please enter duration of game"}
			
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
<script src="js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii",
        showMeridian: true,
        autoclose: true,
        todayBtn: true,
		startDate: new Date()
    });
</script>       
</body>
</html>
<?php }?>
