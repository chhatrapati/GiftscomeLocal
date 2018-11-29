<?php
/*Fetch user's pre bids data for all digits*/
$query_345=mysqli_query($con,"select * from tbl_user_robot where user_id='$uid'");
while($row_new=mysqli_fetch_array($query_345)) {
$id_tbl = $row_new['id'];
$bid_0 = $row_new['bid_0'];
$bid_1 = $row_new['bid_1'];
$bid_2 = $row_new['bid_2'];
$bid_3 = $row_new['bid_3'];
$bid_4 = $row_new['bid_4'];
$bid_5 = $row_new['bid_5'];
$bid_6 = $row_new['bid_6'];
$bid_7 = $row_new['bid_7'];
$bid_8 = $row_new['bid_8'];
$bid_9 = $row_new['bid_9'];
$bid_10 = $row_new['bid_10'];
$bid_11 = $row_new['bid_11'];
$bid_12 = $row_new['bid_12'];
$bid_13 = $row_new['bid_13'];
$bid_14 = $row_new['bid_14'];
$bid_15 = $row_new['bid_15'];
$bid_16 = $row_new['bid_16'];
$bid_17 = $row_new['bid_17'];
$bid_18 = $row_new['bid_18'];
$bid_19 = $row_new['bid_19'];
$bid_20 = $row_new['bid_20'];
$bid_21 = $row_new['bid_21'];
$bid_22 = $row_new['bid_22'];
$bid_23 = $row_new['bid_23'];
$bid_24 = $row_new['bid_24'];
$bid_25 = $row_new['bid_25'];
$bid_26 = $row_new['bid_26'];
$bid_27 = $row_new['bid_27'];
$status = $row_new['status'];
} ?>
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<?php $stylepopular= ''; $stylenotpopular= '';?>
<?php 
if($status==0)
{
$stylepopular= "style= display:none";
}

if($status==1)
{
$stylenotpopular= "style= display:none";
}

?>
<img id="imgnotpopular<?php echo $id_tbl; ?>" onclick="funisactive(<?php echo $id_tbl; ?>,1)" src='images/off.png' width='60' <?php echo $stylenotpopular;?> />
<img id="imgpopular<?php echo $id_tbl; ?>" onclick="funisactive(<?php echo $id_tbl; ?>,0)" src='images/on.png'  width='60' <?php echo $stylepopular;?> />
<h4 class="">Set your pre fixed bid amount for all games</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<div class="alert alert-danger alert-dismissible" id="msg" style="display:none;width:100%;">
<button type="button" class="close" data-dismiss="alert">×</button>
Auto bid has been Inactive successfully!!
</div>
<div class="alert alert-success alert-dismissible" id="suc_msg" style="display:none;width:100%;">
<button type="button" class="close" data-dismiss="alert">×</button>
Auto bid has been active successfully!!
</div>
<div class="alert alert-success" id="msgg" style="display:none;">
<button type="button" class="close" data-dismiss="alert">×</button>
Record Updated Successfully!!
</div>
<div class="alert alert-danger alert-dismissible" id="lowbal">
<strong>Your coins balance is low!</strong> Please reset your bets or <a href="package.php" style="color:red;font-size:18px;font-weight:bold;">purchase </a> more coins.
</div>
<div class="col-lg-10 col-sm-10 col-md-10 text-left Medi">
<button type="button" class="btn btn-warning bt" name="all_no_autobid" id="all_no_autobid" value="ALL">ALL</button>
<button type="button" class="btn btn-success bt" name="odd_no_autobid" id="odd_no_autobid" value="ODD">ODD</button>
<button type="button" class="btn btn-danger bt" name="even_no_autobid" id="even_no_autobid" value="EVEN">EVEN</button>
<button type="button" class="btn btn-info bt" id="middle_no_autobid">MIDDLE (10-17)</button>
<input type="hidden" name="pre_btn" class="bt" id="pre_btn_autobid" value="">
<button type="button" class="btn btn-info bt" id="side_no_autobid">SIDE (00-09,18-27)</button>
<button type="button" class="btn btn-info bt" id="small_no_autobid">SMALL (00-13)</button>
<button type="button" class="btn btn-info bt" id="big_no_autobid">BIG (14-27)</button>
<button type="button" class="btn btn-success bt" id="random_no_autobid">RANDOM</button>
<label style="padding-top:7px;">Total Bet :</label>
<input type="text" class="width-dynamic proba dva text-center" min="0" name="total_pre_bets" id="total_pre_bets" value="" style="align-self: center;min-width: 100px;width: 41px;margin-left: 10px;" disabled>
<label style="padding-top:7px;">Coin Balance :</label>
<input type="text" class="width-dynamic proba dva text-center" min="0" name="gift_coins_prebid" id="gift_coins_prebid" value="<?php echo $_SESSION['gift_coins'];?>" style="align-self: center;min-width: 100px;margin-left: 10px;width: 49px;" disabled>
<input type="hidden" id="rem_coins_prebid" name="rem_coins_prebid" value="">
<input type="hidden" id="gift_coins_bal_final" name="gift_coins_bal_final" value="<?php echo $_SESSION['gift_coins'];?>">		
</div>
<br/>
<div class="col-md-12 col-sm-12 col-xs-12">
<form action="" method="post" name="default_payout_update" id="default_payout_update" class="form-horizontal">
<div class="col-md-3 col-sm-3 col-xs-3">
<?php $digit = 0;
while($digit <= 27) { 
$default_bids_on_digit = $user_obj->default_bids_by_no($digit);
?>
<input class="" type="hidden" pattern="" name="default_bid<?php echo $digit;?>" id="default_bid<?php echo $digit;?>" value="<?php echo $default_bids_on_digit;?>">
<?php $digit++;} ?>
<label class="label_digit digit_img">0</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input"  min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt0" id="bid_amt0" placeholder="Enter Bid Amount" value="<?php if($bid_0) { echo $bid_0; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">1</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0"  pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()"  maxlength="5" name="bid_amt1" id="bid_amt1" placeholder="Enter Bid Amount" value="<?php if($bid_1) { echo $bid_1; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">2</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);"  oninput="todo_autobid_new()"  maxlength="5" name="bid_amt2" id="bid_amt2" placeholder="Enter Bid Amount" value="<?php if($bid_2) { echo $bid_2; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">3</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()"  maxlength="5" name="bid_amt3" id="bid_amt3" placeholder="Enter Bid Amount" value="<?php if($bid_3) { echo $bid_3; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">4</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()"  maxlength="5" name="bid_amt4" id="bid_amt4" placeholder="Enter Bid Amount" value="<?php if($bid_4) { echo $bid_4; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">5</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0"  pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()"  maxlength="5" name="bid_amt5" id="bid_amt5" placeholder="Enter Bid Amount" value="<?php if($bid_5) { echo $bid_5; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">6</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()"  maxlength="5" name="bid_amt6" id="bid_amt6" placeholder="Enter Bid Amount" value="<?php if($bid_6) { echo $bid_6; } else {echo '0';}?>" />
</div>
</div>
<div class="col-md-3 col-sm-3 col-xs-3">
<label class="label_digit digit_img">7</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()"  maxlength="5" name="bid_amt7" id="bid_amt7" placeholder="Enter Bid Amount" value="<?php if($bid_7) { echo $bid_7; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">8</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt8" id="bid_amt8" placeholder="Enter Bid Amount" value="<?php if($bid_8) { echo $bid_8; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">9</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()"  maxlength="5" name="bid_amt9" id="bid_amt9" placeholder="Enter Bid Amount" value="<?php if($bid_9) { echo $bid_9; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">10</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt10" id="bid_amt10" placeholder="Enter Bid Amount" value="<?php if($bid_10) { echo $bid_10; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">11</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt11" id="bid_amt11" placeholder="Enter Bid Amount" value="<?php if($bid_11) { echo $bid_11; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">12</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt12" id="bid_amt12" placeholder="Enter Bid Amount" value="<?php if($bid_12) { echo $bid_12; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">13</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt13" id="bid_amt13" placeholder="Enter Bid Amount" value="<?php if($bid_13) { echo $bid_13; } else {echo '0';}?>" />
</div>
</div>
<div class="col-md-3 col-sm-3 col-xs-3">
<label class="label_digit digit_img">14</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt14" id="bid_amt14" placeholder="Enter Bid Amount" value="<?php if($bid_14) { echo $bid_14; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">15</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt15" id="bid_amt15" placeholder="Enter Bid Amount" value="<?php if($bid_15) { echo $bid_15; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">16</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt16" id="bid_amt16" placeholder="Enter Bid Amount" value="<?php if($bid_16) { echo $bid_16; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">17</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt17" id="bid_amt17" placeholder="Enter Bid Amount" value="<?php if($bid_17) { echo $bid_17; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">18</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt18" id="bid_amt18" placeholder="Enter Bid Amount" value="<?php if($bid_18) { echo $bid_18; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">19</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt19" id="bid_amt19" placeholder="Enter Bid Amount" value="<?php if($bid_19) { echo $bid_19; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">20</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt20" id="bid_amt20" placeholder="Enter Bid Amount" value="<?php if($bid_20) { echo $bid_20; } else {echo '0';}?>" />
</div>
</div>
<div class="col-md-3 col-sm-3 col-xs-3">
<label class="label_digit digit_img">21</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt21" id="bid_amt21" placeholder="Enter Bid Amount" value="<?php if($bid_21) { echo $bid_21; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">22</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt22" id="bid_amt22" placeholder="Enter Bid Amount" value="<?php if($bid_22) { echo $bid_22; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">23</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt23" id="bid_amt23" placeholder="Enter Bid Amount" value="<?php if($bid_23) { echo $bid_23; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">24</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0"  pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt24" id="bid_amt24" placeholder="Enter Bid Amount" value="<?php if($bid_24) { echo $bid_24; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">25</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt25" id="bid_amt25" placeholder="Enter Bid Amount" value="<?php if($bid_25) { echo $bid_25; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">26</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt26" id="bid_amt26" placeholder="Enter Bid Amount" value="<?php if($bid_26) { echo $bid_26; } else {echo '0';}?>" />
</div>
<label class="label_digit digit_img">27</label>
<div class="controls">
<input type="number" class="form-control unicase-form-control text-input" min="0" pattern="[0-9]"  onkeypress="return AllowOnlyNumbers(event);" oninput="todo_autobid_new()" maxlength="5" name="bid_amt27" id="bid_amt27" placeholder="Enter Bid Amount" value="<?php if($bid_27) { echo $bid_27; } else {echo '0';}?>" />
</div>
</div>
<div class="controls"  style="text-align:center;position: relative;top: 20px;clear: both;">
<button type="button" id="clear_prebid" class="btn btn-warning btn_act">Clear All</button>
<button type="subbtn" name="sub_btn" id="sub_btn" class="btn btn-success bt">Update</button>
</div>
<?php $_SESSION["csrf_token_1234"] = md5(rand(0,10000000)).time(); ?>
<input type="hidden" name="csrf_token_1234" value="<?php echo htmlspecialchars($_SESSION["csrf_token_1234"]);?>">
</form>
</div>	
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
<script>
function funisactive(id,status)
{
	var uid= '<?php echo $uid?>';
	$.ajax({  
	 type: "POST",  
	 url: "change_active.php",  
	 data: "id=" + id + "& status=" + status + "& uid=" + uid,  
	 success: function(rr){  
		if(status=='1')
		{
		document.getElementById('imgnotpopular'+id).style.display='none';
		document.getElementById('imgpopular'+id).style.display='block';
		}
		else
		{
		document.getElementById('imgnotpopular'+id).style.display='block';
		document.getElementById('imgpopular'+id).style.display='none';
		}
		if(rr=='0')
		{
		$('#msg').show();
		$('#suc_msg').hide();
		window.location.reload();
		//setTimeout(function() { $('#msg').hide(); }, 3000);
		}
		if(rr=='1')
		{
		$('#suc_msg').show();
		$('#msg').hide();
		window.location.reload();
		//setTimeout(function() { $('#suc_msg').hide(); }, 3000);
		}
		//window.setTimeout(function(){location.reload()},1000);
		}  
	 });  
  return false;
}
</script>
<script>
		 $("#sub_btn").click(function() {
			 var bid_amt0=$("#bid_amt0").val();
             var bid_amt1=$("#bid_amt1").val();
			 var bid_amt2=$("#bid_amt2").val();
             var bid_amt3=$("#bid_amt3").val();
			 var bid_amt4=$("#bid_amt4").val();
             var bid_amt5=$("#bid_amt5").val();
			 var bid_amt6=$("#bid_amt6").val();
             var bid_amt7=$("#bid_amt7").val();
			 var bid_amt8=$("#bid_amt8").val();
             var bid_amt9=$("#bid_amt9").val();
			 var bid_amt10=$("#bid_amt10").val();
             var bid_amt11=$("#bid_amt11").val();
			 var bid_amt12=$("#bid_amt12").val();
             var bid_amt13=$("#bid_amt13").val();
			 var bid_amt14=$("#bid_amt14").val();
             var bid_amt15=$("#bid_amt15").val();
			 var bid_amt16=$("#bid_amt16").val();
             var bid_amt17=$("#bid_amt17").val();
			 var bid_amt18=$("#bid_amt18").val();
             var bid_amt19=$("#bid_amt19").val();
			 var bid_amt20=$("#bid_amt20").val();
             var bid_amt21=$("#bid_amt21").val();
			 var bid_amt22=$("#bid_amt22").val();
             var bid_amt23=$("#bid_amt23").val();
			 var bid_amt24=$("#bid_amt24").val();
             var bid_amt25=$("#bid_amt25").val();
			 var bid_amt26=$("#bid_amt26").val();
             var bid_amt27=$("#bid_amt27").val();
			 $.ajax({  
			 type: "POST",
			 dataType: "text",
			 url: "set_user_pre_bid.php",
			 data: "bid_amt0=" + bid_amt0 + "& bid_amt1=" + bid_amt1 + "& bid_amt2=" + bid_amt2 + "& bid_amt3=" + bid_amt3 + "& bid_amt4=" + bid_amt4 + "& bid_amt5=" + bid_amt5 + "& bid_amt6=" + bid_amt6 + "& bid_amt7=" + bid_amt7 + "& bid_amt8=" + bid_amt8 + "& bid_amt9=" + bid_amt9 + "& bid_amt10=" + bid_amt10 + "& bid_amt11=" + bid_amt11 + "& bid_amt12=" + bid_amt12 + "& bid_amt13=" + bid_amt13 + "& bid_amt14=" + bid_amt14 + "& bid_amt15=" + bid_amt15 + "& bid_amt16=" + bid_amt16 + "& bid_amt17=" + bid_amt17 + "& bid_amt18=" + bid_amt18 + "& bid_amt19=" + bid_amt19 + "& bid_amt20=" + bid_amt20 + "& bid_amt21=" + bid_amt21 + "& bid_amt22=" + bid_amt22 + "& bid_amt23=" + bid_amt23 + "& bid_amt24=" + bid_amt24 + "& bid_amt25=" + bid_amt25 + "& bid_amt26=" + bid_amt26 + "& bid_amt27=" + bid_amt27,  
			 success: function(qqq){
				  //alert(qqq);
				 $("#msgg").show();
				 setTimeout(function() { $('#msgg').hide(); }, 3000);
				 window.location.reload();
				},
				error:function(jqXHR, textStatus, errorThrown){
				//alert("Error type" + textStatus + "occured, with value " + errorThrown);
				}
			 });
		    return false;
		   });
</script>
<script>	
		   function todo_autobid_new(){
			  // alert('hfghf');
			 var bid_amt0=$("#bid_amt0").val();
             var bid_amt1=$("#bid_amt1").val();
			 var bid_amt2=$("#bid_amt2").val();
             var bid_amt3=$("#bid_amt3").val();
			 var bid_amt4=$("#bid_amt4").val();
             var bid_amt5=$("#bid_amt5").val();
			 var bid_amt6=$("#bid_amt6").val();
             var bid_amt7=$("#bid_amt7").val();
			 var bid_amt8=$("#bid_amt8").val();
             var bid_amt9=$("#bid_amt9").val();
			 var bid_amt10=$("#bid_amt10").val();
             var bid_amt11=$("#bid_amt11").val();
			 var bid_amt12=$("#bid_amt12").val();
             var bid_amt13=$("#bid_amt13").val();
			 var bid_amt14=$("#bid_amt14").val();
             var bid_amt15=$("#bid_amt15").val();
			 var bid_amt16=$("#bid_amt16").val();
             var bid_amt17=$("#bid_amt17").val();
			 var bid_amt18=$("#bid_amt18").val();
             var bid_amt19=$("#bid_amt19").val();
			 var bid_amt20=$("#bid_amt20").val();
             var bid_amt21=$("#bid_amt21").val();
			 var bid_amt22=$("#bid_amt22").val();
             var bid_amt23=$("#bid_amt23").val();
			 var bid_amt24=$("#bid_amt24").val();
             var bid_amt25=$("#bid_amt25").val();
			 var bid_amt26=$("#bid_amt26").val();
             var bid_amt27=$("#bid_amt27").val();
			 var ava_coins = $("#gift_coins_bal_final").val();
			 var total_pre_bets = +bid_amt0 + +bid_amt1 + +bid_amt2 + +bid_amt3 + +bid_amt4 + +bid_amt5 + +bid_amt6 + +bid_amt7 + +bid_amt8 + +bid_amt9 + +bid_amt10 + +bid_amt11 + +bid_amt12 + +bid_amt13 + +bid_amt14 + +bid_amt15 + +bid_amt16 + +bid_amt17 + +bid_amt18 + +bid_amt19 + +bid_amt20 + +bid_amt21 + +bid_amt22 + +bid_amt23 + +bid_amt24 + +bid_amt25 + +bid_amt26 + +bid_amt27;
			 //alert(total_pre_bets);
			 var rem_coins = ava_coins - total_pre_bets;
			 if(rem_coins<0)
			 {
				 rem_coins = '0';
				 $('#lowbal').show();
			 }
			  else
			 {
				  $('#lowbal').hide();
			 }
			  if(total_pre_bets<=0)
			 {
				 document.getElementById("sub_btn").disabled = true;
			 }
			  else if(total_pre_bets > ava_coins)
			 {
				 document.getElementById("sub_btn").disabled = true;
			 }
			 else
			 {
				 document.getElementById("sub_btn").disabled = false;
				 
			 }
			 document.getElementById("gift_coins_prebid").value = rem_coins;
			 document.getElementById("rem_coins_prebid").value = rem_coins;
			document.getElementById("total_pre_bets").value = total_pre_bets;
			
		    return false;
		   }
		 
	
</script>