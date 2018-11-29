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
	$category=$_POST['category'];
	$description=$_POST['description'];
$sql=mysqli_query($con,"insert into category(categoryName,categoryDescription) values('$category','$description')");
$_SESSION['msg']="Category Created !!";

}

if(isset($_GET['del']))
		  {
		          $cat_id = toInternalId($_GET['id']);
				  mysqli_query($con,"delete from category where id = '".$cat_id."'");
                  $_SESSION['delmsg']="Category deleted !!";?>
				  <script type="text/javascript">
					setTimeout(function () {
					var basepath = window.location.protocol + '//' + window.location.hostname;
					var path = basepath + '/admin/category.php';
					window.location.href= path; // the redirect goes here
					},1000); // 5 seconds
				</script>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Category | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Support Compose</a> </div>
</div>
<div class="container-fluid">
  <hr>

   
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

          <a href="support_inbox.php" class="btn btn-success">Support Inbox</a>


		<form class="form-horizontal" name="Category" id="compose" method="post"  enctype="multipart/form-data" >
		<?php
		     if (isset($_SESSION['id'])) {
                         $member_id = $_SESSION['id'];
                        }

		                $query = "SELECT * FROM  admin where id='$member_id'";
						$result = mysqli_query($con, $query) or die(mysqli_error($con));
                        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {

                           $user_id = $row['id'];
                           $name = $row['username'];
							$_SESSION['username']=$row['username'];
						}
                            ?>
									
		<div class="control-group">
		<label class="control-label" for="basicinput">Select Users</label>
		<select name="category" id="user" style="margin-left: 26px;width: 46.5%;">
		<option value="">Select Users For Message</option> 
		<?php $query=mysqli_query($con,"select * from users");
		while($row=mysqli_fetch_array($query))
		{?>
		 <option value="<?php echo $row['id'].'_'.$row['name'];?>"><?php echo $row['name'];?></option>
		<?php } ?>
		</select>
		</div>
	


		<div class="control-group">
		<label class="control-label" for="basicinput">Description</label>
		<div class="controls">
		<textarea class="span8" name="reciver_msg" id="description" rows="5"></textarea>
		</div>
	    </div>

		<div class="control-group">
			<div class="controls">
	
				<button type="submit" name="submit" class="btn btn-success">Send</button>
			</div>
		</div>
		</form>
			<div id="results"></div>
		
	
  </div>
  
</div>
<!--Footer-part-->
<?php require_once('include/footer.php');?>
<!--end-Footer-part--> 
<?php require_once('include/common_js.php');?>
<script type="text/javascript">
$(document).ready(function() {
	$("#compose").submit(function() {	

    	
		$.ajax({
			type: "POST",
			url: 'send_compose.php',
			data:$("#compose").serialize(),
			success: function (data) {	
				// Inserting html into the result div on success
				$('#results').html(data);
			},
			error: function(jqXHR, text, error){
            // Displaying if there are any errors
            	$('#result').html(error);           
        }
    });
		return false;
	});
});
</script>
</script>
</body>
</html>
<?php }?>