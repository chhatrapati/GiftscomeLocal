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

if(isset($_GET['del']))
		  {
		          $id = toInternalId($_GET['id']);
				  mysqli_query($con,"delete from users where id = '".$id."'");
                  $_SESSION['delmsg']="User deleted !!";
		  }
if(isset($_REQUEST["up"])){
       $up = $_REQUEST["up"];
       $query=mysqli_query($con,"UPDATE users SET  is_active='0' WHERE id='$up'");
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   } 
    if(isset($_REQUEST["down"])){
       $down = $_REQUEST["down"];
       $query=mysqli_query($con,"UPDATE users SET  is_active='1' WHERE id='$down'");
       header('Location: ' . $_SERVER['HTTP_REFERER']);
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
<?php require_once('include/header.php');?>
<!--sidebar-menu-->
<?php require_once('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current"> Manage Users</a> </div>
    <h1>User's Full Profile</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
  
        <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5><a href="manage-users.php">BACK TO MANAGE USERS</a></h5>
          </div>
          <div class="widget-content nopadding">
		  
           <table class="table table-bordered table-striped">
             <thead>	
			</thead>
              <tbody> 
				<?php
			 
			$id=toInternalId($_GET['id']);
			$query = mysqli_query($con,"select * from users where id=$id");
			while ($row = mysqli_fetch_array($query))
			{
				$user_name=$row['name'];
				$nick_name=$row['nick_name'];
				$email=$row['email'];
				$contactno=$row['contactno'];
				$gender=$row['gender'];
				$game_coins=$row['game_coins'];
				$gift_coins=$row['gift_coins'];
				$shippingAddress=$row['shippingAddress'];
				$shippingState=$row['shippingState'];
				$shippingCity=$row['shippingCity'];
				$shippingPincode=$row['shippingPincode'];
				$billingAddress=$row['billingAddress'];
				$billingState=$row['billingState'];
				$billingCity=$row['billingCity'];
				$billingPincode=$row['billingPincode'];
											
	?> 
					<tr>
						 <th>Name</th>    
						  <td><?php echo $user_name;?> </td>      
					</tr>
					<tr>
						 <th>Nick Name</th>    
						  <td><?php echo $nick_name;?> </td>      
					</tr>     
					<tr>         
						 <th>Email</th>   
						  <td><?php echo $email;?> </td>  
					</tr>    
					<tr>         
						   <th>Contact No</th>   
						 <td><?php echo $contactno;?> </td>   
					</tr>

					<tr>
						<th>Gender</th>    
						<td><?php echo $gender;?> </td>      
					</tr>
					<tr>
						<th>Profile Picture</th>    
					   <td><img src="/users-images/<?php echo $row['user_picture'];?>"  width="100px" height="100px"></td>         
					</tr>
					<tr>         
						<th>Game Coins</th>   
						 <td><?php echo $game_coins;?> </td>  
					</tr> 
					<tr>         
						<th>Gift Coins</th>   
						 <td><?php echo $gift_coins;?> </td>  
					</tr> 

					<tr>         
						<th>Shipping Address</th>   
						 <td><?php echo $shippingAddress;?> </td>  
					</tr>    
					<tr>         
							<th>Shipping State</th>    
						  <td><?php echo $shippingState;?> </td>    
					</tr>     
					<tr>
						<th>Shipping City</th>   
						 <td><?php echo $shippingCity;?> </td>      
					</tr>     
					<tr>         
							<th>Shipping Pincode</th>     
						  <td><?php echo $shippingPincode;?> </td>  
					</tr>    
					<tr>         
							<th>Billing Address</th>    
						  <td><?php echo $billingAddress;?> </td>   
					</tr>

					<tr>
						 <th>Billing State</th>    
						  <td><?php echo $billingState;?> </td>      
					</tr>     
					<tr>         
					   <th>Billing City</th>   
						<td><?php echo $billingCity;?> </td>  
					</tr>    
					<tr>         
						   <th>Billing Pincode</th>  
						 <td><?php echo $billingPincode;?> </td>   
					</tr>
  <?php } ?> 						
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
</body>
</html>
<?php }?>
