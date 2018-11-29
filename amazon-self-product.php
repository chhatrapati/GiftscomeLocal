<?php
$user_obj = new Cl_User();
if(strlen($_SESSION['login'])==0)
{   
	$_SESSION['url'] = $_SERVER['REQUEST_URI'];
	header('location:login.php');
}
$gift_coins_exchange_rate = $user_obj->gift_coins_exchange_rate();
?>
<link rel="stylesheet" href="css/support_ticket.css" />
<style>
span.help-block {
    color: red !important;
    display: block !important;
}
</style>
	<section class="bgwhite">
		<div class="container">
			<div class="row">
			
			                    <div class="col-md-12" id="result" ></div>
			
				<div class="col-md-12 p-b-30">
					<h3 class="m-text26 p-t-15 p-b-16">Amazon Self Select Gift Item</h3>
					
					 <form id="gen_tct" name="gen_tct" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                      <label class="control-label mb-10 text-left">Product Name* </label>
                      <input type="text" name="amazon_pro_name" id="amazon_pro_name" class="form-control textbox" value="" placeholder="" required>
					  <span class="help-block"></span>
                    </div>
					
					 <div class="form-group">
                      <label class="control-label mb-10 text-left">Product Link* </label>
                      <input type="text" name="amazon_pro_link" id="amazon_pro_link" class="form-control textbox" value="" placeholder="" required>
					  <span class="help-block"></span>
                    </div>
					
					 <div class="form-group">
                      <label class="control-label mb-10 text-left">Product Price* (In $) ($1 = <?php echo number_format($gift_coins_exchange_rate);?> Gift Coins) </label>
                      <input min="0"  type="text" name="amazon_pro_price" id="amazon_pro_price" class="form-control textbox allow_decimal" value="" placeholder="" onkeyup="myFunction()"  maxlength="8" required>
					  <span class="help-block"></span>
					  <span class="" id="prc_alert" style="color: #00B0FF;margin: 8px 0 0 0;display:inline-block;"></span>
                    </div>
					
					 <div class="form-group">
                      <label class="control-label mb-10 text-left">Customer Name* </label>
                      <input type="text" name="full_name" id="full_name" class="form-control textbox" value="" placeholder="" required>
					  <span class="help-block"></span>
                    </div>
					
					 <div class="form-group">
                      <label class="control-label mb-10 text-left">Customer Email* </label>
                      <input type="text" name="email_for_order" id="email_for_order" class="form-control textbox" value="" placeholder="" required>
					  <span class="help-block"></span>
                    </div>
					
					 <div class="form-group">
                      <label class="control-label mb-10 text-left">Customer Shipping Address* </label>
					  <textarea name="shipping_address" id="shipping_address" class="form-control textbox" value="" placeholder=""/></textarea>
					   <span class="" id="" style="color: #00B0FF;margin: 8px 0 0 0;display:inline-block;">Note: Shipping available only for USA.</span>
					  <span class="help-block"></span>
                    </div>
					
					<?php $_SESSION["csrf_token_3"] = md5(rand(0,10000000)).time(); ?>
				<input type="hidden" name="csrf_token_3" value="<?php echo htmlspecialchars($_SESSION["csrf_token_3"]);?>">
					<input type="submit" class="btn btn-success btn-anim" name="submit" id="sub_btn" value="Submit" required>
                  </form>
				</div>
							
			</div>
			
			
</div>
</section>
<script src="js/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<!-- jQuery Form Validation code -->
<script type="text/javascript"> 
	$(document).ready(function(){
 // Setup form validation on the #register-form element
 $("#gen_tct").validate({
 	submitHandler : function(e) {
 		//$(form).submit();
		var amazon_pro_name = document.getElementById("amazon_pro_name").value
		  var amazon_pro_link = document.getElementById("amazon_pro_link").value
		  var amazon_pro_price = document.getElementById("amazon_pro_price").value;
		  var full_name = document.getElementById("full_name").value;
		  var shipping_address = document.getElementById("shipping_address").value;
		  var email_for_order = document.getElementById("email_for_order").value;
		  $.ajax({  
								type: "POST",
								dataType: "text",
								url: "amazon-order-submit.php",
								data: "amazon_pro_name=" + amazon_pro_name + "& amazon_pro_link=" + amazon_pro_link + "& amazon_pro_price=" + amazon_pro_price + "& full_name=" + full_name + "& shipping_address=" + shipping_address + "& email_for_order=" + email_for_order,
								success: function(rr){
							 //alert(rr);
							  //alert("Record successfully updated");
							  $("#result").html(rr);
							 // window.setTimeout(function(){location.reload()},1000);
							},
							
							error:function(jqXHR, textStatus, errorThrown){
							//alert("Error type" + textStatus + "occured, with value " + errorThrown);
						}
					});
 	},
        // Specify the validation rules
        rules : {
        	amazon_pro_name : {required : true },
        	amazon_pro_link : {required : true,url: true },
			amazon_pro_price : {required : true},
			full_name : {required : true },
			shipping_address : {required : true},
			email_for_order : {required : true,email:true }
			},
        // Specify the validation error messages
        messages: {
        	amazon_pro_name : {required : "Please enter amazon product name"},
			amazon_pro_link : {required : "Please enter amazon product url"	},
			amazon_pro_price : {required : "Please enter amazon product price"},
			full_name : {required : "Please enter customer name"},
			shipping_address : {required : "Please enter customer shipping address"},
			email_for_order : {required : "Please enter customer email address"},
			
		},
		errorPlacement : function(error, element) {
			$(element).closest('div').find('.help-block').html(error.html());
		},
		highlight : function(element) {
			$(element).closest('div').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).closest('div').removeClass('has-error').addClass('has-success');
			$(element).closest('div').find('.help-block').html('');
		}
	});
	

});
</script>
<script>
function myFunction() {
	var amazon_pro_price=$("#amazon_pro_price").val();
	var gift_coins_exchange_rate='<?php echo $gift_coins_exchange_rate?>';
	var total_prc_coins = amazon_pro_price * gift_coins_exchange_rate;
	//alert(total_prc_coins);
	 $("#prc_alert").show();
	 $("#prc_alert").html('Total Price In Coins: '+total_prc_coins);
}
</script>