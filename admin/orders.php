<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin| Manage Orders</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
</head>
<body>

<?php require_once('include/header.php');?>

<?php require_once('include/sidebar.php');?>
<div id="content">
<div id="myModal" class="modal fade">
 <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Update Order</h4>
      </div>
  <div class="modal-dialog modal-lg" style="max-width:100%;" id="res">
<?php //require_once('update_order.php');?>
  </div>
   <div class="modal-footer"></div>
</div>
<div id="amzmyModal" class="modal fade">
 <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Update Order</h4>
      </div>
  <div class="modal-dialog modal-lg" style="max-width:100%;" id="amz_res">
  </div>
   <div class="modal-footer"></div>
</div>
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current"> Manage Orders</a> </div>
  </div>
  <div class="container-fluid">
   
    <div class="row-fluid">
      <div class="span12">
  
        <div class="widget-box">
         <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
             <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseone" value="View E-Gift Orders">
          </div>
          <div class="widget-content nopadding panel-collapse collapse in" id="collapseone">
		  <div class="alert alert-success" id="successMessage" style="display:none;">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	Your order has been updated successfully.
									
		  </div>
		  <?php if(isset($_GET['del'])) {?>
				<div class="alert alert-error">
					<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
				</div>
		<?php } ?>
            <table class="table table-bordered data-table">
             <thead>
										<tr>
											<th>#</th>
											<th> Name</th>
											<th width="50">Email /Contact no</th>
											<th>Shipping Address</th>
											<th>Product </th>
											<th>Qty </th>
											<th>Amount (In $) </th>
											<th>Status </th>
											<th>Order Date</th>
											<th>Action</th>					
									 </tr>
			</thead>
              <tbody>

									<?php 
									$status='Delivered';
									$query=mysqli_query($con,"select users.name as username,users.email as useremail,users.contactno as usercontact,users.shippingAddress as shippingaddress,users.shippingCity as shippingcity,users.shippingState as shippingstate,users.shippingPincode as shippingpincode,
									products.productName as productname,products.shippingCharge as shippingcharge,
									orders.quantity as quantity,orders.orderDate as orderdate,orders.orderStatus as orderStatus,
									products.productPrice as productprice,orders.id as id  from orders join users on  orders.userId=users.id join products on products.id=orders.productId order by orders.orderDate desc ");
									$cnt=1;
									
									while($row=mysqli_fetch_array($query)) //print_r($query);
									{ ?>								
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['username']);?></td>
											<td><?php echo htmlentities($row['useremail']);?>/<?php echo htmlentities($row['usercontact']);?></td>
										
											<td><?php echo htmlentities($row['shippingaddress'].",".$row['shippingcity'].",".$row['shippingstate']."-".$row['shippingpincode']);?></td>
											<td><?php echo htmlentities($row['productname']);?></td>
											<td><?php echo htmlentities($row['quantity']);?></td>
											<td><?php echo htmlentities($row['quantity']*$row['productprice']);?></td>
											<td><?php echo htmlentities($row['orderStatus']);?></td>
											<td><?php echo htmlentities($row['orderdate']);?></td>
											<td> 
											<button type="button" class="btn btn-info btn ord_btn" data-toggle="modal" data-target="#myModal" id="<?php echo htmlentities($row['id']);?>">Update</button>
											</td>
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
             <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="View Amazon Self Orders">
          </div>
          <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
		  <?php if(isset($_GET['del'])) {?>
				<div class="alert alert-error">
					<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
				</div>
		<?php } ?>
            <table class="table table-bordered data-table">
             <thead>
										<tr>
											<th>#</th>
											<th> Name</th>
											<th width="50">Email</th>
											<th>Shipping Address</th>
											<th>Product </th>
											<th>Product Url</th>
											<th>Amount (In $) </th>
											<th>Status </th>
											<th>Order Date</th>
											<th>Action</th>
											<th>View Ticket</th>	
									 </tr>
			</thead>
              <tbody>

									<?php 
									$status='Delivered';
									$query=mysqli_query($con,"select tbl_amazon_orders.full_name as username,tbl_amazon_orders.email_for_order as useremail,tbl_amazon_orders.shipping_address as shippingaddress,	tbl_amazon_orders.product_name as product_name,tbl_amazon_orders.product_url as product_url,tbl_amazon_orders.product_price as product_price,
									tbl_amazon_orders.order_date as order_date,tbl_amazon_orders.order_status as order_status,tbl_amazon_orders.ticket_id as ticket_id,
									tbl_amazon_orders.id as id  from tbl_amazon_orders join users on  tbl_amazon_orders.user_id=users.id order by tbl_amazon_orders.order_date desc");
									$cnt=1;
									
									while($row=mysqli_fetch_array($query)) //print_r($query);
									{ $url= $row['product_url'];
                                      $ticket_id= $row['ticket_id'];
									  $decryped_id = urlencode(base64_encode("$ticket_id"));?>								
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['username']);?></td>
											<td><?php echo htmlentities($row['useremail']);?></td>
											<td><?php echo htmlentities($row['shippingaddress']);?></td>
											<td><?php echo htmlentities($row['product_name']);?></td>
											<td><a href="<?php echo $url;?>" target="_blank"/><?php echo substr($url,0,50);?></a></td>
											<td><?php echo htmlentities($row['product_price']);?></td>
											<td><?php echo htmlentities($row['order_status']);?></td>
											<td><?php echo htmlentities($row['order_date']);?></td>
											<td>
											<button type="button" class="btn btn-info btn amz_btn" data-toggle="modal" data-target="#amzmyModal" id="<?php echo htmlentities($row['id']);?>">Update</button>
											</td>
											<td><a href="ticket_view.php?id=<?php echo $decryped_id;?>" class="btn btn-primary addtocart">Reply</a></td>
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
<script>
//$(document).ready(function(){
	  $('.ord_btn').click(function(){
		  var idorder = $(this).attr('id');
		  //alert(idorder);
		  $.ajax({  
								type: "POST",
								dataType: "text",
								url: "update_order.php",
								data: "idorder=" + idorder,
								success: function(data){
								//$('#myModal').modal('show');
							     $("#res").html(data);
							},
							
					});
		  
});

 $('.amz_btn').click(function(){
		  var idorder_amz = $(this).attr('id');
		  $.ajax({  
								type: "POST",
								dataType: "text",
								url: "update_amazon_order.php",
								data: "idorder_amz=" + idorder_amz,
								success: function(data){
								//$('#myModal').modal('show');
							     $("#amz_res").html(data);
							},
							
					});
		  
});
 //});
</script>
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