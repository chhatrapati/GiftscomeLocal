<?php
session_start();
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
$sql_9 = mysqli_query($con,"select gift_exchange_rate FROM general_settings");
$result_9=mysqli_fetch_array($sql_9);
$gift_exchange_rate =$result_9['gift_exchange_rate'];

if(isset($_POST['submit']) && @$_SESSION["csrf_token"] == @$_POST['csrf_token'])
{
	$category=$_POST['category'];
	//$subcat=$_POST['subcategory'];
	$productname=$_POST['productName'];
	//$productcompany=$_POST['productCompany'];
	$productprice=$_POST['productprice'];
	$gift_coins_price = $gift_exchange_rate*$productprice;
	$productdescription=$_POST['productDescription'];
	$gift_coins_value=$_POST['gift_coins_value'];
	$validity_of_vip_package=$_POST['validity_of_vip_package'];
	$productimage1=$_FILES["productimage1"]["name"];
	$productimage2=$_FILES["productimage2"]["name"];
	$productimage3=$_FILES["productimage3"]["name"];
	$dir="productimages/$productname";
	mkdir($dir);// directory creation for product images
	move_uploaded_file($_FILES["productimage1"]["tmp_name"],"productimages/$productname/".$_FILES["productimage1"]["name"]);
	move_uploaded_file($_FILES["productimage2"]["tmp_name"],"productimages/$productname/".$_FILES["productimage2"]["name"]);
	move_uploaded_file($_FILES["productimage3"]["tmp_name"],"productimages/$productname/".$_FILES["productimage3"]["name"]);
    $sql=mysqli_query($con,"insert into products(category,productName,productPrice,productDescription,productImage1,productImage2,productImage3,gift_coins_price,gift_coins_value,validity_of_vip_package) values('$category','$productname','$productprice','$productdescription','$productimage1','$productimage2','$productimage3','$gift_coins_price','$gift_coins_value','$validity_of_vip_package')");
    $_SESSION['msg']="Product Inserted Successfully !!";
	$last_id = mysqli_insert_id($con);
	if($category=='7')
	{
		$sql_78=mysqli_query($con,"insert into package(package_id,package_name,package_price,package_validity,gift_coins,package_type) values('$last_id','$productname','$productprice', '$validity_of_vip_package','$gift_coins_value','Product')");
	}

}

if(isset($_GET['del']))
		  {
		          $id = toInternalId($_GET['id']);
				  mysqli_query($con,"delete from products where id = '".$id."'");
                  $_SESSION['delmsg']="Product deleted !!"; ?>
				   <script type="text/javascript">
					setTimeout(function () {
					var basepath = window.location.protocol + '//' + window.location.hostname;
					var path = basepath + '/admin/manage-products.php';
					window.location.href= path; // the redirect goes here
					},1000); // 5 seconds
				</script>
				
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin| Manage Products</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
</head>
<body>

<?php require_once('include/header.php');?>

<?php require_once('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current"> Manage Products</a> </div>
  </div>
  <div class="container-fluid">
    <hr>
	 <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
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
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
         <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseOne" value="Add Product">
        </div>
        <div class="widget-content nopadding panel-collapse collapse" id="collapseOne">		
		<form class="form-horizontal"name="insertproduct" id ="addproduct" method="post"  enctype="multipart/form-data" >
									
		<div class="control-group">
		<label class="control-label" for="basicinput">Category</label>
		<div class="controls">
		<select name="category" id="category" class="span8 tip" required>
		<option value="0" selected>Select Category</option> 
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
		<label class="control-label" for="basicinput">Product Price (In $)</label>
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
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Gift Coins Value</label>
		<div class="controls">
		<input type="text"    name="gift_coins_value"  id="gift_coins_value" placeholder="Enter Gift Coins Value" class="span8 tip">
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Gift Come Vip Days</label>
		<div class="controls">
		<input type="text"    name="validity_of_vip_package"  id="validity_of_vip_package" placeholder="Enter Gift Come Vip Days" class="span8 tip">
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
		<input type="file" name="productimage2" id="productimage2"  class="span8 tip">
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
			<button type="reset" name="reset" class="btn btn-success">Cancel</button>
			<button type="submit" name="submit" class="btn btn-success">Submit</button>
			</div>
		</div>
		</form>
		
		
        </div>
      </div>
    </div>
	</div>
	
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
             <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="View All Products">
          </div>
          <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
            <table class="table table-bordered data-table" id="example">
             <thead>
										<tr>
											<th>#</th>
											<th>Product Name</th>
											<th>Category </th>
											<th>Price (In $)</th>
											<th>Product Creation Date</th>
											<th>Active</th>
											<th>Action</th>
										</tr>
			</thead>
              <tbody>

									<?php 
									    $query=mysqli_query($con,"select products.*,category.categoryName from products join category on category.id=products.category");
										$cnt=1;
										while($row=mysqli_fetch_array($query))
										{ ?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['productName']);?></td>
											<td><?php echo htmlentities($row['categoryName']);?></td>
											<td><?php echo htmlentities($row['productPrice']);?></td>
											<td><?php echo htmlentities($row['postingDate']);?></td>
											<td class="">
											<?php $stylepopular= ''; $stylenotpopular= '';?>
											<?php 
											if($row['is_active']==0)
											{
												$stylepopular= "style= display:none";
											}
											
											if($row['is_active']==1)
											{
												$stylenotpopular= "style= display:none";
											}
											
											?>
				                          <img id="imgnotpopular<?php echo $row['id']; ?>" onclick="funisactive(<?php echo $row['id']; ?>,1,'products');" src='images/off.png' width='60' <?php echo $stylenotpopular;?> />
				                          <img id="imgpopular<?php echo $row['id']; ?>" onclick="funisactive(<?php echo $row['id']; ?>,0,'products');" src='images/on.png'  width='60' <?php echo $stylepopular;?> />
										  </td>
										  <td>
											<a href="edit-products.php?id=<?php echo toPublicId($row['id']);?>" ><i class="fa fa-edit"></i></a>
											<a href="manage-products.php?id=<?php echo toPublicId($row['id']);?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
				</tbody>				
            </table>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="js/jquery.validate.js"></script>
<?php require_once('tiny-myc.php');?>
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.tables.js"></script>
<script type="text/javascript"> 
jQuery.validator.addMethod(
          "notEqualTo",
          function(elementValue,element,param) {
            return elementValue != param;
          },
          "Value cannot be {0}"
        );

 // Setup form validation on the #register-form element
 $("#addproduct").validate({
    
        // Specify the validation rules
        rules: {
            category:  { required : true,notEqualTo: 0},
            productName:{ required : true},
			productprice: { required : true, digits: true },
			productDescription:{ required : true},
			productimage1:{ required : true},
			gift_coins_value: { required : false, digits: true },
			validity_of_vip_package: { required : false, digits: true },
			//productimage1:{ required : true,accept:"image/jpg,image/jpeg,image/png"},
			//productimage2: {required : true,accept:"image/jpg,image/jpeg,image/png"},
               
        },
        
        // Specify the validation error messages
        messages: {
            category:  { required:"Please select category.",notEqualTo: "Please select category"},
            productName:{ required :"Please enter product name"},
			productprice: {required :"Please enter product selling price"},
			productDescription:{required : "Please enter product description"},
			productimage1: {required :"Please upload product image1"},
			//productimage1: {required :"Please upload product image1",accept:"Please upload .jpg or .png or .jpeg file of notice."},
			//productimage2:{ required :"Please upload product image2",accept:"Please upload .jpg or .png or .jpeg file of notice."},
           
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
<script>
		
		function funisactive(id,is_active,table_name)
		{
			 $.ajax({  
			 type: "POST",  
			 url: "change_active.php",  
			 data: "id=" + id + "& is_active=" + is_active + "& table_name=" + table_name,  
			 success: function(){  
				//success (not finished)
				if(is_active=='1')
				{
				document.getElementById('imgnotpopular'+id).style.display='none';
				document.getElementById('imgpopular'+id).style.display='block';
				}
				else
				{
				document.getElementById('imgnotpopular'+id).style.display='block';
				document.getElementById('imgpopular'+id).style.display='none';
				}
				
				}  
			 });  
		  return false;  
		   
		}
</script>
<script>
</script>
</body>
</html>
<?php }?>
