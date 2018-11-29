<?php
session_start();
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
	$productname=$_POST['productName'];
	$productImage3=$_FILES["productImage3"]["name"];
$ret=mysqli_query($con,"select productImage3 from products where id='$pid'");
$result=mysqli_fetch_row($ret);
//$pimage=$result['productImage2'];
//dir="productimages";
//unlink($dir.'/'.$pimage);


move_uploaded_file($_FILES["productImage3"]["tmp_name"],"productimages/$productname/".$_FILES["productImage3"]["name"]);
$sql=mysqli_query($con,"update products set productImage3='$productImage3' where id='$pid'");
$_SESSION['msg']="Product Image Updated Successfully !!";

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Product | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Product Image</a> </div>
</div>

<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span11">
	<div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Product Image</h5>
        </div>
		<div class="widget-content nopadding">
		<?php if(isset($_POST['submit'])) {?>
									<div class="alert alert-success" id="successMessage">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									setTimeout(function () {
									var basepath = window.location.protocol + '//' + window.location.hostname;
									var path = basepath + '/admin/manage-products.php';
									window.location.href= path; // the redirect goes here
									},1000); // 5 seconds
									</script>
									</div>
		<?php } ?>
									<form class="form-horizontal row-fluid" name="insertproduct" id="imgupdate" method="post" enctype="multipart/form-data">
									<?php 
									$query=mysqli_query($con,"select productName,productImage3 from products where id='$pid'");
									$cnt=1;
									while($row=mysqli_fetch_array($query)){	?>
									<div class="control-group">
									<label class="control-label" for="basicinput">Product Name</label>
									<div class="controls">
									<input type="text"    name="productName"  readonly value="<?php echo htmlentities($row['productName']);?>" class="span8 tip" required>
									</div>
									</div>
									
									<div class="control-group">
									<label class="control-label" for="basicinput">Current Product Image3</label>
									<div class="controls">
									<img src="productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage3']);?>" width="200" height="100"> 
									</div>
									</div>

									<div class="control-group">
									<label class="control-label" for="basicinput">New Product Image3</label>
									<div class="controls">
									<input type="file" name="productImage3" id="productImage3" value="" class="span8 tip" required>
									</div>
									</div>
								 <?php } ?>

									<div class="control-group">
									<div class="controls">
									<button type="submit" name="submit" class="btn">Update</button>
									</div>
									</div>
								 </form>
		</div>
		</div>
    </div>
	</div>
  </div>
</div>
<?php require_once('include/footer.php');?>
<script src="js/jquery.validate.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#imgupdate").validate({
    
        // Specify the validation rules
        rules: {
			productimage3:{ required : true},
               
        },
        // Specify the validation error messages
        messages: {
			productimage3: {required :"Please upload product image1"},
           
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