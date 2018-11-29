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
/*if(isset($_POST['submit']) && @$_SESSION["csrf_token"] == @$_POST['csrf_token'])
{
	$points_by_login=$_POST['points_by_login'];
	$points_by_register=$_POST['points_by_register'];	$points_by_social_share=$_POST['points_by_social_share'];	$points_by_game_won=$_POST['points_by_game_won'];
    $sql=mysqli_query($con,"insert into user_points_supplement(points_by_login,points_by_register,points_by_social_share,points_by_game_won) values('$points_by_login','$points_by_register','$points_by_social_share','$points_by_game_won')");
    $_SESSION['msg']="Points Supplement Record Added!!";
}
*/
if(isset($_GET['del']))
		  {
		          $id = toInternalId($_GET['id']);
				  mysqli_query($con,"delete from user_points_supplement where id = '".$id."'");
                  $_SESSION['delmsg']="Record deleted !!";?>
				   <script type="text/javascript">
					setTimeout(function () {
					var basepath = window.location.protocol + '//' + window.location.hostname;
					var path = basepath + '/admin/points_supplement.php';
					window.location.href= path; // the redirect goes here
					},1000); // 5 seconds
				</script>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Points Supplement | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Points Supplement To Users</a> </div>
</div>
<div class="container-fluid">
  <!--<hr>
   <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
	  <?php //if(!empty($_SESSION['msg'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php //echo htmlentities($_SESSION['msg']);?><?php //echo htmlentities($_SESSION['msg']="");?>
									</div>
		<?php// } ?>
		<?php //if(isset($_GET['del'])){?>
									<div class="alert alert-error" id="successMessage">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php //echo htmlentities($_SESSION['delmsg']);?><?php //echo htmlentities($_SESSION['delmsg']="");?>
									</div>
		<?php //} ?>
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseOne" value="Add Points Suppplement">
        </div>
       <div class="widget-content nopadding panel-collapse collapse" id="collapseOne">
		<form class="form-horizontal" name="points_supplement" id="points_supplement" method="post"  enctype="multipart/form-data" >		<div class="control-group">		<label class="control-label" for="basicinput">Points By Login</label>
		<div class="controls">
		<input type="text"   name="points_by_login" id="points_by_login" class="span8 tip" placeholder="Enter Points Value By Login" required>
		</div>
		</div>
		<div class="control-group">		<label class="control-label" for="basicinput">Points By Reigster</label>		<div class="controls">		<input type="text"   name="points_by_register" id="points_by_register" class="span8 tip" placeholder="Enter Points Value By Reigster" required>		</div>		</div>		<div class="control-group">		<label class="control-label" for="basicinput">Points By Social Share</label>		<div class="controls">		<input type="text"   name="points_by_social_share" id="points_by_social_share" class="span8 tip" placeholder="Enter Points Value By Social Share" required>		</div>		</div>		<div class="control-group">		<label class="control-label" for="basicinput">Points By Game Won</label>		<div class="controls">		<input type="text"   name="points_by_game_won" id="points_by_game_won" class="span8 tip" placeholder="Enter Points Value By Game Won" required>		</div>		</div>
		<div class="control-group">
			<div class="controls">
			<?php //$_SESSION["csrf_token"] = md5(rand(0,10000000)).time(); ?>
			<input type="hidden" name="csrf_token" value="<?php //echo htmlspecialchars($_SESSION["csrf_token"]);?>">
				<button type="submit" name="submit" class="btn btn-success">Submit</button>
			</div>
		</div>
		</form>
        </div>
      </div>
    </div>
	</div>
	-->
	<div class="row-fluid">
	<div class="span11">
        <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
             <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="Manage Points Supplement To Users">
          </div>
          <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
            <table class="table table-bordered data-table">
            <thead>
										<tr>
											<th>#</th>
											<th>Points By Login</th>											<th>Points By Register</th>											<th>Points By Social Share</th>
											<th>Points By Game Won</th>
											<!--<th>Status</th>-->
											<th>Action</th>
										</tr>
		  </thead>
             <tbody>
			<?php $query=mysqli_query($con,"select * from  user_points_supplement");
			$cnt=1;
			while($row=mysqli_fetch_array($query)) {
			$id=$row['id'];
			?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['points_by_login']);?></td>
											<td><?php echo htmlentities($row['points_by_register']);?></td>											<td><?php echo htmlentities($row['points_by_social_share']);?></td>											<td><?php echo htmlentities($row['points_by_game_won']);?></td>
											<!--<td class="">
											// <?php $stylepopular= ''; $stylenotpopular= '';?>
											// <?php 
											// if($row['status']==0)
											// {
												// $stylepopular= "style= display:none";
											// }
											// if($row['status']==1)
											// {
												// $stylenotpopular= "style= display:none";
											// }
											// ?>
				                          <img id="imgnotpopular<?php echo $row['id']; ?>" onclick="funisactive(<?php echo $row['id']; ?>,1,'user_points_supplement');" src='images/off.png' width='60' <?php echo $stylenotpopular;?> />
				                          <img id="imgpopular<?php echo $row['id']; ?>" onclick="funisactive(<?php echo $row['id']; ?>,0,'user_points_supplement');" src='images/on.png'  width='60' <?php echo $stylepopular;?> />
										  </td>-->
										  <td>
											<a href="edit_points_supplement.php?id=<?php echo toPublicId($row['id']);?>" ><i class="fa fa-edit"></i></a>
											<a href="points_supplement.php?id=<?php echo toPublicId($id);?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>					</tbody>				
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
  $("#points_supplement").validate({
        // Specify the validation rules
		rules : { 
		points_by_login: {
            required: true,
			digits: true
            },		points_by_register: {            required: true,			digits: true            },		points_by_social_share: {            required: true,			digits: true            },		points_by_game_won: {            required: true,			digits: true            }
	    
       },
        // Specify the validation error messages
        messages: {
            //points_value: "Please enter points value"
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
<!--<script>
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
</script>-->
</body>
</html>
<?php }?>