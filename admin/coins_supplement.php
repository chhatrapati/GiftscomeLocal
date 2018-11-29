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
	$gift_coins_value=$_POST['gift_coins_value'];
	$minimum_gift_coins_value=$_POST['minimum_gift_coins_value'];
	$daily_click_button_limit=$_POST['daily_click_button_limit'];
    $sql=mysqli_query($con,"insert into coins_supplement(user_type,gift_coins_value,minimum_gift_coins_value,daily_click_button_limit) values('$user_type','$gift_coins_value','$minimum_gift_coins_value','$daily_click_button_limit')");
    $_SESSION['msg']="Coins Supplement Record Added!!";

}
if(isset($_POST['update']) && @$_SESSION["csrf_token_12"] == @$_POST['csrf_token_12'])
{
	$coins_by_register=$_POST['coins_by_register'];
	$coins_by_social_share=$_POST['coins_by_social_share'];
	$coins_by_refer_code=$_POST['coins_by_refer_code'];	
	$sql=mysqli_query($con,"update coins_reward_method set coins_by_register='$coins_by_register',coins_by_social_share='$coins_by_social_share',coins_by_refer_code='$coins_by_refer_code' ");
	$_SESSION['msg12']="Records Updated Successfully !!";

}
if(isset($_GET['del']))
		  {
		          $id = toInternalId($_GET['id']);
				  mysqli_query($con,"delete from coins_supplement where id = '".$id."'");
                  $_SESSION['delmsg']="Coins Supplement Record deleted !!";?>
				   <script type="text/javascript">
					setTimeout(function () {
					var basepath = window.location.protocol + '//' + window.location.hostname;
					var path = basepath + '/admin/coins_supplement.php';
					window.location.href= path; // the redirect goes here
					},1000); // 5 seconds
				</script>
				
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Coins Supplement | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Coins Supplement To Users</a> </div>
</div>
<div class="container-fluid">
   <!--<div class="row-fluid">
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
          <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseOne" value="Add Coins Transfer Value">
        </div>
       <div class="widget-content nopadding panel-collapse collapse" id="collapseOne">
		<form class="form-horizontal" name="coins_supplement" id="coins_supplement" method="post"  enctype="multipart/form-data" >
									
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
		<label class="control-label" for="basicinput">Gift 	Coins Value</label>
		<div class="controls">
		<input type="text"   name="gift_coins_value" id="gift_coins_value" class="span8 tip" placeholder="Enter Gift Coins Value" required>
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="basicinput">Minimum No Of Gift Coins Limit</label>
		<div class="controls">
		<input type="text"   name="minimum_gift_coins_value" id="minimum_gift_coins_value" class="span8 tip" placeholder="Enter Minimum No Of Gift Coins Limit" required>
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Daily Click Time limit Of Button</label>
		<div class="controls">
		<input type="text"   name="daily_click_button_limit" id="daily_click_button_limit" class="span8 tip" placeholder="Enter Daily Click Time limit Of Button" required>
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
	</div>-->
	
	
	<div class="row-fluid">
	<div class="span11">
  
        <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
             <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="Manage Daily Gift Coins Supplement Value On  Click">
          </div>
          <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
            <table class="table table-bordered data-table">
            <thead>
										<tr>
											<th>#</th>
											<th>User Type</th>
											<th>Gift Coins Value</th>
											<th>Minimum No Of Gift Coins Limit</th>
											<th>Number of request time (In a day)</th>
											<!--<th>Active</th>-->
											<th>Action</th>
										</tr>
		  </thead>
             <tbody>

			<?php $query=mysqli_query($con,"select * from  coins_supplement");
			$cnt=1;
			while($row=mysqli_fetch_array($query)) {
			$id=$row['id'];
			?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['user_type']);?></td>
											<td><?php echo htmlentities($row['gift_coins_value']);?></td>
											<td> <?php echo htmlentities($row['minimum_gift_coins_value']);?></td>
											<td> <?php echo htmlentities($row['daily_click_button_limit']);?></td>
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
				                          <img id="imgnotpopular<?php echo $row['id']; ?>" onclick="funisactive(<?php echo $row['id']; ?>,1,'coins_supplement');" src='images/off.png' width='60' <?php echo $stylenotpopular;?> />
				                          <img id="imgpopular<?php echo $row['id']; ?>" onclick="funisactive(<?php echo $row['id']; ?>,0,'coins_supplement');" src='images/on.png'  width='60' <?php echo $stylepopular;?> />
										  </td>-->
										  <td>
											<a href="edit_coins_supplement.php?id=<?php echo toPublicId($row['id']);?>" ><i class="fa fa-edit"></i></a>
											<a href="coins_supplement.php?id=<?php echo toPublicId($id);?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
				</tbody>				
            </table>
          </div>
        </div>
      </div>
    </div>
	
	 <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
         <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
             <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapse3" value="Manage Gift Coins Rewards">
          </div>
        <div class="widget-content nopadding panel-collapse collapse in" id="collapse3">
		<?php if(!empty($_SESSION['msg12'])){?>
									<div class="alert alert-success" id="successMessage">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg12']);?><?php echo htmlentities($_SESSION['msg12']="");?>
									<script type="text/javascript">
									 setTimeout(function () {
									},1000); // 5 seconds
									</script>
									</div>
		<?php } ?>
        <form class="form-horizontal" name="coins_reward" id="coins_reward" method="post" enctype="multipart/form-data">
		<?php 
		$query=mysqli_query($con,"select * from coins_reward_method");
		$cnt=1;
		while($row=mysqli_fetch_array($query)) {?>
			
			<div class="control-group">
			<label class="control-label" for="basicinput">Gift Coins On User Register</label>
			<div class="controls">
			<input type="text"  name="coins_by_register" id="coins_by_register"  placeholder="Enter Gift Coins Value On User Register" value="<?php echo htmlentities($row['coins_by_register']);?>" class="span11" required>
			</div>
			</div>
			
			<div class="control-group">
			<label class="control-label" for="basicinput">Gift Coins On Social Share</label>
			<div class="controls">
			<input type="text"  name="coins_by_social_share" id="coins_by_social_share"  placeholder="Enter Gift Coins Value On Social Share" value="<?php echo htmlentities($row['coins_by_social_share']);?>" class="span11" required>
			</div>
			</div>
			
			<div class="control-group">
			<label class="control-label" for="basicinput">Gift Coins By Refer To Friend & Register By Referal Code</label>
			<div class="controls">
			<input type="text"  name="coins_by_refer_code" id="coins_by_refer_code"  placeholder="Enter Gift Coins Value On Social Share" value="<?php echo htmlentities($row['coins_by_refer_code']);?>" class="span11" required>
			</div>
			</div>

		<?php } ?>
	<div class="control-group">
			<div class="controls">
			<?php $_SESSION["csrf_token_12"] = md5(rand(0,10000000)).time(); ?>
			<input type="hidden" name="csrf_token_12" value="<?php echo htmlspecialchars($_SESSION["csrf_token_12"]);?>">
			<button type="submit" name="update" class="btn btn-success">Update</button>
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
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 
  $("#coins_supplement").validate({
    
        // Specify the validation rules
		rules : { 
		 user_type: {
            required: true
            },
		gift_coins_value: {
            required: true,
			digits: true
            },
	    minimum_gift_coins_value: {
            required: true,
			digits: true
            },
	   daily_click_button_limit: {
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
	
	$("#coins_reward").validate({
    
        // Specify the validation rules
		rules : { 
		 coins_by_register: {
            required: true,
			digits: true
            },
		coins_by_social_share: {
            required: true,
			digits: true
            }
	   
       },
        // Specify the validation error messages
        messages: {
           coins_by_register: {required:"Please enter coins value",digits:"Please enter digits only"},
			coins_by_social_share: {required:"Please enter coins value",digits:"Please enter digits only"},
			
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
