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
<title>Set standarad bet for all digits | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage standarad bet</a> </div>
  
</div>
<div class="container-fluid">
  <div class="row-fluid">
  
    <div class="span12">
      <div class="widget-box">
	   
									<div class="" id="message"></div>
		<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
             <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="Set standarad bet for all digits">
          </div>
        
		 <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
          <form action="" method="post" name="default_bid_update" id="default_bid_update" class="form-horizontal">
		  <?php  $query=mysqli_query($con,"select * from tbl_default_bids LIMIT 14");?>
		  <div class="controls" style="float:left; width:30%;margin-left:0px;">
		       <?php  while($row=mysqli_fetch_array($query)) { ?>
            
           <!-- <input type="text" placeholder=".span6" class="span6 m-wrap">-->
		   
			<label class="label_digit digit_img"><?php echo $row['bid_digit'];?></label>
			<div class="controls">
            <input type="number" class="" name="bid_amt<?php echo $row['bid_digit'];?>" id="bid_amt<?php echo $row['bid_digit'];?>" placeholder="Enter Payout Rate" value="<?php echo $row['bid_amt'];?>" />
			</div>
		    <?php  } ?>
			</div>
			<?php  $query=mysqli_query($con,"select * from tbl_default_bids LIMIT 15 OFFSET 14");?>
			<div class="controls" style="float:right; width:68%;margin-left:0px;">
			<?php  while($row=mysqli_fetch_array($query)) { ?>
				
			<label class="label_digit digit_img"><?php echo $row['bid_digit'];?></label>
			<div class="controls">
            <input type="number" class="" name="bid_amt<?php echo $row['bid_digit'];?>" id="bid_amt<?php echo $row['bid_digit'];?>" placeholder="Enter Payout Rate" value="<?php echo $row['bid_amt'];?>" />
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
			 //alert(bid_amt1);
			 $.ajax({  
			 type: "POST",
			 dataType: "text",
			 url: "update_default_bids.php",
			 data: "bid_amt0=" + bid_amt0 + "& bid_amt1=" + bid_amt1 + "& bid_amt2=" + bid_amt2 + "& bid_amt3=" + bid_amt3 + "& bid_amt4=" + bid_amt4 + "& bid_amt5=" + bid_amt5 + "& bid_amt6=" + bid_amt6 + "& bid_amt7=" + bid_amt7 + "& bid_amt8=" + bid_amt8 + "& bid_amt9=" + bid_amt9 + "& bid_amt10=" + bid_amt10 + "& bid_amt11=" + bid_amt11 + "& bid_amt12=" + bid_amt12 + "& bid_amt13=" + bid_amt13 + "& bid_amt14=" + bid_amt14 + "& bid_amt15=" + bid_amt15 + "& bid_amt16=" + bid_amt16 + "& bid_amt17=" + bid_amt17 + "& bid_amt18=" + bid_amt18 + "& bid_amt19=" + bid_amt19 + "& bid_amt20=" + bid_amt20 + "& bid_amt21=" + bid_amt21 + "& bid_amt22=" + bid_amt22 + "& bid_amt23=" + bid_amt23 + "& bid_amt24=" + bid_amt24 + "& bid_amt25=" + bid_amt25 + "& bid_amt26=" + bid_amt26 + "& bid_amt27=" + bid_amt27,  
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
 
  $("#default_bid_update").validate({
    
        // Specify the validation rules
		rules : {
		bid_amt0: {
            //required: true,
			digits: true
	    },
		bid_amt1: {
            //required: true,
			digits: true
	    },
		bid_amt2: {
            //required: true,
			digits: true
	    },
		bid_amt3: {
            //required: true,
			digits: true
	    },
		bid_amt4: {
            //required: true,
			digits: true
	    },
		bid_amt5: {
            //required: true,
			digits: true
	    },
		bid_amt6: {
            //required: true,
			digits: true
	    },
		
		
       },
        // Specify the validation error messages
        messages: {
			    bid_amt0: {digits: "Please enter digits"},
				
        },
       
        submitHandler: function(form) {
            form.submit();
        }
    });

  </script>
 
</body>
</html>