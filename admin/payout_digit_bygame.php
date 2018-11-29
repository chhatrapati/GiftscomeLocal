<?php
session_start();
error_reporting(0);
include('include/config.php');
$game_id=$_POST['game_id'];
?>
 <form action="" method="post" name="default_payout_update" id="default_payout_update" class="form-horizontal">
<?php  $query=mysqli_query($con,"select * from tbl_game_payout where game_id ='$game_id' LIMIT 14");?>
		  <div class="controls" style="float:left; width:30%;margin-left:0px;">
		       <?php  while($row=mysqli_fetch_array($query)) { ?>
			<label class="label_digit digit_img"><?php echo $row['payout_digit'];?></label>
			<div class="controls">
            <input type="number" class="" name="payout_amount<?php echo $row['payout_digit'];?>" id="payout_amount<?php echo $row['payout_digit'];?>" placeholder="Enter Payout Rate" value="<?php echo $row['payout_amount'];?>" />
			</div>
		    <?php  } ?>
			</div>
			<?php  $query=mysqli_query($con,"select * from tbl_game_payout where game_id ='$game_id' LIMIT 15 OFFSET 14");?>
			<div class="controls" style="float:right; width:68%;margin-left:0px;">
			<?php  while($row=mysqli_fetch_array($query)) { ?>
				
			<label class="label_digit digit_img"><?php echo $row['payout_digit'];?></label>
			<div class="controls">
            <input type="number" class="" name="payout_amount<?php echo $row['payout_digit'];?>" id="payout_amount<?php echo $row['payout_digit'];?>" placeholder="Enter Payout Rate" value="<?php echo $row['payout_amount'];?>" />
			</div>
			<?php  } ?>
		</div>
		<div class="controls"  style="margin-left:490px;">
				<button type="submit" name="submit" id="btn" class="btn btn-success">Update</button>
			</div>
		
          </form>
<script>
		$(document).ready(function() {
		 $("#btn").click(function() {
			 var game_id = '<?php echo $game_id?>';
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
			 //alert(payout_amount0);alert(payout_amount1);alert(payout_amount2);
			 $.ajax({  
			 type: "POST",
			 dataType: "text",
			 url: "update_game_payout.php",
			 data: "payout_amount0=" + payout_amount0 + "& payout_amount1=" + payout_amount1 + "& payout_amount2=" + payout_amount2 + "& payout_amount3=" + payout_amount3 + "& payout_amount4=" + payout_amount4 + "& payout_amount5=" + payout_amount5 + "& payout_amount6=" + payout_amount6 + "& payout_amount7=" + payout_amount7 + "& payout_amount8=" + payout_amount8 + "& payout_amount9=" + payout_amount9 + "& payout_amount10=" + payout_amount10 + "& payout_amount11=" + payout_amount11 + "& payout_amount12=" + payout_amount12 + "& payout_amount13=" + payout_amount13 + "& payout_amount14=" + payout_amount14 + "& payout_amount15=" + payout_amount15 + "& payout_amount16=" + payout_amount16 + "& payout_amount17=" + payout_amount17 + "& payout_amount18=" + payout_amount18 + "& payout_amount19=" + payout_amount19 + "& payout_amount20=" + payout_amount20 + "& payout_amount21=" + payout_amount21 + "& payout_amount22=" + payout_amount22 + "& payout_amount23=" + payout_amount23 + "& payout_amount24=" + payout_amount24 + "& payout_amount25=" + payout_amount25 + "& payout_amount26=" + payout_amount26 + "& payout_amount27=" + payout_amount27 + "& game_id=" + game_id,  
			 success: function(rr){
				 //alert(rr);
				  //alert("Record successfully updated");
				  $("#message").html(rr);
				},
				error:function(jqXHR, textStatus, errorThrown){
				alert("Error type" + textStatus + "occured, with value " + errorThrown);
				}
			 });  
		    return false;
		   });
	 });
</script>
