<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
	$group=$_POST['group'];
	$sec_name=$_POST['sec_name'];
	$sec_group_url=$_POST['sec_group_url'];
	
$sql=mysqli_query($con,"insert into menu(sec_group,sec_name,sec_group_url)values('$group','$sec_name','$sec_group_url')");
$_SESSION['msg']="Menu Inserted Successfully !!";

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Insert Menu | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Insert Menu</a> </div>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Menu</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(isset($_POST['submit'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									setTimeout(function () {
									   window.location.href= '/admin/manage_menu.php'; // the redirect goes here
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
		
		<form class="form-horizontal"name="insertproduct" id ="addmenu" method="post"  enctype="multipart/form-data" >
									
			<div class="control-group">
		<label class="control-label" for="basicinput">Menu Section</label>
		<div class="controls">
	<select name="group">
	<option>Select Group</option>
	<?php 
		$query_parent = mysqli_query($con,"SELECT DISTINCT sec_group FROM menu");
		while($row = mysqli_fetch_array($query_parent)){ ?>
        <option value="<?php echo $row['sec_group']; ?>"><?php echo $row['sec_group']; ?></option>
        <?php } ?>
	</select>
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="basicinput">Menu Name</label>
		<div class="controls">
		<input type="text" name="sec_name" id="sec_name"  placeholder="Enter Menu Slug" class="span8 tip" required>
		</div>
		</div>

	
           <div class="control-group">
		<label class="control-label" for="basicinput">Menu URL</label>
		<div class="controls">
		<input type="text" name="sec_group_url" id="sec_group_url"  placeholder="Enter Menu URL" class="span8 tip" required>
		</div>
		</div>


		<div class="control-group">
			<div class="controls">
			    <button type="reset" name="reset" class="btn btn-success">Cancel</button>
				<button type="submit" name="submit" class="btn btn-success">Submit</button>
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
 $("#addmenu").validate({
    
        // Specify the validation rules
        rules: {
            menu_name:{ required : true},
            menu_slug:{ required : true},
			menu_url: {required : true},
	
               
        },
        
        // Specify the validation error messages
        messages: {
           
            menu_name:{ required :"Please enter Menu Name"},
			menu_slug:{ required :"Please enter Menu Slug"},
			menu_url: {required :"Please enter Menu URL"}
		
           
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
<?php }?>
