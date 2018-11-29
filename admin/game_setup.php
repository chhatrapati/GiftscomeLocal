<?php
session_start();
include('include/config.php');
include('include/function.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
$pre_game_name = "Game#00";
//date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_POST['submit']) && @$_SESSION["csrf_token"] == @$_POST['csrf_token'])
{
	//print_r($_POST); die();
	$game_name=$_POST['game_name'];
	$game_start_time=$_POST['game_start_time'];
	$game_duration=$_POST['game_duration'];
	$sql12=mysqli_query($con,"insert into tbl_game(game_name,game_start_time,game_duration) values('$game_name','$game_start_time','$game_duration')");
	$lastid = mysqli_insert_id($con);
	/*Set payout rate of new create game in table tbl_game_payout*/
	$sql23=mysqli_query($con, "select * from tbl_default_payout");
	while($result=mysqli_fetch_array($sql23)) {
		$payout_digit = $result['payout_digit'];
		$payout_amount = $result['payout_amount'];
		$sql56=mysqli_query($con,"insert into tbl_game_payout(game_id,payout_digit,payout_amount) values('$lastid','$payout_digit','$payout_amount')");
	}
    $_SESSION['msg']="Record Added!!";

}
/*Automatic create game*/
if(isset($_POST['autocreate']) && @$_SESSION["csrf_token_1234"] == @$_POST['csrf_token_1234'])
{
	
	$j = 0; for ($i = 1;$i <6; $i++) { $j= $j+3;
	//date_default_timezone_set('UTC');// change according timezone
	$currentTime = date( 'Y-m-d H:i:s', time () );
	$time_extend = date('Y-m-d H:i:s',strtotime('+'.$j.' minutes',strtotime($currentTime)));
	//$game_name=$_POST['game_name'].$i;
	$query142=mysqli_query($con,"select id FROM tbl_game ORDER BY id DESC LIMIT 1");
	$result142=mysqli_fetch_array($query142);
	$lid=$result142['id']+1;
	$last_id = $lid;
	$game_name=$pre_game_name.$last_id;
	$game_start_time=$time_extend;
	$game_duration='3';
	$sql=mysqli_query($con, "insert into tbl_game(game_name,game_start_time,game_duration) values('$game_name','$game_start_time','$game_duration')");
	$lastid = mysqli_insert_id($con);
	/*Set payout rate of new create game in table tbl_game_payout*/
	$sql23=mysqli_query($con, "select * from tbl_default_payout");
	while($result=mysqli_fetch_array($sql23)) {
		$payout_digit = $result['payout_digit'];
		$payout_amount = $result['payout_amount'];
		$sql56=mysqli_query($con,"insert into tbl_game_payout(game_id,payout_digit,payout_amount) values('$lastid','$payout_digit','$payout_amount')");
	}
	}
    $_SESSION['msg']="Record Added!!";

}
if(isset($_GET['del']))
		  {
		          $id = toInternalId($_GET['id']);
				  mysqli_query($con,"delete from tbl_game where id = '".$id."'");
				  mysqli_query($con,"delete from tbl_game_payout where game_id = '".$id."'");
                  $_SESSION['delmsg']="Record deleted !!";?>
				   <script type="text/javascript">
					setTimeout(function () {
					var basepath = window.location.protocol + '//' + window.location.hostname;
					var path = basepath + '/giftscome/admin/game_setup.php';
					window.location.href= path; // the redirect goes here
					},1000); // 5 seconds
				</script>
				
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Game Setup Process | Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />
</head>
<body>

<?php require_once('include/header.php');?>
<!--sidebar-menu-->
<?php require_once('include/sidebar.php');?>
<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Game Setup Process</a> </div>
  
</div>
<div class="container-fluid">
  <hr>
  <!-- Auto create game on button click-->
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
        <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsethree" value="Quick Create Game">
        </div>
        <div class="widget-content nopadding panel-collapse collapse" id="collapsethree">
		
		
		<form class="form-horizontal" name="autocreate" id="autocreate" method="post"  enctype="multipart/form-data" >
		
		<div class="control-group">
		<?php 
			$query12=mysqli_query($con,"select id FROM tbl_game ORDER BY id DESC LIMIT 1");
			 $result12=mysqli_fetch_array($query12);
			 $id=$result12['id']+1;
			?>		
		<label class="control-label">Game Name</label>
		<div class="controls">
	    <input size="16" type="text" name="game_name" id="game_name" class="" readonly value="<?php echo $pre_game_name.@$id;?>" placeholder="Enter Game Name">
		<input type="hidden" name="last_id" id="last_id" class="" readonly value="<?php echo $id;?>">
	    </div>
	    </div>
		
		<div class="control-group">
			<div class="controls">
			<?php $_SESSION["csrf_token_1234"] = md5(rand(0,10000000)).time(); ?>
			<input type="hidden" name="csrf_token_1234" value="<?php echo htmlspecialchars($_SESSION["csrf_token_1234"]);?>">
				<button type="submit" name="autocreate" class="btn btn-success">Create Game</button>
			</div>
		</div>
		</form>
		
		
        </div>
      </div>
    </div>
	</div>
  
  
  
  
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
        <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseOne" value="Create New Game">
        </div>
        <div class="widget-content nopadding panel-collapse collapse" id="collapseOne">
		
		
		<form class="form-horizontal" name="game_start" id="game_start" method="post"  enctype="multipart/form-data" >
		
		<div class="control-group">
		<?php 
			$query12=mysqli_query($con,"select id FROM tbl_game ORDER BY id DESC LIMIT 1");
			 $result12=mysqli_fetch_array($query12);
			 $id=$result12['id']+1;
			?>		
		<label class="control-label">Game Name</label>
		<div class="controls">
	    <input size="16" type="text" name="game_name" id="game_name" class="" value="<?php echo $pre_game_name.@$id;?>" placeholder="Enter Game Name">
	    </div>
	    </div>
		
		<div class="control-group">
		<label class="control-label">Game Starting Time</label>
		<div class="controls">
	    <input size="16" type="text" value="" name="game_start_time" id="game_start_time" class="form_datetime" placeholder="Select Game Starting Time" required>
	    </div>
	    </div>	
		
		<div class="control-group">
		<label class="control-label" for="basicinput">Duration Of Game <br/> (In Minutes)</label>
		<div class="controls">
		<input type="number"   name="game_duration" id="game_duration" class="" placeholder="Enter Duration Of Game" required>
		
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
            <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseTwo" value="Manage Game Setup">
          </div>
          <div class="widget-content nopadding panel-collapse collapse in" id="collapseTwo">
            <table class="table table-bordered data-table">
            <thead>
										<tr>
											<th>#</th>
											<th>Game Name</th>
											<th>Game Starting Time</th>
											<th>Duration Of Game (In Minutes)</th>
											<th>Active</th>
											<th>Action</th>
										</tr>
		  </thead>
             <tbody>

			<?php 
			$query_new=mysqli_query($con,"select * from tbl_game");
			$cnt=1;
			while($res=mysqli_fetch_array($query_new)) {
				//echo '<pre>';print_r($res);
			$id=$res['id'];
			?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td>
											<?php if($res['game_name']!=''){?>
											<?php echo htmlentities($res['game_name']);?>
											<?php } else {?>
											Game#0001<?php echo htmlentities($res['id']);?>
											<?php }?></td>
											<td><?php echo htmlentities($res['game_start_time']);?></td>
											<td><?php echo htmlentities($res['game_duration']);?></td>
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
				                          <img id="imgnotpopular<?php echo $res['id']; ?>" onclick="funisactive(<?php echo $res['id']; ?>,1,'tbl_game');" src='images/off.png' width='60' <?php echo $stylenotpopular;?> />
				                          <img id="imgpopular<?php echo $res['id']; ?>" onclick="funisactive(<?php echo $res['id']; ?>,0,'tbl_game');" src='images/on.png'  width='60' <?php echo $stylepopular;?> />
										  </td>
										  <td>
											<a href="edit_game_setup.php?id=<?php echo toPublicId($res['id']);?>" ><i class="fa fa-edit"></i></a>
											<a href="game_setup.php?id=<?php echo toPublicId($id);?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></a></td>
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
 
  $("#game_start").validate({
    
        // Specify the validation rules
		rules : {
		 game_name: {
            remote: {
					url: "check-game_name.php",
					type: "post",
					data: {
						game_name: function() {
							return $( "#game_name" ).val();
						}
					}
				}
            },
		game_start_time: {
            required: true
            },
		game_duration: {
            required: true,
			digits: true
	    },
		
		
       },
        // Specify the validation error messages
        messages: {
			game_name : {remote : "Game name already exists"},
            game_start_time: "Please enter game starting time",
			game_duration: {required: "Please enter duration of game"}
			
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
<script src="js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii",
        showMeridian: true,
        autoclose: true,
        todayBtn: true,
		startDate: new Date()
    });
</script>       
</body>
</html>
<?php }?>
