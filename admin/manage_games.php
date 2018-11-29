<?php
session_start();
error_reporting(0);
require_once('include/config.php');
require_once('include/function.php');
require_once('Coins.php');
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(!empty($_POST)){ 
		try {
			$user_obj = new User_Coins();
			$data = $user_obj->update_user_wallet( $_POST );
			//if($data)$success = USER_REGISTRATION_SUCCESS;
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin| Manage Games</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php require_once('include/common_css.php');?>
</head>
<body>
<?php require_once('include/header.php');?>
<!--sidebar-menu-->
<?php require_once('include/sidebar.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current"> Manage Games</a> </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
  
        <div class="widget-box">
		<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
             <input type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapsetwo" value="Manage Games">
          </div>
      
         <div class="widget-content nopadding panel-collapse collapse in" id="collapsetwo">
		  <div class="widget-box">
          <div class="widget-title">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab1">Current Game</a></li>
              <li><a data-toggle="tab" href="#tab2">Future Games</a></li>
              <li><a data-toggle="tab" href="#tab3">Past Games</a></li>
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
                <table class="table table-bordered data-table" id="example">
            <thead>
										<tr>
											<th>#</th>
											<th>Game Name</th>
											<th>Game Starting Time</th>
											<th>Duration Of Game (In Minutes)</th>
											<th>Action</th>
										</tr>
		  </thead>
             <tbody>

			<?php
			/*$time = time();
			$check = $time+date("Z",$time);
			$utctime_date = strftime("%Y-%m-%d %H:%M:%S", $check);
			echo $utctime_date;*/
			date_default_timezone_set('UTC');// change according timezone
			$currentTime = date( 'Y-m-d H:i', time () );
			//echo strftime("%Y-%m-%d %H:%i:%s UTC", $check);
			//$query_new=mysqli_query($con,"select * from tbl_game  WHERE game_start_time >= '$currentTime'");
			$query_new=mysqli_query($con,"select * from tbl_game  WHERE game_status='1'");
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
										  <td>
											 <form name="" method="post" action="set_game_payout.php">
										  <input type="hidden" name="game_id" id="game_id" value="<?php echo $res['id'];?>">
											<button type="submit" name="submit" class="btn btn-success">Set Payout Rate</button>
										  </form>
										  </td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
				</tbody>				
            </table>	
            </div>
            <div id="tab2" class="tab-pane">
                 <table class="table table-bordered data-table" id="example">
            <thead>
										<tr>
											<th>#</th>
											<th>Game Name</th>
											<th>Game Starting Time</th>
											<th>Duration Of Game (In Minutes)</th>
											<th>Action</th>
										</tr>
		  </thead>
             <tbody>

			<?php 
			//$query_new=mysqli_query($con,"select * from tbl_game  WHERE game_start_time >= '$currentTime'");
			$query_new=mysqli_query($con,"select * from tbl_game  WHERE game_status='0'");
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
										  <td>
										  <form name="" method="post" action="set_game_payout.php">
										  <input type="hidden" name="game_id" id="game_id" value="<?php echo $res['id'];?>">
											<button type="submit" name="submit" class="btn btn-success">Set Payout Rate</button>
										  </form>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
				</tbody>				
            </table>
            </div>
            <div id="tab3" class="tab-pane">
                <table class="table table-bordered data-table" id="example">
            <thead>
										<tr>
											<th>#</th>
											<th>Game Name</th>
											<th>Game Starting Time</th>
											<th>Duration Of Game (In Minutes)</th>
											<th>Action</th>
										</tr>
		  </thead>
             <tbody>

			<?php 
			//$query_new=mysqli_query($con,"select * from tbl_game  WHERE game_start_time < '$currentTime'");
			$query_new=mysqli_query($con,"select * from tbl_game  WHERE game_status='3'");
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
    </div>
  </div>
</div>
<!--Footer-part-->
<?php require_once('include/footer.php');?>
<!--end-Footer-part-->
<?php require_once('include/common_js.php');?><script src="js/jquery.dataTables.min.js"></script> <script src="js/matrix.tables.js"></script>
<script src="js/jquery.validate.js"></script>  
<script type="text/javascript">
 
 // Setup form validation on the #register-form element
    $("#game_coins_update").validate({
        rules : {
        // Specify the validation rules
		game_coins: {
            required: true,
			digits: true
            }
		
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
	
	 $("#gift_coins_update").validate({
        rules : {
        // Specify the validation rules
		
	    gift_coins: {
            required: true,
			digits: true
            }
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
	
	$("#game_coins_deduct").validate({
        rules : {
        // Specify the validation rules
		
	    game_coins: {
            required: true,
			digits: true
            }
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
	
	$("#gift_coins_deduct").validate({
        rules : {
        // Specify the validation rules
		
	    gift_coins: {
            required: true,
			digits: true
            }
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
</body>
</html>
<?php }?>
