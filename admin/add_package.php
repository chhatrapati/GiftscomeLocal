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


if(isset($_POST['submit']) && @$_SESSION["csrf_token"] == @$_POST['csrf_token'])
{
	$package_name=$_POST['package_name'];
	//$coins_value=$_POST['coins_value'];
	$gift_coins=$_POST['gift_coins'];
	if(isset($_FILES['image']['name']))
	{
	$package_image = $_FILES['image']['name'];
	}
	$tmp_package_img = $_FILES['image']['tmp_name'];
	$package_price=$_POST['package_price'];
	$package_validity=$_POST['package_validity'];
	$package_description=$_POST['package_description'];
	move_uploaded_file($tmp_package_img,"images/$package_image");
$sql=mysqli_query($con,"insert into package(package_name,package_image,package_price,package_validity,gift_coins,package_description) values('$package_name','$package_image','$package_price', '$package_validity','$gift_coins','$package_description')");
$_SESSION['msg']="package Created !!";

}
if(isset($_GET['del']))
		  {
		          $id = toInternalId($_GET['package_id']);
				  mysqli_query($con,"delete from package where package_id = '".$id."'");
                  $_SESSION['delmsg']="Product deleted !!";?>
				  <script type="text/javascript">
					setTimeout(function () {
					var basepath = window.location.protocol + '//' + window.location.hostname;
					var path = basepath + '/admin/add_package.php';
					window.location.href= path; // the redirect goes here
					},10000); // 5 seconds
				</script>
								 
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Packages | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Packages</a> </div>
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
									</div>
		<?php } ?>
		<?php if(isset($_GET['del'])){?>
									<div class="alert alert-error" id="successMessage">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
		<?php } ?>
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
           <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseOne" value="Add Package">
        </div>
        <div class="widget-content nopadding panel-collapse collapse" id="collapseOne">	
		<form class="form-horizontal" name="package" id="package_add" method="post"  enctype="multipart/form-data" >
									
		<div class="control-group">
		<label class="control-label" for="basicinput">Package Name</label>
		<div class="controls">
		<input type="text" placeholder="Enter package Name"  name="package_name" id="package_name" class="span8 tip" required>
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="basicinput">Package Image</label>
		<div class="controls">
		<input type="file" name="image" id="package_image" class="span8 tip" required>
		</div>
		</div>



		<div class="control-group">
		<label class="control-label" for="basicinput">Package Price</label>
		<div class="controls">
		<input type="text"   name="package_price" id="package_price" class="span8 tip" required>
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="basicinput">Package Validity (In Days)</label>
		<div class="controls">
		<input type="text"   name="package_validity" id="package_validity" class="span8 tip" required>
		</div>
		</div>

		
		<div class="control-group">
		<label class="control-label" for="basicinput">Gift Coins Value</label>
		<div class="controls">
		<input type="text"   name="gift_coins" id="gift_coins" class="span8 tip" required>
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Package Description</label>
		<div class="controls">
			<textarea class="span8" name="package_description" id="package_description" rows="5"></textarea>
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
	<div class="span11">
  
        <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="View Package">
          </div>
          <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
            <table class="table table-bordered data-table">
            <thead>
										<tr>
											<th>#</th>
											<th>Package Name</th>
											<th>Package Image</th>
											<th>Package Price</th>
											<th>Package Validity (In Days)</th>
											<th>Gift Coins Value</th>
											<th>Package Description</th>
											<th>Active</th>
											<th>Action</th>
										</tr>
		  </thead>
             <tbody>

								<?php $query=mysqli_query($con,"select * from package where package_type=''");
									$cnt=1;
									while($row=mysqli_fetch_array($query))
									{
										$package_id=$row['package_id'];
										$packageimage=$row['package_image'];
										
									?>																	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['package_name']);?></td>
											<td><?php if($packageimage==''){?>--- <?php } else {?><img src="images/<?php echo $packageimage;?>"  width="100px" height="100px"><?php }?></td>
											<td> <?php echo htmlentities($row['package_price']);?></td>
											<td> <?php echo htmlentities($row['package_validity']);?></td>
											<td> <?php echo htmlentities($row['gift_coins']);?></td>
											<td><?php echo htmlentities($row['package_description']);?></td>
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
				                          <img id="imgnotpopular<?php echo $row['package_id']; ?>" onclick="funisactive(<?php echo $row['package_id']; ?>,1,'package');" src='images/off.png' width='60' <?php echo $stylenotpopular;?> />
				                          <img id="imgpopular<?php echo $row['package_id']; ?>" onclick="funisactive(<?php echo $row['package_id']; ?>,0,'package');" src='images/on.png'  width='60' <?php echo $stylepopular;?> />
											
										  </td>
											<td>
											<a href="edit_package.php?package_id=<?php echo toPublicId($row['package_id']);?>" ><i class="fa fa-edit"></i></a>
											<a href="add_package.php?package_id=<?php echo toPublicId($package_id);?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a></td>
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
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/matrix.tables.js"></script>
<script type="text/javascript">

 // Setup form validation on the #register-form element
 $("#package_add").validate({
    
        // Specify the validation rules
        rules: {
            package_name: "required",
            package_price: {
                required: true,
				digits: true
            },
			package_description: "required",
			image: {required : false,accept:"image/jpg,image/jpeg,image/png"},
		    package_validity: {
                required: true,
				minlength:1,
				maxlength:3,
				digits: true
            },
			gift_coins: {
                required: true,
				digits: true
            },

               
        },
        
        // Specify the validation error messages
        messages: {
            package_name: {required:"Please enter package name"},
			package_price: {required:"Please enter package price",digits:"Please enter digits only"},
			package_validity: {required:"Please enter package validity",digits:"Please enter digits only"},
			gift_coins: {required:"Please enter gift coins value",digits:"Please enter digits only"},
            package_description: {required:"Please enter package description"},
			image: {required:"Please upload package image",accept:"Please upload .jpg or .png or .jpeg file of notice."},
			          
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
			 url: "change_active_package.php",  
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
</body>
</html>
<?php }?>
