<?php
session_start();
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else
{ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Ticket Management | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Tickets</a> </div>
</div>
<div class="container-fluid">
	<div class="row-fluid">
	<div class="span11">
        <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="View Tickets">
          </div>
          <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
		  <table id="" class="table table-bordered data-table" >
                  <thead>
                    <tr>
                      <th>ticket Id</th>
					  <th>User Name</th>
					  <th>Subject</th>
					  <th>Message</th>
					  <th>Attachment</th>
                      <th>Create Date</th>
					  <th>Reply</th>
                    </tr>
                  </thead>
				 	<?php
						$select_tic = mysqli_query($con,"SELECT * FROM `tickets` left join users on users.id = tickets.user_id ORDER BY `ticket_id` DESC");
								while ($row = $select_tic->fetch_assoc()) {
									 $ticket_id = $row['ticket_id'];
									 $user_id = $row['user_id'];
									 $user_name = $row['name'];
									 $sub = $row['sub'];
									 $message = $row['message'];
									 $attachment = $row['attachment'];
									 $created_at = $row['created_at'];
					?>
                  <tr>
                    <td><?php echo $ticket_id;?></td>
                    <td><?php echo $user_name;?></td>
                    <td><?php echo substr($sub,0,50);?></td>
                    <td><?php echo substr($message,0,20);?>...</td>
					<td>
					<?php if($attachment!=''){?>
					<a download="../uploads/tickets/<?php echo $attachment;?>" href="../uploads/tickets/<?php echo $attachment;?>" target="_blank">View Attachment</a>
					<?php } else {?>
					--
					<?php }?>
					</td>
 					<td><?php echo $created_at;?></td>
					<?php $decryped_id = urlencode(base64_encode("$ticket_id")); ?>
					<?php 
						$status_query = "SELECT * FROM comments WHERE comment_status=0 and ticket_id = '$ticket_id'";
						$result_query = mysqli_query($con, $status_query);
						$count = mysqli_num_rows($result_query); 
					?>
					<td id="reply<?php echo $decryped_id; ?>"><a href="ticket_view.php?id=<?php echo $decryped_id;?>" class="btn btn-primary addtocart">Reply</a>
					<?php if($count > 0 ) { ?>
					<span class="label label-pill label-danger count" style="border-radius:10px;position: relative;top: -20px;right: 10px;"><?PHP echo $count; ?> </span><?php } ?></td>
                  </tr>
                  <?php } ?>
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
 $(document).ready(function(){
        setTimeout(function() {
          $('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    });
</script>
</body>
</html>
<?php }?>
