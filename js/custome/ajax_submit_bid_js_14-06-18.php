<?php
session_start();
?>
<script>
		//$(document).ready(function() {
		 $("#subbtn").click(function() {
			 $('#loadingmessage').show(); 
			// alert('hi');
			 var game_id = '<?php echo $id ?>';
			 var user_id = '<?php echo $_SESSION['id']?>';
			 var payout_amount0=$("#payout_amount0").val();
             var payout_amount1=$("#payout_amount1").val();
			 var payout_amount2=$("#payout_amount2").val();
             var payout_amount3=$("#payout_amount3").val();
			 var payout_amount4=$("#payout_amount4").val();
             var payout_amount5=$("#payout_amount5").val();
			 var payout_amount6=$("#payout_amount6").val();
             var payout_amount7=$("#payout_amount7").val();
			 var payout_amount8=$("#payout_amount8").val();
             var payout_amount9=$("#payout_amount9").val();
			 var payout_amount10=$("#payout_amount10").val();
             var payout_amount11=$("#payout_amount11").val();
			 var payout_amount12=$("#payout_amount12").val();
             var payout_amount13=$("#payout_amount13").val();
			 var payout_amount14=$("#payout_amount14").val();
             var payout_amount15=$("#payout_amount15").val();
			 var payout_amount16=$("#payout_amount16").val();
             var payout_amount17=$("#payout_amount17").val();
			 var payout_amount18=$("#payout_amount18").val();
             var payout_amount19=$("#payout_amount19").val();
			 var payout_amount20=$("#payout_amount20").val();
             var payout_amount21=$("#payout_amount21").val();
			 var payout_amount22=$("#payout_amount22").val();
             var payout_amount23=$("#payout_amount23").val();
			 var payout_amount24=$("#payout_amount24").val();
             var payout_amount25=$("#payout_amount25").val();
			 var payout_amount26=$("#payout_amount26").val();
             var payout_amount27=$("#payout_amount27").val();
			 var final_gift_coins =$("#rem_coins").val();
			 var total_bids = +payout_amount0 + +payout_amount1 + +payout_amount2 + +payout_amount3 + +payout_amount4 + +payout_amount5 + +payout_amount6 + +payout_amount7 + +payout_amount8 + +payout_amount9 + +payout_amount10 + +payout_amount11 + +payout_amount12 + +payout_amount13 + +payout_amount14 + +payout_amount15 + +payout_amount16 + +payout_amount17 + +payout_amount18 + +payout_amount19 + +payout_amount20 + +payout_amount21 + +payout_amount22 + +payout_amount23 + +payout_amount24 + +payout_amount25 + +payout_amount26 + +payout_amount27;
			 if(final_gift_coins=='')
			 {
				 var final_gift_coins = '<?php echo $_SESSION['gift_coins']?>';
				
			 }
			 //alert(final_gift_coins); die();
			 $.ajax({  
			 type: "POST",
			 dataType: "text",
			 url: "set_game_bid.php",
			 data: "payout_amount0=" + payout_amount0 + "& payout_amount1=" + payout_amount1 + "& payout_amount2=" + payout_amount2 + "& payout_amount3=" + payout_amount3 + "& payout_amount4=" + payout_amount4 + "& payout_amount5=" + payout_amount5 + "& payout_amount6=" + payout_amount6 + "& payout_amount7=" + payout_amount7 + "& payout_amount8=" + payout_amount8 + "& payout_amount9=" + payout_amount9 + "& payout_amount10=" + payout_amount10 + "& payout_amount11=" + payout_amount11 + "& payout_amount12=" + payout_amount12 + "& payout_amount13=" + payout_amount13 + "& payout_amount14=" + payout_amount14 + "& payout_amount15=" + payout_amount15 + "& payout_amount16=" + payout_amount16 + "& payout_amount17=" + payout_amount17 + "& payout_amount18=" + payout_amount18 + "& payout_amount19=" + payout_amount19 + "& payout_amount20=" + payout_amount20 + "& payout_amount21=" + payout_amount21 + "& payout_amount22=" + payout_amount22 + "& payout_amount23=" + payout_amount23 + "& payout_amount24=" + payout_amount24 + "& payout_amount25=" + payout_amount25 + "& payout_amount26=" + payout_amount26 + "& payout_amount27=" + payout_amount27+ "& game_id=" + game_id + "& user_id=" + user_id + "& final_gift_coins=" + final_gift_coins + "& total_bids=" + total_bids,  
			 success: function(rr){
				 //alert(rr);
				  //alert("Record successfully updated");
				  $("#message").html(rr);
				  $('#loadingmessage').hide();
				},
				error:function(jqXHR, textStatus, errorThrown){
				//alert("Error type" + textStatus + "occured, with value " + errorThrown);
				}
			 });
			 
		    return false;
		   });
	 //});
</script>
<script>
		
		 //$('.btn-num-product-down,.btn-num-product-up').on('click', function() {
			 function todo(){
			 var payout_amount0=$("#payout_amount0").val();
             var payout_amount1=$("#payout_amount1").val();
			 var payout_amount2=$("#payout_amount2").val();
             var payout_amount3=$("#payout_amount3").val();
			 var payout_amount4=$("#payout_amount4").val();
             var payout_amount5=$("#payout_amount5").val();
			 var payout_amount6=$("#payout_amount6").val();
             var payout_amount7=$("#payout_amount7").val();
			 var payout_amount8=$("#payout_amount8").val();
             var payout_amount9=$("#payout_amount9").val();
			 var payout_amount10=$("#payout_amount10").val();
             var payout_amount11=$("#payout_amount11").val();
			 var payout_amount12=$("#payout_amount12").val();
             var payout_amount13=$("#payout_amount13").val();
			 var payout_amount14=$("#payout_amount14").val();
             var payout_amount15=$("#payout_amount15").val();
			 var payout_amount16=$("#payout_amount16").val();
             var payout_amount17=$("#payout_amount17").val();
			 var payout_amount18=$("#payout_amount18").val();
             var payout_amount19=$("#payout_amount19").val();
			 var payout_amount20=$("#payout_amount20").val();
             var payout_amount21=$("#payout_amount21").val();
			 var payout_amount22=$("#payout_amount22").val();
             var payout_amount23=$("#payout_amount23").val();
			 var payout_amount24=$("#payout_amount24").val();
             var payout_amount25=$("#payout_amount25").val();
			 var payout_amount26=$("#payout_amount26").val();
             var payout_amount27=$("#payout_amount27").val();
			 var ava_coins = '<?php echo $_SESSION['gift_coins'];?>'
			 var total_bids = +payout_amount0 + +payout_amount1 + +payout_amount2 + +payout_amount3 + +payout_amount4 + +payout_amount5 + +payout_amount6 + +payout_amount7 + +payout_amount8 + +payout_amount9 + +payout_amount10 + +payout_amount11 + +payout_amount12 + +payout_amount13 + +payout_amount14 + +payout_amount15 + +payout_amount16 + +payout_amount17 + +payout_amount18 + +payout_amount19 + +payout_amount20 + +payout_amount21 + +payout_amount22 + +payout_amount23 + +payout_amount24 + +payout_amount25 + +payout_amount26 + +payout_amount27;
			 var rem_coins = ava_coins - total_bids;
			 if(rem_coins<0)
			 {
				 rem_coins = '0';
			 }
			 //alert (total_bids);
			 //alert (rem_coins);
			 //alert(payout_amount1);
			 document.getElementById("gift_coins").value = rem_coins;
			 document.getElementById("rem_coins").value = rem_coins;
			 document.getElementById("total_bids").value = total_bids;
			 if(rem_coins<=0)
			 {
				 document.getElementById("subbtn").disabled = true;
				 //alert('hi');
				 //document.getElementById("slc").disabled = true;
				  for(var i=0; i<=27; i++){
					 document.getElementById("plus"+ i).disabled = true;
				};
				
			 }
			 else
			 {
				 //document.getElementById("subbtn").disabled = false;
				 for(var i=0; i<=27; i++){
					 document.getElementById("plus"+ i).disabled = false;
				};
			 }
			
			  
		    return false;
		   }
	
</script>