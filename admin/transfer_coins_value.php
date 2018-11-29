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
	$user_type=$_POST['user_type'];
	$gift_coins=$_POST['gift_coins'];
    $sql=mysqli_query($con,"insert into coins_transfer_value(user_type,gift_coins) values('$user_type','$gift_coins')");
    $_SESSION['msg']="Coins Value Added!!";

}

if(isset($_GET['del']))
		  {
		          $id = toInternalId($_GET['id']);
				  mysqli_query($con,"delete from coins_transfer_value where id = '".$id."'");
                  $_SESSION['delmsg']="Coins Value deleted !!";?>
				  <script type="text/javascript">
					setTimeout(function () {
					var basepath = window.location.protocol + '//' + window.location.hostname;
					var path = basepath + '/admin/transfer_coins_value.php';
					window.location.href= path; // the redirect goes here
					},1000); // 5 seconds
				</script>
				 
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Coins Transfer Limits | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Coins Transfer Limits</a> </div>
</div>
<div class="container-fluid">
   <!--<div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Coins Transfer Value</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(isset($_POST['submit'])){?>
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
		
		<form class="form-horizontal" name="transfer_coins" id="transfer_coins" method="post"  enctype="multipart/form-data" >
									
		<div class="control-group">
		<label class="control-label" for="basicinput">User type</label>
		<div class="controls">
		<select name="user_type" id="user_type">
		<option value=""> Select User Type</option>
		<option value="normal">Normal</option>
		<option value="vip">Vip</option>
		</select>
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="basicinput">Gift 	Coins</label>
		<div class="controls">
		<input type="text"   name="gift_coins" id="gift_coins" class="span8 tip" placeholder="Enter Gift Coins Value" required>
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="basicinput">Game Coins</label>
		<div class="controls">
		<input type="text"   name="game_coins" id="game_coins" class="span8 tip" placeholder="Enter Game Coins Value" required>
		</div>
		</div>

		<div class="control-group">
			<div class="controls">
			<?php $_SESSION["csrf_token"] = md5(rand(0,10000000)).time(); ?>
					  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION["csrf_token"]);?>">
				<button type="submit" name="submit" class="btn btn-success">Create</button>
			</div>
		</div>
		</form>
		
		
        </div>
      </div>
    </div>
	</div>-->
	
	
	<div class="row-fluid">
	<div class="span11">
  
        <div class="widget-box">
		 <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
             <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="Manage Daily Transfer Coins Value On User Login">
          </div>
      
           <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
            <table class="table table-bordered data-table">
            <thead>
										<tr>
											<th>#</th>
											<th>User Type</th>
											<th>Gift Coins</th>
											<!--<th>Active</th>-->
											<th>Action</th>
										</tr>
		  </thead>
             <tbody>

			<?php $query=mysqli_query($con,"select * from  coins_transfer_value");
			$cnt=1;
			while($row=mysqli_fetch_array($query)) {
			$id=$row['id'];
			?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['user_type']);?></td>
											<td> <?php echo htmlentities($row['gift_coins']);?></td>
											<!--<td class="">
											// <?php $stylepopular= ''; $stylenotpopular= '';?>
											// <?php 
											// if($row['is_active']==0)
											// {
												// $stylepopular= "style= display:none";
											// }
											
											// if($row['is_active']==1)
											// {
												// $stylenotpopular= "style= display:none";
											// }
											
											// ?>
				                          <img id="imgnotpopular<?php echo $row['id']; ?>" onclick="funisactive(<?php echo $row['id']; ?>,1,'coins_transfer_value');" src='images/off.png' width='60' <?php echo $stylenotpopular;?> />
				                          <img id="imgpopular<?php echo $row['id']; ?>" onclick="funisactive(<?php echo $row['id']; ?>,0,'coins_transfer_value');" src='images/on.png'  width='60' <?php echo $stylepopular;?> />
										  </td>-->
										  <td>
											<a href="edit_transfer_coins_value.php?id=<?php echo toPublicId($row['id']);?>" ><i class="fa fa-edit"></i></a>
											<a href="transfer_coins_value.php?id=<?php echo toPublicId($id);?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a></td>
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
 
  $("#transfer_coins").validate({
    
        // Specify the validation rules
		rules : { 
		 user_type: {
            required: true
            },
		gift_coins: {
            required: true,
			digits: true
            }
       },
        // Specify the validation error messages
        messages: {
            user_type: "Please select user type"
			
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
