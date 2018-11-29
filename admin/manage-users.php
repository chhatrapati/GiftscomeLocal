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

<?php require_once('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current"> Manage Users</a> </div>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
  
        <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseOne" value="View All Users">
        </div>
          <div class="widget-content nopadding panel-collapse collapse in" id="collapseOne">
            <table class="table table-bordered data-table">
             <thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Nick Name</th>
											<th>User Type</th>
											<th>Email </th>
											<th>Contact No. </th>
											<th>Gender</th>
											<th>Profile Picture</th>
											<!--<th>Game Coins</th>-->
											<th>Gift Coins</th>
											<th>Shippping Address/City/State/Pincode </th>
											<th>Registration Date </th>
											<th>Active</th>
											<th>Action </th>
										
										</tr>
			</thead>
              <tbody>

									<?php $query=mysqli_query($con,"select * from users");
									$cnt=1;
									while($row=mysqli_fetch_array($query))
									{
									?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											
											<td><!--<a href="view_user.php?id=<?php //echo toPublicId($row['id']);?>">--><?php echo htmlentities($row['name']);?><!--</a>--></td>
											<td><?php echo htmlentities($row['nick_name']);?></td>
											<td><?php if($row['user_type']=='normal'){ $type = 'Normal';} else {  $type = 'VIP';} echo $type;?></td>
											<td><?php echo htmlentities($row['email']);?></td>
											<td> <?php echo htmlentities($row['contactno']);?></td>
											<td> <?php echo htmlentities($row['gender']);?></td>
											<td>
											<?php if($row['social_id']!=''){?>
											<img src="<?php echo $row['user_picture'];?>"  width="100px" height="100px">
											<?php } else {?>
											<img src="/users-images/<?php echo $row['user_picture'];?>"  width="100px" height="100px">
											<?php }?>
											</td>
											<!--<td><?php //echo htmlentities($row['game_coins']);?></td>-->
											<td><?php echo htmlentities($row['gift_coins']);?></td>
											<td><?php echo htmlentities($row['shippingAddress'].",".$row['shippingCity'].",".$row['shippingState']."-".$row['shippingPincode']);?></td>
											<td><?php echo htmlentities($row['regDate']);?></td>
											<td class="">
											 <?php $stylepopular= ''; $stylenotpopular= '';?>
											<?php 
											if($row['is_active']==0)
											{
												$stylepopular= "style= display:none";
											}
											
											if($row['is_active']==1)
											{
												$stylenotpopular= "style= display:none";
											}
											
											?>
				                          <img id="imgnotpopular<?php echo $row['id']; ?>" onclick="funisactive(<?php echo $row['id']; ?>,1,'users');" src='images/off.png' width='60' <?php echo $stylenotpopular;?> />
				                          <img id="imgpopular<?php echo $row['id']; ?>" onclick="funisactive(<?php echo $row['id']; ?>,0,'users');" src='images/on.png'  width='60' <?php echo $stylepopular;?> />
										  </td>
											<td>
											<a href="manage-user_coins.php?id=<?php echo toPublicId($row['id']);?>">Manage Coins</a> 
											<a href="manage-users.php?id=<?php echo toPublicId($row['id']);?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a></td>
											
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
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="View all users who registered using referal code">
        </div>
          <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
            <table class="table table-bordered data-table">
             <thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>User Type</th>
											<th>Email </th>
											<th>Gift Coins</th>
											<th>Registered by using referal code of</th>
											<th>Registration Date </th>
											<th>Ip Address</th>
											<th>Active</th>
											<th>Action </th>
										
										</tr>
			</thead>
              <tbody>

									<?php $query=mysqli_query($con,"select * from users where refer_by!=''");
									$cnt=1;
									while($row=mysqli_fetch_array($query))
									{
										$refer_by_user= $row['refer_by'];
										$query_12=mysqli_query($con,"select name from users where id='$refer_by_user'");
										$result12=mysqli_fetch_array($query_12);
										$refer_by_name = $result12['name'];
									?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											
											<td><!--<a href="view_user.php?id=<?php //echo toPublicId($row['id']);?>">--><?php echo htmlentities($row['name']);?><!--</a>--></td>
											<td><?php if($row['user_type']=='normal'){ $type = 'Normal';} else {  $type = 'VIP';} echo $type;?></td>
											<td><?php echo htmlentities($row['email']);?></td>
											<td><?php echo htmlentities($row['gift_coins']);?></td>
											<td><?php echo $refer_by_name;?></td>
											<td><?php echo htmlentities($row['regDate']);?></td>
											<td><?php echo htmlentities($row['refer_by_ip']);?></td>
											<td class="">
											 <?php $stylepopular= ''; $stylenotpopular= '';?>
											<?php 
											if($row['is_active']==0)
											{
												$stylepopular= "style= display:none";
											}
											
											if($row['is_active']==1)
											{
												$stylenotpopular= "style= display:none";
											}
											
											?>
				                          <img id="imgnotpopular<?php echo $row['id']; ?>" onclick="funisactive(<?php echo $row['id']; ?>,1,'users');" src='images/off.png' width='60' <?php echo $stylenotpopular;?> />
				                          <img id="imgpopular<?php echo $row['id']; ?>" onclick="funisactive(<?php echo $row['id']; ?>,0,'users');" src='images/on.png'  width='60' <?php echo $stylepopular;?> />
										  </td>
											<td>
											<a href="manage-user_coins.php?id=<?php echo toPublicId($row['id']);?>">Manage Coins</a> 
											<a href="manage-users.php?id=<?php echo toPublicId($row['id']);?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a></td>
											
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
<script>
		
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
</script>
</body>
</html>
<?php }?>
