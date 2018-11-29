<?php
session_start();
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
if(isset($_POST['submit']) && @$_SESSION["csrf_token"] == @$_POST['csrf_token'])
{
	$id=toInternalId($_GET['id']);
	$game_id=$_POST['game_name'];
	$payout_digits=$_POST['payout_digits'];
	$payout_amount=$_POST['payout_amount'];
	$sql=mysqli_query($con, "update tbl_lucky28_digits_payout_default set game_id='$game_id',payout_digits='$payout_digits',payout_amount='$payout_amount' where id='$id'");
	$_SESSION['msg']="Record Updated !!";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Update Digits Payout Rate | Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
</head>
<body>

<?php require_once('include/header.php');?>
<!--sidebar-menu-->
<?php require_once('include/sidebar.php');?>
<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Game Digit Payout</a> </div>
  <h1>Update Game Digit Payout</h1>
</div>
<div class="container-fluid">
  <hr>
   <div class="row-fluid">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Update Game Digit Payout</h5>
        </div>
        <div class="widget-content nopadding">
		<?php if(!empty($_SESSION['msg'])){?>
									<div class="alert alert-success" id="successMessage">
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									<script type="text/javascript">
									setTimeout(function () {
									var basepath = window.location.protocol + '//' + window.location.hostname;
									var path = basepath + '/admin/game_digits_payout.php';
									window.location.href= path; // the redirect goes here
									},1000); // 5 seconds
								</script>
									</div>
		<?php } ?>
		
		<form class="form-horizontal" name="game_digit_update" id="game_digit_update" method="post"  enctype="multipart/form-data" >
			<?php
			$id=toInternalId($_GET['id']);
			$query=mysqli_query($con,"select tbl_lucky28_digits_payout_default.game_id,tbl_lucky28_digits_payout_default.payout_digits,tbl_lucky28_digits_payout_default.payout_amount,tbl_lucky28_digits_payout_default.is_active,tbl_game.id, tbl_game.game_name from tbl_lucky28_digits_payout_default join tbl_game on  tbl_lucky28_digits_payout_default.game_id = tbl_game.id where tbl_lucky28_digits_payout_default.id='$id'");
			while($row=mysqli_fetch_array($query)) { ?>							
			
		<div class="control-group">
		<label class="control-label" for="basicinput">Game Name</label>
		<div class="controls">
		<?php  $query12=mysqli_query($con,"select * from tbl_game");?>
		<select name="game_name" id="game_name">
		<?php while($row12=mysqli_fetch_array($query12)) { ?>
		<option value="<?php echo $row12['id'];?>" <?php if($row12['id'] == $row['game_id']) {?> selected <?php }?>><?php echo $row12['game_name'];?></option>
		<?php }?>
		</select>
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="basicinput">Enter Digit</label>
		<div class="controls">
		<input type="text"   name="payout_digits" id="payout_digits" class="span8 tip" placeholder="Enter Game Digit" value="<?php echo  htmlentities($row['payout_digits']);?>">
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Payout Amount</label>
		<div class="controls">
		<input type="text"   name="payout_amount" id="payout_amount" class="span8 tip" placeholder="Enter Payout Amount" value="<?php echo  htmlentities($row['payout_amount']);?>">
		</div>
		</div>
			<?php } ?>	
		  <div class="control-group">
			<div class="controls">
			<?php $_SESSION["csrf_token"] = md5(rand(0,10000000)).time(); ?>
					  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION["csrf_token"]);?>">
				<button type="submit" name="submit" class="btn btn-success">Update</button>
			</div>
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
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.validate.js"></script>
<script src="js/matrix.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 
  $("#game_digit_update").validate({
    
        // Specify the validation rules
		rules : { 
		 game_name: {
            required: true
            },
		payout_digits: {
            required: true,
			digits: true
            },
		payout_amount: {
            required: true,
			digits: true
            }
		
       },
       messages: {
            game_name: {required : "Please enter game name"},
            payout_digits:{ required :"Please enter payout digits"},
			payout_amount:{ required :"Please enter payout amount"},
			           
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
        submitHandler: function(form) {
            form.submit();
        }
    });

  </script>
  <script>
 $(document).ready(function(){
        setTimeout(function() {
          $('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
    });
</script>
</body>
</html>