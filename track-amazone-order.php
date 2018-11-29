<?php
session_start();
include_once 'includes/config.php';
$oid=$_POST['idorder_amz'];
 ?>
<style>.col-lg-10.col-sm-10 {padding: 10px;font-size: 14px;font-weight: normal;font-style: normal;font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;}</style>
<div class="modal-content" style="margin-top:22%;">
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
     <div class="col-lg-10 col-sm-10">
		 <div class="col-lg-2 col-sm-2"></div>
		 <div class="col-lg-2 col-sm-2"></div>
		 <div class="col-lg-3 col-sm-3">Order Id:</div>
		 <div class="col-lg-3 col-sm-3"><?php echo $oid;?></div>
    </div>
		
<?php 
$ret = mysqli_query($con,"SELECT * FROM tbl_amazon_orders_track_history WHERE amz_order_id='$oid'");
$num=mysqli_num_rows($ret);
if($num>0)
{
while($row=mysqli_fetch_array($ret))
      {
     ?>
	 <div class="col-lg-10 col-sm-10">
		 <div class="col-lg-2 col-sm-2"></div>
		 <div class="col-lg-2 col-sm-2"></div>
		 <div class="col-lg-3 col-sm-3">Order Date:</div>
		 <div class="col-lg-3 col-sm-3"><?php echo $row['post_date'];?></div>
     </div>
		
	<div class="col-lg-10 col-sm-10">
		 <div class="col-lg-2 col-sm-2"></div>
		 <div class="col-lg-2 col-sm-2"></div>
		 <div class="col-lg-3 col-sm-3">Order Status:</div>
		 <div class="col-lg-3 col-sm-3"><?php echo $row['amz_order_status'];?></div>
    </div>
		
	<div class="col-lg-10 col-sm-10">
		 <div class="col-lg-2 col-sm-2"></div>
		 <div class="col-lg-2 col-sm-2"></div>
		 <div class="col-lg-3 col-sm-3">Remark:</div>
		 <div class="col-lg-3 col-sm-3"><?php echo $row['amz_order_remark'];?></div>
    </div>
	 
	
	 
<?php } }
else{
   ?>
    <div class="col-lg-10 col-sm-10">
		<div class="col-lg-2 col-sm-2"></div>
		<div class="col-lg-2 col-sm-2"></div>
		<div class="col-lg-6 col-sm-6">Order Not Process Yet</div>
    </div>
	 
	 <?php  }
$st='Delivered';
   $rt = mysqli_query($con,"SELECT * FROM tbl_amazon_orders WHERE id='$oid'");
     while($num=mysqli_fetch_array($rt))
     {
     $currrentSt=$num['order_status'];
   }
     if($st==$currrentSt)
     { ?>
     <div class="col-lg-10 col-sm-10">
		 <div class="col-lg-2 col-sm-2"></div>
		 <div class="col-lg-2 col-sm-2"></div>
		 <div class="col-lg-6 col-sm-6">Product Delivered successfully</div>
    </div>
   <?php } 
 
  ?>
</div>
<div class="modal-footer">
</div>				
</div>