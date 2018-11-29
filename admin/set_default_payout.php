<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Update Game Start Process | Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
<link rel="stylesheet" href="css/custom.css" />
</head>
<body>

<?php require_once('include/header.php');?>
<!--sidebar-menu-->
<?php require_once('include/sidebar.php');?>
<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Game Starting Process</a> </div>
  
</div>
<div class="container-fluid">
  <div class="row-fluid">
  
    <div class="span12">
      <div class="widget-box">
	   
									<div class="" id="message">
									
									</div>
		 <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
             <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="Set Default Payout Rate Of All Digits">
          </div>
        		
        <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
          <form action="" method="post" name="default_payout_update" id="default_payout_update" class="form-horizontal">
		  <?php  $query=mysqli_query($con,"select * from tbl_default_payout LIMIT 14");?>
		  <div class="controls" style="float:left; width:30%;margin-left:0px;">
		       <?php  while($row=mysqli_fetch_array($query)) { ?>
            
           <!-- <input type="text" placeholder=".span6" class="span6 m-wrap">-->
		   
			<label class="label_digit digit_img"><?php echo $row['payout_digit'];?></label>
			<div class="controls">
            <input type="number" class="" name="payout_amount<?php echo $row['payout_digit'];?>" id="payout_amount<?php echo $row['payout_digit'];?>" placeholder="Enter Payout Rate" value="<?php echo $row['payout_amount'];?>" />
			</div>
		    <?php  } ?>
			</div>
			<?php  $query=mysqli_query($con,"select * from tbl_default_payout LIMIT 15 OFFSET 14");?>
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
		  <div id="ppp"></div>
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
		$(document).ready(function() {
		 $("#btn").click(function() {
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
			 //alert(payout_amount1);
			 $.ajax({  
			 type: "POST",
			 dataType: "text",
			 url: "update_default_payout.php",
			 data: "payout_amount0=" + payout_amount0 + "& payout_amount1=" + payout_amount1 + "& payout_amount2=" + payout_amount2 + "& payout_amount3=" + payout_amount3 + "& payout_amount4=" + payout_amount4 + "& payout_amount5=" + payout_amount5 + "& payout_amount6=" + payout_amount6 + "& payout_amount7=" + payout_amount7 + "& payout_amount8=" + payout_amount8 + "& payout_amount9=" + payout_amount9 + "& payout_amount10=" + payout_amount10 + "& payout_amount11=" + payout_amount11 + "& payout_amount12=" + payout_amount12 + "& payout_amount13=" + payout_amount13 + "& payout_amount14=" + payout_amount14 + "& payout_amount15=" + payout_amount15 + "& payout_amount16=" + payout_amount16 + "& payout_amount17=" + payout_amount17 + "& payout_amount18=" + payout_amount18 + "& payout_amount19=" + payout_amount19 + "& payout_amount20=" + payout_amount20 + "& payout_amount21=" + payout_amount21 + "& payout_amount22=" + payout_amount22 + "& payout_amount23=" + payout_amount23 + "& payout_amount24=" + payout_amount24 + "& payout_amount25=" + payout_amount25 + "& payout_amount26=" + payout_amount26 + "& payout_amount27=" + payout_amount27,  
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
<script>
 $(document).ready(function(){
        setTimeout(function() {
          $('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    });
</script> 
<script src="js/jquery.validate.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 
  $("#default_payout_update").validate({
    
        // Specify the validation rules
		rules : {
		payout_amount0: {
            //required: true,
			digits: true
	    },
		payout_amount1: {
            //required: true,
			digits: true
	    },
		payout_amount2: {
            //required: true,
			digits: true
	    },
		payout_amount3: {
            //required: true,
			digits: true
	    },
		payout_amount4: {
            //required: true,
			digits: true
	    },
		payout_amount5: {
            //required: true,
			digits: true
	    },
		payout_amount6: {
            //required: true,
			digits: true
	    },
		
		
       },
        // Specify the validation error messages
        messages: {
			    payout_amount0: {digits: "Please enter digits"},
				
        },
       
        submitHandler: function(form) {
            form.submit();
        }
    });

  </script>
 
</body>
</html>