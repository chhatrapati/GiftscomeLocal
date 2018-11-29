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
	$cat_name=$_POST['cat_name'];
	$question=addslashes($_POST['question']);
	$answer=addslashes($_POST['answer']);
	$query=mysql_query("select question from tbl_faq where id='pid'");
	$result=mysql_fetch_row($query);
$sql=mysqli_query($con,"update  tbl_faq set cat_name='$cat_name',question='$question',answer='$answer' where id='$pid' ");
$_SESSION['msg']="Faq Record Updated Successfully !!";
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit Faq | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Faq</a> </div>
</div>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Faq</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(isset($_POST['submit'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
								<script type="text/javascript">
											setTimeout(function () {
											var basepath = window.location.protocol + '//' + window.location.hostname;
											var path = basepath + '/admin/manage-faq.php';
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
				
		<form class="form-horizontal" name="editfaq" id="editfaq" method="post"  enctype="multipart/form-data" >
		<?php 
		$query=mysqli_query($con,"select tbl_faq.*,tbl_faq_categories.cat_name as catname,tbl_faq_categories.id as cid from tbl_faq join tbl_faq_categories on tbl_faq_categories.id=tbl_faq.cat_name where tbl_faq.id='$pid'");
		$cnt=1;
		while($row=mysqli_fetch_array($query))
		{ ?>							
		<div class="control-group">
		<label class="control-label" for="basicinput">Category</label>
		<div class="controls">
		<select name="cat_name" id="cat_name" class="span8 tip" onChange="getSubcat(this.value);"  required>
		<option value="<?php echo htmlentities($row['cid']);?>"><?php echo htmlentities($row['catname']);?></option> 
		<?php $query=mysqli_query($con,"select * from tbl_faq_categories");
		while($rw=mysqli_fetch_array($query))
		{
			if($row['catname']==$rw['cat_name'])
			{
				continue;
			}
			else{ ?>

		<option value="<?php echo $rw['id'];?>"><?php echo $rw['cat_name'];?></option>
		<?php }} ?>
		</select>
		</div>
		</div>


		<div class="control-group">
		<label class="control-label" for="basicinput">Question</label>
		<div class="controls">
		<input type="text" name="question" id="question"  placeholder="Enter Question" value="<?php echo htmlentities($row['question']);?>" class="span8 tip">
		</div>
		</div>
	
		<div class="control-group">
		<label class="control-label" for="basicinput">Answer</label>
		<div class="controls">
		<textarea  name="answer" id="answer"  placeholder="Enter Answer" rows="6" class="span8 tip"><?php echo htmlentities($row['answer']);?></textarea>  
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
<?php require_once('tiny-myc.php');?>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#editfaq").validate({
    
       // Specify the validation rules
        rules: {
            question:{ required : true},
			answer:{ required : true},
			
        },
        
        // Specify the validation error messages
        messages: {
            question:{ required :"Please enter question"},
			answer:{required : "Please enter answer"},
			
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
