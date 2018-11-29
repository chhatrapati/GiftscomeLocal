<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin|Users logs</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
</head>
<body>

<?php require_once('include/header.php');?>

<?php require_once('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Users Log</a> </div>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
  
        <div class="widget-box">
		<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseOne" value="View All Users Log">
        </div>
       
          <div class="widget-content nopadding panel-collapse collapse in" id="collapseOne">
            <table class="table table-bordered data-table">
             <thead>
										<tr>
											<th>#</th>
											<th> User Email</th>
											<th>User IP </th>
											<th>Login Time</th>
											<th>Logout Time </th>
											<th>Status </th>
											
										</tr>
			</thead>
              <tbody>

									<?php $query=mysqli_query($con,"select * from userlog");
									$cnt=1;
									while($row=mysqli_fetch_array($query)) { ?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['userEmail']);?></td>
											<td><?php echo htmlentities($row['userip']);?></td>
											<td> <?php echo htmlentities($row['loginTime']);?></td>
											<td><?php echo htmlentities($row['logout']); ?></td>
										<td><?php $st=$row['status'];
										if($st==1)
										{
											echo "Successfull";
										}
										else
										{
											echo "Failed";
										}
										 ?></td>
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
</body>
</html>
<?php }?>
