<?php
session_start();
include('include/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Assign Menu to user | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Add Assign Menu to Admin</a> </div>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Assign Menu to Admin</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(!empty($_SESSION['msg'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									setTimeout(function () {
									   window.location.href= '/admin/role_assign.php'; // the redirect goes here
									},1000); // 5 seconds
									</script>
									</div>
		<?php } ?>
		<?php if(isset($_GET['del'])){?>
									<div class="alert alert-error" id="successMessage">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
		<?php } ?>
		<form class="form-horizontal"name="insertproduct" id ="addproduct" method="post"  enctype="multipart/form-data" >		
		<div class="control-group">
		<label class="control-label" for="basicinput">Admin</label>
		<div class="controls">
		<select name="category" id="user" class="span8 tip">
		<option value="">Select Admin</option> 
		<?php $query=mysqli_query($con,"select * from admin WHERE role ='manager'");
		while($row=mysqli_fetch_array($query))
		{?>
		<option value="<?php echo $row['id'];?>"><?php echo $row['username'];?></option>
		<?php } ?>
		</select>
		</div>
		</div>
		<div class="control-group">
		<div id="display" style="margin-left: 144px;width: 61%;"></div>
		</div>
		<div class="control-group">
			<div class="controls">
			<input type='reset' class="btn btn-success" name='reset' value='Reset'>
		  <input type='submit' class="btn btn-success" name='submit' value='Submit'>
			</div>
		</div>
	 <?php
    //$menuid = implode(',', $_POST['menu_id']);
    if (isset($_POST['submit'])) {
        $checkbox1 = $_POST['menu_check'];
        $chk = "";
        $user_id = $_POST['category'];
        $query = "delete from role where user_id='" . $user_id . "'";
        mysqli_query($con, $query) or die(mysqli_error($conn));
        foreach ($checkbox1 as $key=>$chk1) {
            $query = "INSERT INTO role(user_id,menu_id) VALUES ('$user_id','$chk1')";
            mysqli_query($con, $query) or die(mysqli_error($con));

            //echo "Complete";
            //$sql=mysqli_query($conn,"UPDATE `role` SET `menu_id`='$chk1' WHERE `user_id`='$user_id'");
        }
    }
    ?>
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
 $("#addproduct").validate({
        // Specify the validation rules
        rules: {
            category:{ required : true},  
        },
        // Specify the validation error messages
        messages: {
            category:  {
				required : "Please select Admin name"
			},
            productName:{ required :"Please enter product name"}
           
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
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#user').change(function () {
            var value = ($(this).val());
            //alert(value);
$.ajax({
type: "POST",
url: "script.php",
 data: {
value: value
               },
 success: function (result) {
                   $("#display").html(result).show();
               }
});
        });
    });
</script>
</body>
</html>