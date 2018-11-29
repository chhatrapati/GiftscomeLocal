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
	$page_name=$_POST['page_name'];
	$meta_title=$_POST['meta_title'];
	$meta_keyword=$_POST['meta_keyword'];
	$meta_robots=$_POST['meta_robots'];
	$meta_description=$_POST['meta_description'];
$sql=mysqli_query($con,"insert into manage_seo(page_name,meta_title,meta_keyword,meta_robots,meta_description) values('$page_name','$meta_title','$meta_keyword','$meta_robots','$meta_description')");
$_SESSION['msg']="Record Created !!";

}

if(isset($_GET['del']))
		  {
		          $cat_id = toInternalId($_GET['id']);
				  mysqli_query($con,"delete from manage_seo where id = '".$cat_id."'");
                  $_SESSION['delmsg']="Record deleted !!";?>
				  <script type="text/javascript">
					setTimeout(function () {
					var basepath = window.location.protocol + '//' + window.location.hostname;
					var path = basepath + '/admin/manage_seo.php';
					window.location.href= path; // the redirect goes here
					},1000); // 5 seconds
				</script>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>SEO | Admin</title>
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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage SEO</a> </div>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span11">
        <div class="widget-box">
		<?php if(!empty($_SESSION['msg'])){?>
            <div class="alert alert-success" id="successMessage">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Well done!</strong> <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?> </div>
            <?php } ?>
            <?php if(isset($_GET['del'])){?>
            <div class="alert alert-error" id="successMessage">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Oh snap!</strong> <?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?> </div>
            <?php } ?>
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
           <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseOne" value="Add Seo Details">
          </div>
         <div class="widget-content nopadding panel-collapse collapse" id="collapseOne">
            <form class="form-horizontal" name="Seo" id="seo" method="post"  enctype="multipart/form-data" >
			<div class="control-group">
                <label class="control-label" for="basicinput">Page Name</label>
                <div class="controls">
                  <select name="page_name" id="page_name" class="span8 tip" required>
                    <option value="">Select Page</option>
                    <option value="About Us">About Us</option>
					<option value="Contact Us">Contact Us</option>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="basicinput">Meta Title</label>
                <div class="controls">
                  <input type="text" placeholder="Meta Title"  name="meta_title" id="meta_title" class="span8 tip" required>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label" for="basicinput">Meta Keyword</label>
                <div class="controls">
                  <input type="text" placeholder="Meta Keyword"  name="meta_keyword" id="meta_keyword" class="span8 tip" required>
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label" for="basicinput">Meta Robots</label>
                <div class="controls">
                  <input type="text" placeholder="Meta Robots"  name="meta_robots" id="meta_robots" class="span8 tip" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="basicinput">Meta Description</label>
                <div class="controls">
                  <textarea class="span8" name="meta_description" id="meta_description" rows="5"></textarea>
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
    <div class="row-fluid">
      <div class="span11">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="View Seo Details">
          </div>
          <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Page Name</th>
                  <th>Meta Title</th>
                  <th>Meta Keyword</th>
                  <th>Meta Robots</th>
				  <th>Meta Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
					<?php   $query=mysqli_query($con,"select * from manage_seo");
							$cnt=1;
							while($row=mysqli_fetch_array($query)) { ?>
                <tr>
                  <td><?php echo htmlentities($cnt);?></td>
                  <td><?php echo htmlentities($row['page_name']);?></td>
                  <td><?php echo htmlentities($row['meta_title']);?></td>
                  <td><?php echo htmlentities($row['meta_keyword']);?></td>
                  <td><?php echo htmlentities($row['meta_robots']);?></td>
				  <td><?php echo htmlentities($row['meta_description']);?></td>
                  <td><a href="edit-seo.php?id=<?php echo toPublicId($row['id']);?>" ><i class="fa fa-edit"></i></a> <a href="manage_seo.php?id=<?php echo toPublicId($row['id']);?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a></td>
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
<script src="js/jquery.validate.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#seo").validate({
    
        // Specify the validation rules
        rules: {
            page_name:{ required : true},
            meta_title:{ required : true},
			meta_keyword: {required : true},
			meta_robots: { required : true},
			meta_description: { required : true},
        },
        
        // Specify the validation error messages
        messages: {
            page_name:  {required : "Please select page name"},
            meta_title:{ required :"Please enter meta title"},
			meta_keyword:{ required :"Please enter meta keyword"},
			meta_robots: {required :"Please enter meta robots"},
			meta_description: {required :"Please enter meta description"},          
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
