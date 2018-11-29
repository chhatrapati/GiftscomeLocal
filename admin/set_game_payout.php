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
<title>Update Game Payout Rate | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Game Payout Rate</a> </div>
  
</div>
<div class="container-fluid">
  <div class="row-fluid">
  
    <div class="span12">
      <div class="widget-box">
	   
									<div class="" id="message">
									
									</div>
		<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
             <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="Set Payout Rate Of Game">
          </div>
        
		<div class="control-group">
		
		<div class="controls" style="margin-left:430px; margin-top:20px;">
		<?php  @$game_id_setpayout= $_POST['game_id']; 
		   $query=mysqli_query($con,"select * from tbl_game where game_status='0' OR game_status='1' AND is_active='1'");?>
		 <label class="" style="display:inline-block;vertical-align:top;padding:5px;">Select Game Name:</label>
		<select name="game_name" id="game_name" onchange="func()">
		<?php while($row=mysqli_fetch_array($query)) { $gid = $row['id']; ?>
		<option value="<?php echo $row['id'];?>" <?php if($game_id_setpayout==$row['id']){?> selected <?php }?>><?php echo $row['game_name'];?></option>
		<?php }?>
		</select>
		</div>
		</div>
         <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
          <form action="" method="post" name="default_payout_update" id="default_payout_update" class="form-horizontal">
<?php  $query=mysqli_query($con,"select * from tbl_game_payout where game_id ='$gid' LIMIT 14");?>
		  <div class="controls" style="float:left; width:30%;margin-left:0px;">
		       <?php  while($row=mysqli_fetch_array($query)) { ?>
			<label class="label_digit digit_img"><?php echo $row['payout_digit'];?></label>
			<div class="controls">
            <input type="number" class="" name="payout_amount<?php echo $row['payout_digit'];?>" id="payout_amount<?php echo $row['payout_digit'];?>" placeholder="Enter Payout Rate" value="<?php echo $row['payout_amount'];?>" />
			</div>
		    <?php  } ?>
			</div>
			<?php  $query=mysqli_query($con,"select * from tbl_game_payout where game_id ='$gid' LIMIT 15 OFFSET 14");?>
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

function func()
 {
    //make the ajax call
	var game_id=$("#game_name").val();
	//alert(game_name);
    $.ajax({
        url: 'payout_digit_bygame.php',
        type: 'POST',
        data: "game_id=" + game_id,
        success: function(res) {
            $("#resultt").html(res);
        }
    });
}
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