<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']) && @$_SESSION["csrf_token"] == @$_POST['csrf_token'])
{
	$category=$_POST['category'];
	//$subcat=$_POST['subcategory'];
	$productname=$_POST['productName'];
	$productcompany=$_POST['productCompany'];
	$productprice=$_POST['productprice'];
	$productpricebd=$_POST['productpricebd'];
	$productdescription=$_POST['productDescription'];
	//$productscharge=$_POST['productShippingcharge'];
	$productavailability=$_POST['productAvailability'];
	$productimage1=$_FILES["productimage1"]["name"];
	$productimage2=$_FILES["productimage2"]["name"];
	$productimage3=$_FILES["productimage3"]["name"];
	$dir="productimages/$productname";
	mkdir($dir);// directory creation for product images
	move_uploaded_file($_FILES["productimage1"]["tmp_name"],"productimages/$productname/".$_FILES["productimage1"]["name"]);
	move_uploaded_file($_FILES["productimage2"]["tmp_name"],"productimages/$productname/".$_FILES["productimage2"]["name"]);
	move_uploaded_file($_FILES["productimage3"]["tmp_name"],"productimages/$productname/".$_FILES["productimage3"]["name"]);
$sql=mysqli_query($con,"insert into products(category,productName,productCompany,productPrice,productDescription,productAvailability,productImage1,productImage2,productImage3,productPriceBeforeDiscount) values('$category','$productname','$productcompany','$productprice','$productdescription','$productavailability','$productimage1','$productimage2','$productimage3','$productpricebd')");
$_SESSION['msg']="Product Inserted Successfully !!";

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Insert Product | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Insert Product</a> </div>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Product</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(!empty($_SESSION['msg'])){?>
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
		<?php if(isset($_GET['del'])){?>
									<div class="alert alert-error" id="successMessage">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
		<?php } ?>
		
		<form class="form-horizontal"name="insertproduct" id ="addproduct" method="post"  enctype="multipart/form-data" >
									
		<div class="control-group">
		<label class="control-label" for="basicinput">Category</label>
		<div class="controls">
		<select name="category" id="category" class="span8 tip" onChange="getSubcat(this.value);"  required>
		<option value="">Select Category</option> 
		<?php $query=mysqli_query($con,"select * from category");
		while($row=mysqli_fetch_array($query))
		{?>
		<option value="<?php echo $row['id'];?>"><?php echo $row['categoryName'];?></option>
		<?php } ?>
		</select>
		</div>
		</div>


		<div class="control-group">
		<label class="control-label" for="basicinput">Product Name</label>
		<div class="controls">
		<input type="text"    name="productName" id="productName" placeholder="Enter Product Name" class="span8 tip" required>
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="basicinput">Product Company</label>
		<div class="controls">
		<input type="text"    name="productCompany" id="productCompany"  placeholder="Enter Product Comapny Name" class="span8 tip" required>
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Product Price</label>
		<div class="controls">
		<input type="text"    name="productprice"  id="productprice" placeholder="Enter Product Price" class="span8 tip" required>
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="basicinput">Product Description</label>
		<div class="controls">
		<textarea  name="productDescription" id="productDescription" placeholder="Enter Product Description" rows="6" class="span8 tip">
		</textarea>  
		</div>
		</div>

		<!--<div class="control-group">
		<label class="control-label" for="basicinput">Product Shipping Charge</label>
		<div class="controls">
		<input type="text"    name="productShippingcharge" id="productShippingcharge"  placeholder="Enter Product Shipping Charge" class="span8 tip" required>
		</div>
		</div>-->

		<div class="control-group">
		<label class="control-label" for="basicinput">Product Availability</label>
		<div class="controls">
		<select   name="productAvailability"  id="productAvailability" id="productAvailability" class="span8 tip" required>
		<option value="">Select</option>
		<option value="In Stock">In Stock</option>
		<option value="Out of Stock">Out of Stock</option>
		</select>
		</div>
		</div>



		<div class="control-group">
		<label class="control-label" for="basicinput">Product Image1</label>
		<div class="controls">
		<input type="file" name="productimage1" id="productimage1" value="" class="span8 tip" required>
		</div>
		</div>


		<div class="control-group">
		<label class="control-label" for="basicinput">Product Image2</label>
		<div class="controls">
		<input type="file" name="productimage2" id="productimage2"  class="span8 tip" required>
		</div>
		</div>



		<div class="control-group">
		<label class="control-label" for="basicinput">Product Image3</label>
		<div class="controls">
		<input type="file" name="productimage3" id="productimage3"  class="span8 tip">
		</div>
		</div>

		<div class="control-group">
			<div class="controls">
			<?php $_SESSION["csrf_token"] = md5(rand(0,10000000)).time(); ?>
			<input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION["csrf_token"]);?>">
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
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/jquery.validate.js"></script>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#addproduct").validate({
    
        // Specify the validation rules
        rules: {
            category:{ required : true},
            productName:{ required : true},
			productCompany: {required : true},
			productprice: { required : true, digits: true },
			productDescription:{ required : true},
			productAvailability:{ required : true},
			productimage1:{ required : true},
			productimage2: {required : true},
               
        },
        
        // Specify the validation error messages
        messages: {
            category:  {
				required : "Please select category name"
			},
            productName:{ required :"Please enter product name"},
			productCompany:{ required :"Please enter product company"},
			productprice: {required :"Please enter product selling price"},
			productDescription:{required : "Please enter product description"},
			productAvailability: {required :"Please select product availability"},
			productimage1: {required :"Please upload product image1"},
			productimage2:{ required :"Please upload product image2"},
           
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
