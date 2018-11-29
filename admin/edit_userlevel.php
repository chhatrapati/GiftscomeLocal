<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
$pid=toInternalId($_GET['id']);// product id
if(isset($_POST['submit']))
{
	$user_levels_name=$_POST['user_levels_name'];
    $user_levels_complete=$_POST['user_levels_complete'];
	$sub_lev1_points=$_POST['sub_lev1_points'];
	$sub_lev2_points=$_POST['sub_lev2_points'];
	$sub_lev3_points=$_POST['sub_lev3_points'];
	$sub_lev4_points=$_POST['sub_lev4_points'];
	$sub_lev5_points=$_POST['sub_lev5_points'];
   
	$pid=toInternalId($_GET['id']);
	move_uploaded_file($tmp_img,"images/$slider_image");
	$sql=mysqli_query($con,"update  user_levels set user_levels_name='$user_levels_name',user_levels_complete='$user_levels_complete',sub_lev1_points='$sub_lev1_points',sub_lev2_points='$sub_lev2_points',sub_lev3_points='$sub_lev3_points',sub_lev4_points='$sub_lev4_points',sub_lev5_points='$sub_lev5_points' where user_levels_id='$pid'");
     $_SESSION['msg']="user_levels Updated Successfully !!";
	 header('location:manage-userlevel.php');
			}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit level | Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
</head>
<body>

<?php require_once('include/header.php');?>
<!--sidebar-menu-->
<?php require_once('include/sidebar.php');?>
<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Level</a> </div>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
        </div>
        <div class="widget-content nopadding">
		<?php if(isset($_POST['submit'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<!--<script type="text/javascript">
											setTimeout(function () {
											var basepath = window.location.protocol + '//' + window.location.hostname;
											var path = basepath + '/admin/manage-level.php';
											window.location.href= path; // the redirect goes here
											},1000); // 5 seconds
						          </script>-->
									</div>
		<?php } ?>
		<?php if(isset($_GET['del'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
		<?php } ?>
				
		<form class="form-horizontal" name="level_manage" id="level_manage" method="post"  enctype="multipart/form-data" >
		<?php 
		$query=mysqli_query($con,"select * from  user_levels where user_levels_id=$pid");
		$cnt=1;
		while($row=mysqli_fetch_array($query))
		{ ?>							
		<div class="control-group">
		<label class="control-label" for="basicinput">Level Name</label>
		<div class="controls">
		<input type="text" name="user_levels_name" id="user_levels_name"  placeholder="Enter level Tile" value="<?php echo htmlentities($row['user_levels_name']);?>" class="span8 tip">
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="basicinput">Level Points</label>
		<div class="controls">
		<input type="text" name="user_levels_complete" id="user_levels_complete" value="<?php echo htmlentities($row['user_levels_complete']);?>"  placeholder="Enter Level points" class="span8 tip" required>
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Sub Level 1 Points</label>
		<div class="controls">
		<input type="text" name="sub_lev1_points" id="sub_lev1_points" value="<?php echo htmlentities($row['sub_lev1_points']);?>"  placeholder="Enter Level points" class="span8 tip" required>
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Sub Level 2 Points</label>
		<div class="controls">
		<input type="text" name="sub_lev2_points" id="sub_lev2_points" value="<?php echo htmlentities($row['sub_lev2_points']);?>"  placeholder="Enter Level points" class="span8 tip" required>
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Sub Level 3 Points</label>
		<div class="controls">
		<input type="text" name="sub_lev3_points" id="sub_lev3_points" value="<?php echo htmlentities($row['sub_lev3_points']);?>"  placeholder="Enter Level points" class="span8 tip" required>
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Sub Level 4 Points</label>
		<div class="controls">
		<input type="text" name="sub_lev4_points" id="sub_lev4_points" value="<?php echo htmlentities($row['sub_lev4_points']);?>"  placeholder="Enter Level points" class="span8 tip" required>
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Sub Level 5 Points</label>
		<div class="controls">
		<input type="text" name="sub_lev5_points" id="sub_lev5_points" value="<?php echo htmlentities($row['sub_lev5_points']);?>"  placeholder="Enter Level points" class="span8 tip" required>
		</div>
		</div>
		
		<?php } ?>

		<div class="control-group">
			<div class="controls">
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
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#level_manage").validate({
    
        // Specify the validation rules
        rules: {
            user_levels_name:{ required : true},
            user_levels_complete:{ required : true,digits:true},
			sub_lev1_points:{ required : true,digits:true},
			sub_lev2_points:{ required : true,digits:true},
			sub_lev3_points:{ required : true,digits:true},
			sub_lev4_points:{ required : true,digits:true},
			sub_lev5_points:{ required : true,digits:true},
			  
        },
        
        // Specify the validation error messages
        messages: {
           
            user_levels_name:{ required :"Please enter level name"},
			user_levels_complete:{ required :"Please enter level points"},
			sub_lev1_points:{ required :"Please enter sub level 1 points"},
			sub_lev3_points:{ required :"Please enter sub level 2 points"},
			sub_lev3_points:{ required :"Please enter sub level 3 points"},
			sub_lev4_points:{ required :"Please enter sub level 4 points"},
			sub_lev5_points:{ required :"Please enter sub level 5 points"}
           
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
</body>
</html>
