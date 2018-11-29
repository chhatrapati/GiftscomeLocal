<?php
include_once 'include/config.php';
$oid=$_POST['idorder'];
?>
<style>
.form-horizontal .control-label {padding-top: 10px !important;}
</style>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span11">
	<div class="widget-box">
	  <div class="widget-content nopadding" id="">	
 <form name="updateticket" id="updateticket" method="post" class="form-horizontal">
 <div class="control-group">
		<label class="control-label" for="basicinput">Order Id:</label>
		<div class="controls">
		<?php echo $oid;?>
		</div>
</div>
<?php 
     $ret = mysqli_query($con,"SELECT * FROM ordertrackhistory WHERE orderId='$oid'");
     while($row=mysqli_fetch_array($ret))
      {$rem=$row['remark'];?>
      <div class="control-group">
		<label class="control-label" for="basicinput">Order Date:</label>
		<div class="controls">
		<?php echo $row['postingDate'];?>
		</div>
      </div>
	  <?php if($rem=='Delivered'){?>
	  <div class="control-group">
		<label class="control-label" for="basicinput">Order Status:</label>
		<div class="controls">
		<?php echo $row['status'];?>
		</div>
      </div>
	  
	  <div class="control-group">
		<label class="control-label" for="basicinput">Remark:</label>
		<div class="controls">
		<?php echo $row['remark'];?>
		</div>
      </div>
	  <?php }?>
	    
 <?php } ?>
			
   <?php 
$st='Delivered';
   $rt = mysqli_query($con,"SELECT * FROM orders WHERE id='$oid'");
     while($num=mysqli_fetch_array($rt))
     {
     $currrentSt=$num['orderStatus'];
   }
     if($st==$currrentSt)
     { ?>
 <div class="control-group">
		<label class="control-label" for="basicinput"></label>
		<div class="controls">
		Product has been delivered
		</div>
      </div>
   <?php }else  {
      ?>
   <div class="control-group">
		<label class="control-label" for="basicinput">Order Status:</label>
		<div class="controls">
		 <select name="status" id="status" class="fontkink" required="required" class="span8">
          <option value="">Select Status</option>
                 <option value="In Process" <?php if($currrentSt=='In Process'){?>selected<?php }?>>In Process</option>
                  <option value="Delivered" <?php if($currrentSt=='Delivered'){?>selected<?php }?>>Delivered</option>
				  <option value="Rejected" <?php if($currrentSt=='Rejected'){?>selected<?php }?>>Rejected</option>
        </select>
		</div>
    </div>
	
	 <div class="control-group">
		<label class="control-label" for="basicinput">Remark:</label>
		<div class="controls">
		  <textarea class="span8" cols="50" rows="7" name="remark" id="remark"  required="required" value=""><?php if(@$rem!=''){ echo @$rem;}?></textarea>
		</div>
      </div>
	  
	  <div class="control-group">
			<div class="controls">
				<input type="submit" name="update" class="btn btn-success" id="updt" value="Update">
			</div>
		</div>
<?php } ?>		
</form>
</div>
</div>
</div>
</div>
</div>
<script src="js/jquery.validate.js"></script>
<script>
$(document).ready(function(){
	$("#updateticket").validate({
		submitHandler : function(e) {
	  //$('#updt').click(function(){
		  var status=$("#status").val();
		  var remark=$("#remark").val();
		  var idorder = '<?php echo $oid;?>';
		  $.ajax({  
								type: "POST",
								dataType: "text",
								url: "update_order_submit.php",
								data: "idorder=" + idorder + "& status=" + status + "& remark=" + remark,
								success: function(data){
									window.setTimeout(function(){location.reload()},500);
									//$('#myModal').modal('show');
							     //$("#res").html(data);
							},
							
					});
		},
		rules : {
        	status : {required : true },
        	remark : {required : true }
			},
        // Specify the validation error messages
        messages: {
        	status : {required : "Please enter status"},
			remark : {required : "Please enter remark"	},
			
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
		        
		  
});
 });
</script>