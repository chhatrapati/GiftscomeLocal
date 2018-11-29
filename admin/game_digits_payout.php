<?php
session_start();
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']) && @$_SESSION["csrf_token"] == @$_POST['csrf_token'])
{
	//print_r($_POST); die();
	$game_id=$_POST['game_name'];
	$payout_digits=$_POST['payout_digits'];
	$payout_amount=$_POST['payout_amount'];
	$sql12=mysqli_query($con,"insert into tbl_lucky28_digits_payout_default(game_id,payout_digits,payout_amount) values('$game_id','$payout_digits','$payout_amount')");
    $_SESSION['msg']="Record Added!!";

}
if(isset($_GET['del']))
		  {
		          $id = toInternalId($_GET['id']);
				  mysqli_query($con,"delete from tbl_lucky28_digits_payout_default where id = '".$id."'");
                  $_SESSION['delmsg']="Record deleted !!";?>
				   <script type="text/javascript">
					setTimeout(function () {
					var basepath = window.location.protocol + '//' + window.location.hostname;
					var path = basepath + '/admin/game_digits_payout.php';
					window.location.href= path; // the redirect goes here
					},1000); // 5 seconds
				</script>
				
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Digits Payout Rate | Admin</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Digits Payout Rate</a> </div>
  
</div>
<div class="container-fluid">
  <hr>
   <div class="row-fluid">
    <div class="span11">
      <div class="widget-box panel panel-default">
	  <?php if(!empty($_SESSION['msg'])){?>
									<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
		<?php } ?>
		<?php if(isset($_GET['del'])){?>
									<div class="alert alert-erro" id="successMessage">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
		<?php } ?>
        <div class="widget-title panel-heading"> <span class="icon"> <i class="icon-align-justify"></i> </span>
        <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseOne" value="Add Digits Payout Rate">
        </div>
        <div class="widget-content nopadding panel-collapse collapse" id="collapseOne">
		
		
		<form class="form-horizontal" name="game_payout" id="game_payout" method="post"  enctype="multipart/form-data" >

		<div class="control-group">
		<label class="control-label" for="basicinput">Game Name</label>
		<div class="controls">
		<?php  $query=mysqli_query($con,"select * from tbl_game");?>
		<select name="game_name" id="game_name">
		<option value="Select Game Name">Select Game Name</option>
		<?php while($row=mysqli_fetch_array($query)) { ?>
		<option value="<?php echo $row['id'];?>"><?php echo $row['game_name'];?></option>
		<?php }?>
		</select>
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="basicinput">Enter Digit</label>
		<div class="controls">
		<input type="text"   name="payout_digits" id="payout_digits" class="span8 tip" placeholder="Enter Game Digit" required>
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Payout Amount</label>
		<div class="controls">
		<input type="text"   name="payout_amount" id="payout_amount" class="span8 tip" placeholder="Enter Payout Amount" required>
		</div>
		</div>

		<div class="control-group">
			<div class="controls">
			<?php $_SESSION["csrf_token"] = md5(rand(0,10000000)).time(); ?>
			<input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION["csrf_token"]);?>">
				<button type="submit" name="submit" class="btn btn-success">Submit</button>
			</div>
		</div>
		</form>
		
		
        </div>
      </div>
    </div>
	</div>
	
	
	<div class="row-fluid">
	<div class="span11">
  
        <div class="widget-box">
        <div class="widget-title panel-heading"> <span class="icon"><i class="icon-th"></i></span>
            <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseTwo" value="View Digits Payout Rate">
          </div>
          <div class="widget-content nopadding panel-collapse collapse in" id="collapseTwo">
            <table class="table table-bordered data-table">
            <thead>
										<tr>
											<th>#</th>
											<th>Game Name</th>
											<th>Digit</th>
											<th>Payout Rate</th>
											<th>Active</th>
											<th>Action</th>
										</tr>
		  </thead>
             <tbody>

			<?php 
			$query_new=mysqli_query($con,"select tbl_lucky28_digits_payout_default.id as id1,tbl_lucky28_digits_payout_default.game_id,tbl_lucky28_digits_payout_default.payout_digits,tbl_lucky28_digits_payout_default.payout_amount,tbl_lucky28_digits_payout_default.is_active,tbl_game.id, tbl_game.game_name from tbl_lucky28_digits_payout_default join tbl_game on  tbl_lucky28_digits_payout_default.game_id = tbl_game.id");
			$cnt=1;
			while($res=mysqli_fetch_array($query_new)) {
				//echo '<pre>';print_r($res);
			$id=$res['id1'];
			?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($res['game_name']);?></td>
											<td><?php echo htmlentities($res['payout_digits']);?></td>
											<td><?php echo htmlentities($res['payout_amount']);?></td>
											<td class="">
											<?php $stylepopular= ''; $stylenotpopular= '';?>
											<?php 
											if($res['is_active']==0)
											{
												$stylepopular= "style= display:none";
											}
											
											if($res['is_active']==1)
											{
												$stylenotpopular= "style= display:none";
											}
											
											?>
				                          <img id="imgnotpopular<?php echo $res['id1']; ?>" onclick="funisactive(<?php echo $res['id1']; ?>,1,'tbl_lucky28_digits_payout_default');" src='images/off.png' width='60' <?php echo $stylenotpopular;?> />
				                          <img id="imgpopular<?php echo $res['id1']; ?>" onclick="funisactive(<?php echo $res['id1']; ?>,0,'tbl_lucky28_digits_payout_default');" src='images/on.png'  width='60' <?php echo $stylepopular;?> />
										  </td>
										  <td>
											<a href="edit_game_digits_payout.php?id=<?php echo toPublicId($res['id1']);?>" ><i class="fa fa-edit"></i></a>
											<a href="game_digits_payout.php?id=<?php echo toPublicId($id);?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
				</tbody>				
            </table>
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
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.tables.js"></script>
<script src="js/jquery.validate.js"></script>
<script type="text/javascript"> 
 // Setup form validation on the #register-form element
 
  $("#game_payout").validate({
    
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
            },
		
       },
        // Specify the validation error messages
        messages: {
            game_name: "Please enter game name",
			payout_digits: "Please enter payout digits",
			payout_amount: "Please enter payout amount"
			
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
<script>
		
		function funisactive(id,is_active,table_name)
		{
			 $.ajax({  
			 type: "POST",  
			 url: "change_active.php",  
			 data: "id=" + id + "& is_active=" + is_active + "& table_name=" + table_name,  
			 success: function(){  
				//success (not finished)
				if(is_active=='1')
				{
				document.getElementById('imgnotpopular'+id).style.display='none';
				document.getElementById('imgpopular'+id).style.display='block';
				}
				else
				{
				document.getElementById('imgnotpopular'+id).style.display='block';
				document.getElementById('imgpopular'+id).style.display='none';
				}
				
				}  
			 });  
		  return false;  
		   
		}
</script>
</body>
</html>
<?php }?>
