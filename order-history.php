<?php 
session_start();
//error_reporting(0);
include('includes/config.php');
if (!isset($_SESSION['login']))
    {   
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
header('location:login.php');
}
else{

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="">
	    <meta name="robots" content="all">
       <title>Order History</title>
	   <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<?php require_once('templates/common_css.php');?>	
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/main.css">
<?php require_once('templates/datatable_css.php');?>
</head>
<body class="animsition">
<?php require_once('templates/header.php');?>
<!-- ============================================== HEADER : END ============================================== -->
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
		<h2 class="l-text2 t-center">
			Order History
		</h2>
	</section>
<section class="bgwhite p-t-66 p-b-38">
		<div class="container">
		<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <a href="my-account.php"><button type="button" name="" class="btn-upper btn btn-primary checkout-page-button">BACK TO MY ACCOUNT</button> </a>
			
          </div>
			<div class="body-content outer-top-bd">
				<div class="container">
					<div class="checkout-box inner-bottom-sm">
						<div class="row">
<div class="col-md-12">
<div id="myModal" class="modal fade" role="dialog" style="z-index:99999;">
  <div class="modal-dialog modal-lg" style="max-width:100%;" id="res">
  </div>
</div>
<div id="amzmyModal" class="modal fade">
  <div class="modal-dialog modal-lg" style="max-width:100%;" id="amz_res">
  </div>
</div>
<div class="panel-group checkout-steps" id="accordion">	
<!-- checkout-step-02  -->
<div class="panel panel-default checkout-step-02">
	<!-- panel-heading -->
	<div class="panel-heading">
		<h4 class="unicase-checkout-title">
			<a data-toggle="collapse" class="collapsed in" data-parent="#accordion" href="#collapseTwo">
				<span>1</span>View E- Gift Card Orders
			</a>
		</h4>
	</div>
	<!-- panel-heading -->
	<div id="collapseTwo" class="panel-collapse collapse show">
		<!-- panel-body  -->
		<div class="panel-body">
			<div class="row">		
				<div class="col-md-12 col-sm-12 already-registered-login coin-balance">
			<table id="example" class="display nowrap"  cellspacing="0" width="100%">
					<thead class="u_g_h">
					<tr>
					<th class="">#</th>
					<th class="">Order Id</th>
					<th class="">Image</th>
					<th class="">Product Name</th>
					<th class="">Quantity</th>
					<th class="">Price</th>
					<th class="">Grandtotal</th>
					<th class="">Order Date</th>
					<th class="">Action</th>
				</tr>
					</thead>
					<tbody>
						<?php
						$query=mysqli_query($con,"select products.productImage1 as pimg1,products.productName as pname,orders.productId as opid,orders.quantity as qty,products.productPrice as pprice,products.shippingCharge as shippingcharge,orders.paymentMethod as paym,orders.orderDate as odate,orders.id as orderid from orders join products on orders.productId=products.id where orders.userId='".$_SESSION['id']."'");
						$cnt=1;
						while($row=mysqli_fetch_array($query))
						{?>	
							<tr>
							<td><?php echo $cnt;?></td>
							<td><?php echo $row['orderid'];?></td>
							<td class="cart-image">
								<a class="entry-thumbnail">
									<img src="admin/productimages/<?php echo $row['pname'];?>/<?php echo $row['pimg1'];?>" alt="" width="100">
								</a>
							</td>
							<td class="cart-product-name-info"><?php echo $row['pname'];?></td>
							<td class="cart-product-quantity"><?php echo $qty=$row['qty']; ?></td>
							<td class="cart-product-sub-total"><?php echo $price=$row['pprice']; ?></td>
							<td class="cart-product-grand-total"><?php echo ($qty*$price);?></td>
							<td class="cart-product-sub-total"><?php echo $row['odate']; ?>  </td>
							<td> <button type="button" class="btn btn-info btn ord_btn" data-toggle="modal" data-target="#myModal" id="<?php echo htmlentities($row['orderid']);?>">Track</button></td>
						   </tr>
                  <?php $cnt=$cnt+1;} ?>			
						</tbody>				
					</table> 
				</div>	
				<!-- already-registered-login -->		
			</div>			
		</div>
		<!-- panel-body  -->
	</div><!-- row -->
</div>
<!-- checkout-step-02  -->
<div class="panel panel-default checkout-step-02">
	<!-- panel-heading -->
	<div class="panel-heading">
		<h4 class="unicase-checkout-title">
			<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapse3">
				<span>2</span>View Amazon Self Selected Orders
			</a>
		</h4>
	</div>
	<!-- panel-heading -->
	<div id="collapse3" class="panel-collapse collapse ">
		<!-- panel-body  -->
		<div class="panel-body">
			<div class="row">		
				<div class="col-md-12 col-sm-12 already-registered-login coin-balance">
			<table id="example1" class="display nowrap"  cellspacing="0" width="100%">
					<thead class="u_g_h">
					<tr>
					<th class="">#</th>
					<th class="">Order Id</th>
					<th class="">Product Name</th>
					<th class="">Product Url</th>
					<th class="">Price (In $)</th>
					<th class="">Order Date</th>
					<th class="">Action</th>
					<th class="">View Ticket</th>
				</tr>
					</thead>
					<tbody>
						<?php
						$query=mysqli_query($con,"select tbl_amazon_orders.id as id,tbl_amazon_orders.ticket_id as ticket_id,tbl_amazon_orders.product_name as product_name,tbl_amazon_orders.product_url as product_url,tbl_amazon_orders.product_price as product_price,tbl_amazon_orders.order_date as order_date,tbl_amazon_orders.order_status as order_status from tbl_amazon_orders where tbl_amazon_orders.user_id='".$_SESSION['id']."'");
						$cnt=1;
						while($row=mysqli_fetch_array($query))
						{$ticket_id= $row['id'];?>	
					        <tr>
							<td><?php echo $cnt;?></td>
							<td><?php echo $row['id'];?></td>
							<td class="cart-product-name-info"><?php echo $row['product_name'];?></td>
							<td class="cart-product-quantity"><?php echo $qty=$row['product_url']; ?></td>
							<td class="cart-product-sub-total"><?php echo $row['product_price']; ?></td>
							<td class="cart-product-sub-total"><?php echo $row['order_date']; ?></td>
							<td><button type="button" class="btn btn-info btn amz_btn" data-toggle="modal" data-target="#amzmyModal" id="<?php echo htmlentities($row['id']);?>">Track</button></td>
							<td>
							<?php $decryped_id = urlencode(base64_encode("$ticket_id")); ?>
							<a href="ticket_view.php?ticket=<?php echo $decryped_id;?>" class="btn btn-info btn">View</a></td>
						</tr>
                     <?php $cnt=$cnt+1;} ?>			
						</tbody>				
					</table> 
				</div>	
				<!-- already-registered-login -->		
			</div>			
		</div>
		<!-- panel-body  -->
	</div><!-- row -->
</div>

	
</div><!-- /.checkout-steps -->
		</div>
	</div><!-- /.row -->
</div><!-- /.checkout-box -->
</div>
</div>
</div>
</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
<?php //require_once('templates/chat_script_forconflict.php');?> 
<script>
$(document).ready(function(){
	  $('.ord_btn').click(function(){
		  //var id = $(this).attr('id');
		  //alert(id);
		  var idorder = $(this).attr('id');
		  //alert(idorder);
		  $.ajax({  
								type: "POST",
								dataType: "text",
								url: "track-order.php",
								data: "idorder=" + idorder,
								success: function(data){
									//$("#myModal").show();
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
								url: "track-amazone-order.php",
								data: "idorder_amz=" + idorder_amz,
								success: function(data){
								//$('#myModal').modal('show');
							     $("#amz_res").html(data);
							},
							
					});
		  
});

 });
</script>
<?php require_once('templates/datatable_js.php');?>
<script>
$(document).ready(function(){
$('#example1').DataTable( {
        //"scrollY": 200,
        "scrollX": true
    } );
 });
</script>
<?php require_once('templates/chat_script_forconflict.php');?>
</body>
</html>
<?php } ?>