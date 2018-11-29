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
	$cat_name=$_POST['cat_name'];
$sql=mysqli_query($con,"insert into tbl_faq_categories(cat_name) values('$cat_name')");
$_SESSION['msg']="Faq Category Created !!";

}

if(isset($_GET['del']))
		  {
		          $cat_id = toInternalId($_GET['id']);
				  mysqli_query($con,"delete from tbl_faq_categories where id = '".$cat_id."'");
                  $_SESSION['delmsg']="Category deleted !!";?>
				  <script type="text/javascript">
					setTimeout(function () {
					var basepath = window.location.protocol + '//' + window.location.hostname;
					var path = basepath + '/admin/faq-categories.php';
					window.location.href= path; // the redirect goes here
					},1000); // 5 seconds
				</script>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Faq Categories | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Faq Categories</a> </div>
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
          <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseOne" value="Add Category">
        </div>
       <div class="widget-content nopadding panel-collapse collapse" id="collapseOne">	
		<form class="form-horizontal" name="Category" id="category" method="post"  enctype="multipart/form-data" >
									
		<div class="control-group">
		<label class="control-label" for="basicinput">Category Name</label>
		<div class="controls">
		<input type="text" placeholder="Enter faq category name"  name="cat_name" id="cat_name" class="span8 tip" required>
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
            <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="View Categories">
          </div>
          <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
            <table class="table table-bordered data-table">
            <thead>
										<tr>
											<th>#</th>
											<th>Category</th>
											<th>Creation date</th>
											<!--<th>Active</th>-->
											<th>Action</th>
										</tr>
		  </thead>
             <tbody>

								<?php $query=mysqli_query($con,"select * from tbl_faq_categories");
									$cnt=1;
									while($row=mysqli_fetch_array($query)) {?>																	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['cat_name']);?></td>
											<td> <?php echo htmlentities($row['create_date']);?></td>
											
										  <td>
											<a href="edit-faq-category.php?id=<?php echo toPublicId($row['id']);?>" ><i class="fa fa-edit"></i></a>
											<a href="faq-categories.php?id=<?php echo toPublicId($row['id']);?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a></td>
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
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/matrix.tables.js"></script>
<script src="js/jquery.validate.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#category").validate({
    
        // Specify the validation rules
        rules: {
            cat_name: "required",
                          
        },
        
        // Specify the validation error messages
        messages: {
            cat_name: "Please enter category name",
                      
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
