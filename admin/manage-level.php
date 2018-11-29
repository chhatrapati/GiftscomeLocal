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
	$level_no=$_POST['level_no'];
	$level_points=$_POST['level_points'];
	$level_image=$_FILES["level_image"]["name"];
	move_uploaded_file($_FILES["level_image"]["tmp_name"],"images/$level_image");
$sql=mysqli_query($con,"insert into tbl_users_level(level_image,user_levels_id,level_points)values('$level_image','$level_no','$level_points')");
$_SESSION['msg']="Level Inserted Successfully !!";

}
if(isset($_GET['del']))
		  {
		          $id = toInternalId($_GET['id']);
				  mysqli_query($con,"delete from tbl_users_level where id = '".$id."'");
                  $_SESSION['delmsg']="Level deleted !!";
				 header('location:manage-level.php');
				  
				  ?>
				  <!--<script type="text/javascript">
					setTimeout(function () {
					var basepath = window.location.protocol + '//' + window.location.hostname;
					var path = basepath + '/admin/manage-level.php';
					window.location.href= path; // the redirect goes here
					},1000); // 5 seconds
				</script>-->	
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin| Manage Level</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
</head>
<body>

<?php require_once('include/header.php');?>

<?php require_once('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current"> Manage level</a> </div>
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
									<!--<script type="text/javascript">
											setTimeout(function () {
											var basepath = window.location.protocol + '//' + window.location.hostname;
											var path = basepath + '/admin/manage-level.php';
											window.location.href= path; // the redirect goes here
											},1000); // 5 seconds
						          </script>-->
								  
									</div>
		<?php } ?>
		<?php if(isset($_GET['del'])){?>
									<div class="alert alert-error" id="successMessage">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
		<?php } ?>
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
           <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseOne" value="Add Level">
        </div>
        <div class="widget-content nopadding panel-collapse collapse" id="collapseOne">
		<form class="form-horizontal"name="sublevel" id ="sublevel" method="post"  enctype="multipart/form-data" >
			
			
			
			<div class="control-group">
		<label class="control-label" for="basicinput">select level</label>
		<div class="controls">
		<select name="level_no" id="level_no" class="span8 tip" required>
		<option value="">Select the level</option> 
		<?php $query=mysqli_query($con,"select * from  user_levels");
		while($row=mysqli_fetch_array($query))
		{?>
		<option value="<?php echo $row['user_levels_id'];?>">level<?php echo $row['user_levels_name'];?></option>
		<?php } ?>
		</select>
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="basicinput">level points</label>
		<div class="controls">
		<input type="text" name="level_points" id="level_points"  placeholder="Enter Level points" class="span8 tip" required>
		</textarea>  
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="basicinput">level image</label>
		<div class="controls">
		<input type="file" name="level_image" id="level_image" value="" class="span8 tip" required>
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
	
	
    <div class="row-fluid">
      <div class="span12">
  
        <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="View All Level">
          </div>
         <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
            <table class="table table-bordered data-table">
             <thead>
										<tr>
											<th>#</th>
											<th>level Image</th>
											<th>level no </th>
											<th>level points</th>
											
											<th>Action</th>
										</tr>
			</thead>
              <tbody>

									<?php 
									    $query=mysqli_query($con,"select * from tbl_users_level");
										$cnt=1;
										while($row=mysqli_fetch_array($query))
										{ ?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td style="width:20%;"><img src="images/<?php echo $row['level_image'];?>" style="width:30%;"></td>
											<td><?php echo htmlentities($row['user_levels_id']);?></td>
											<td><?php echo htmlentities($row['level_points']);?></td>
											
										  <td>
											<a href="edit_level.php?id=<?php echo toPublicId($row['id']);?>" ><i class="fa fa-edit"></i></a>
											<a href="manage-level.php?id=<?php echo toPublicId($row['id']);?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a></td>
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
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.tables.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#sublevel").validate({
    
        // Specify the validation rules
        rules: {
            level_points:{ required : true},
			level_image: {required : true,accept:"image/jpg,image/jpeg,image/png"},
	
               
        },
        
        // Specify the validation error messages
        messages: {
           
            level_points:{ required :"Please enter level title"},
			level_image: {required :"Please enter level image",accept:"Please upload .jpg or .png or .jpeg file of notice."}
		
           
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
			 url: "change_active_slider.php",  
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
