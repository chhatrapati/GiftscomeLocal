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
	$user_levels_name=$_POST['user_levels_name'];
	$user_levels_complete=$_POST['user_levels_complete'];
	$sub_lev1_points=$_POST['sub_lev1_points'];
	$sub_lev2_points=$_POST['sub_lev2_points'];
	$sub_lev3_points=$_POST['sub_lev3_points'];
	$sub_lev4_points=$_POST['sub_lev4_points'];
	$sub_lev5_points=$_POST['sub_lev5_points'];
$sql=mysqli_query($con,"insert into user_levels(user_levels_name,user_levels_complete,sub_lev1_points,sub_lev2_points,sub_lev3_points,sub_lev4_points,sub_lev5_points)values('$user_levels_name','$user_levels_complete','$sub_lev1_points','$sub_lev2_points','$sub_lev3_points','$sub_lev4_points','$sub_lev5_points')");
$_SESSION['msg']="Level Inserted Successfully !!";

}
if(isset($_GET['del']))
		  {
		          $id = toInternalId($_GET['id']);
				  mysqli_query($con,"delete from user_levels where user_levels_id = '".$id."'");
                  $_SESSION['delmsg']="Level deleted !!";
				  header('location:manage-userlevel.php');
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
		<form class="form-horizontal"name="level_manage" id ="level_manage" method="post"  enctype="multipart/form-data" >
									
			<div class="control-group">
		<label class="control-label" for="basicinput">Level Name</label>
		<div class="controls">
		<input type="text" name="user_levels_name" id="user_levels_name"  placeholder="Enter Level no" class="span8 tip" required>
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="basicinput">Level Points</label>
		<div class="controls">
		<input type="text" name="user_levels_complete" id="user_levels_complete"  placeholder="Enter Level complete points" class="span8 tip" required> 
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Sub Level 1 Points</label>
		<div class="controls">
		<input type="text" name="sub_lev1_points" id="sub_lev1_points"  placeholder="Enter Level complete points" class="span8 tip" required> 
		</div>
		</div>
		
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Sub Level 2 Points</label>
		<div class="controls">
		<input type="text" name="sub_lev2_points" id="sub_lev2_points"  placeholder="Enter Level complete points" class="span8 tip" required> 
		</div>
		</div>
		
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Sub Level 3 Points</label>
		<div class="controls">
		<input type="text" name="sub_lev3_points" id="sub_lev3_points"  placeholder="Enter Level complete points" class="span8 tip" required> 
		</div>
		</div>
		
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Sub Level 4 Points</label>
		<div class="controls">
		<input type="text" name="sub_lev4_points" id="sub_lev4_points"  placeholder="Enter Level complete points" class="span8 tip" required> 
		</div>
		</div>
		
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Sub Level 5 Points</label>
		<div class="controls">
		<input type="text" name="sub_lev5_points" id="sub_lev5_points"  placeholder="Enter Level complete points" class="span8 tip" required> 
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
											<th>Level Name </th>
											<th>Level Points</th>
											<th>Sub Level 1 Points</th>
											<th>Sub Level 2 Points</th>
											<th>Sub Level 3 Points</th>
											<th>Sub Level 4 Points</th>
											<th>Sub Level 5 Points</th>
											<th>Action</th>
										</tr>
			</thead>
              <tbody>

									<?php 
									    $query=mysqli_query($con,"select * from  user_levels");
										$cnt=1;
										while($row=mysqli_fetch_array($query))
										{ ?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['user_levels_name']);?></td>
											<td><?php echo htmlentities($row['user_levels_complete']);?></td>
											<td><?php echo htmlentities($row['sub_lev1_points']);?></td>
											<td><?php echo htmlentities($row['sub_lev2_points']);?></td>
											<td><?php echo htmlentities($row['sub_lev3_points']);?></td>
											<td><?php echo htmlentities($row['sub_lev4_points']);?></td>
											<td><?php echo htmlentities($row['sub_lev5_points']);?></td>
											
										  <td>
											<a href="edit_userlevel.php?id=<?php echo toPublicId($row['user_levels_id']);?>" ><i class="fa fa-edit"></i></a>
											<a href="manage-userlevel.php?id=<?php echo toPublicId($row['user_levels_id']);?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a></td>
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
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 $("#level_manage").validate({
    
       rules: {
            user_levels_name:{ required : true},
            user_levels_complete:{ required : true,digits:true},
			sub_lev1_points:{ required : true,digits:true},
			sub_lev2_points:{ required : true,digits:true},
			sub_lev3_points:{ required : true,digits:true},
			sub_lev4_points:{ required : true,digits:true},
			sub_lev5_points:{ required : true,digits:true},
			  
        },
        
        // Specify the validation error messages
        messages: {
           
            user_levels_name:{ required :"Please enter level name"},
			user_levels_complete:{ required :"Please enter level points"},
			sub_lev1_points:{ required :"Please enter sub level 1 points"},
			sub_lev3_points:{ required :"Please enter sub level 2 points"},
			sub_lev3_points:{ required :"Please enter sub level 3 points"},
			sub_lev4_points:{ required :"Please enter sub level 4 points"},
			sub_lev5_points:{ required :"Please enter sub level 5 points"}
           
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
