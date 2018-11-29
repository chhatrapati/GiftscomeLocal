<?php
session_start();
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['name'])==0)
	{	
header('location:user_login.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
$uid=toInternalId($_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin| Manage Users</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
</head>
<body>

<?php require_once('include/user_header.php');?>

<?php require_once('include/userlogin_sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="welcome_user.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current"> User Profile</a> </div>
    <h1>User Profile</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
  
        <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>User Profile</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered">
             <thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Email </th>
											<th>Profile Picture</th>
											<th>Contact no</th>
											<th>Game Coins</th>
											<th>Gift Coins</th>
											<th>Shippping Address/City/State/Pincode </th>
											<th>Billing Address/City/State/Pincode </th>
											<th>Action </th>
										
										</tr>
			</thead>
              <tbody>

									<?php
                                    $uid=toInternalId($_GET['id']);									
									$query=mysqli_query($con,"select * from users where id = '".$uid."'");
									$cnt=1;
									while($row=mysqli_fetch_array($query))
									{
										
									?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											
											<td><?php echo htmlentities($row['name']);?></td>
											<td><?php echo htmlentities($row['email']);?></td>
											<td><img src="/users-images/<?php echo $row['user_picture'];?>"  width="100px" height="100px"></td>
											<td> <?php echo htmlentities($row['contactno']);?></td>
										
											<td><?php echo htmlentities($row['game_coins']);?></td>
											<td><?php echo htmlentities($row['gift_coins']);?></td>
											<td><?php echo htmlentities($row['shippingAddress'].",".$row['shippingCity'].",".$row['shippingState']."-".$row['shippingPincode']);?></td>
											<td><?php echo htmlentities($row['billingAddress'].",".$row['billingCity'].",".$row['billingState']."-".$row['billingPincode']);?></td>
											<td>
											<a href="edit-view-user.php?id=<?php echo toPublicId($row['id']);?>" ><i class="fa fa-edit"></i></a>											
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
</body>
</html>

