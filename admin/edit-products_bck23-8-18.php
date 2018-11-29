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
	$category=$_POST['category'];
	//$subcat=$_POST['subcategory'];
	$productname=$_POST['productName'];
	$productcompany=$_POST['productCompany'];
	$productprice=$_POST['productprice'];
	//$productpricebd=$_POST['productpricebd'];
	$productdescription=$_POST['productDescription'];
	//$productscharge=$_POST['productShippingcharge'];
	$productavailability=$_POST['productAvailability'];
	$query=mysql_query("select productName from products where id='pid'");
	$result=mysql_fetch_row($query);
	$pname=$result['productName'];
	
rename("productimages/$pname","productimages/$productname");
$sql=mysqli_query($con,"update  products set category='$category',productName='$productname',productCompany='$productcompany',productPrice='$productprice',productDescription='$productdescription',productAvailability='$productavailability',productPriceBeforeDiscount='$productpricebd' where id='$pid' ");
$_SESSION['msg']="Product Updated Successfully !!";

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
<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Product</a> </div>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Product</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(isset($_POST['submit'])){?>
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
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
		<?php } ?>
				
		<form class="form-horizontal" name="insertproduct" id="editproduct" method="post"  enctype="multipart/form-data" >
		<?php 
		$query=mysqli_query($con,"select products.*,category.categoryName as catname,category.id as cid from products join category on category.id=products.category where products.id='$pid'");
		$cnt=1;
		while($row=mysqli_fetch_array($query))
		{ ?>							
		<div class="control-group">
		<label class="control-label" for="basicinput">Category</label>
		<div class="controls">
		<select name="category" id="category" class="span8 tip" onChange="getSubcat(this.value);"  required>
		<option value="<?php echo htmlentities($row['cid']);?>"><?php echo htmlentities($row['catname']);?></option> 
		<?php $query=mysqli_query($con,"select * from category");
		while($rw=mysqli_fetch_array($query))
		{
			if($row['catname']==$rw['categoryName'])
			{
				continue;
			}
			else{ ?>

		<option value="<?php echo $rw['id'];?>"><?php echo $rw['categoryName'];?></option>
		<?php }} ?>
		</select>
		</div>
		</div>


		<div class="control-group">
		<label class="control-label" for="basicinput">Product Name</label>
		<div class="controls">
		<input type="text"    name="productName" id="productName"  placeholder="Enter Product Name" value="<?php echo htmlentities($row['productName']);?>" class="span8 tip">
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="basicinput">Product Company</label>
		<div class="controls">
		<input type="text"    name="productCompany" id="productCompany"  placeholder="Enter Product Comapny Name" value="<?php echo htmlentities($row['productCompany']);?>" class="span8 tip" required>
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Product Price</label>
		<div class="controls">
		<input type="text"    name="productprice" id="productprice"  placeholder="Enter Product Price" value="<?php echo htmlentities($row['productPrice']);?>" class="span8 tip" required>
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="basicinput">Product Description</label>
		<div class="controls">
		<textarea  name="productDescription" id="productDescription"  placeholder="Enter Product Description" rows="6" class="span8 tip">
		<?php echo htmlentities($row['productDescription']);?>
		</textarea>  
		</div>
		</div>

		<!--<div class="control-group">
		<label class="control-label" for="basicinput">Product Shipping Charge</label>
		<div class="controls">
		<input type="text"    name="productShippingcharge" id="productShippingcharge"  placeholder="Enter Product Shipping Charge" value="<?php //echo htmlentities($row['shippingCharge']);?>" class="span8 tip" required>
		</div>
		</div>-->

		<div class="control-group">
		<label class="control-label" for="basicinput">Product Availability</label>
		<div class="controls">
		<select   name="productAvailability"  id="productAvailability" class="span8 tip" required>
		<option value="In Stock" <?php if($row['productAvailability']=='In Stock'){ echo 'selected'; }?>>In Stock</option>
		<option value="Out of Stock" <?php if($row['productAvailability']=='Out of Stock') { echo 'selected'; }?>>Out of Stock</option>
		</select>
		</div>
		</div>



		<div class="control-group">
		<label class="control-label" for="basicinput">Product Image1</label>
		<div class="controls">
		<img src="productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage1']);?>" width="200" height="100"> <a href="update-image1.php?id=<?php echo toPublicId($row['id']);?>">Change Image</a>
		</div>
		</div>


		<div class="control-group">
		<label class="control-label" for="basicinput">Product Image2</label>
		<div class="controls">
		<img src="productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage2']);?>" width="200" height="100"> <a href="update-image2.php?id=<?php echo toPublicId($row['id']);?>">Change Image</a>
		</div>
		</div>



		<div class="control-group">
		<label class="control-label" for="basicinput">Product Image3</label>
		<div class="controls">
		<img src="productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage3']);?>" width="200" height="100"> <a href="update-image3.php?id=<?php echo toPublicId($row['id']);?>">Change Image</a>
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
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#editproduct").validate({
    
        // Specify the validation rules
        rules: {
            category:{ required : true},
            productName:{ required : true},
			productCompany: {required : true},
			productprice: { required : true, digits: true },
			productDescription:{ required : true},
			productAvailability:{ required : true},
			               
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
