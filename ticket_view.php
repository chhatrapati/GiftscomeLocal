<?php session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{   
	$_SESSION['url'] = $_SERVER['REQUEST_URI'];
	header('location:login.php');
}
$member_id = $_SESSION['id']; 
$ticket_id = $_GET["ticket"];
$ticket_id = base64_decode(urldecode($ticket_id));
$sql2=mysqli_query($con,"Select * from comments where ticket_id = '$ticket_id' order by created_at desc");
$num_rows = mysqli_fetch_row($sql2);
$Invoice_number1 = $num_rows[0];
if(isset($_POST['reply']) && $_SESSION["csrf_token"] == $_POST['csrf_token'])
{
$body=$_POST['message'];
$sql2=mysqli_query($con,"insert into comments (ticket_id,user_id,comment,created_at) values('$ticket_id','$member_id','$body',NOW())");
$_SESSION['msg']="Record updated Successfully!!";
}
/*Update read status to 1 on open ticket by user*/
mysqli_query($con,"UPDATE comments SET status_by_user = 1 WHERE status_by_user=0 and ticket_id = '$ticket_id'");
?>
<!DOCTYPE html>
<head>
	<title>Support Us</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php require_once('templates/common_css.php');?>
<link rel="stylesheet" href="css/support_ticket.css" />
</head>
<style>
span.help-block {
    color: red !important;
    display: block !important;
}
</style>
<body class="animsition" onLoad="start()">
<?php require_once('templates/header.php');?>
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);"><h2 style="color:#fff;">Support Ticket</h2></section>
	<!-- content page -->
	<section class="bgwhite p-t p-b-38">
		<div class="container">
			<div class="row">
			 <?php if(!empty($_SESSION['msg'])){?>
			                    <div class="col-md-12">
								<div class="alert alert-success" id="successMessage">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
								</div>
								</div>
								<?php } ?>
				<div class="col-md-12 p-b-30">
					<h3 class="m-text26 p-t-15 p-b-16">Support Ticket #<?php echo "GFTC/001/0".$ticket_id ; ?></h3>
					 <?php $select_tic = mysqli_query($con,"Select * from comments c left join users u on c.`user_id` = u.`id` where c.`ticket_id` = '$ticket_id' order by c.created_at desc");
								while ($row = $select_tic->fetch_assoc()) {
									 $msg = $row['comment'];
									 $msg_from = $row['user_id'] == -1 ? "Admin" :  $row['name'];
					 ?>
          <div class="panel panel-primary card-view">
            <div class="panel-heading">
              <div class="pull-left">
                <h6 class="panel-title txt-light"><?php echo $msg_from; ?></h6>
                <span style="font-size: 12px;font-style: italic;" class="txt-light"><?php echo $row['created_at']; ?></span> </div>
              <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
              <div class="panel-body" style="word-wrap: break-word;"> <?php echo  $msg; ?> </div>
            </div>
          </div>
      <?php } ?>
				</div>		
			</div>
			  <div class="row">
                  <div class="col-sm-12">
                   <div class="panel panel-default card-view">
        <div class="panel-heading">
          <h3 class="panel-title">Reply Message</h3>
        </div>
        <div class="panel-body">
          <div id="welcomeDiv"  style="" class="answer_list" >
            <div class="row">
              <div class="col-sm-12">
                <div class="form-wrap">
                  <form method="post" action=""  name="gen_tct" id="gen_tct" method="post">
                    <div class="form-group">
                      <label class="control-label mb-10 text-left">Message*</label>
                      <textarea class="msg" name="message" rows="6" cols="6" style="width:100%"></textarea>
					  <span class="help-block"></span>
                    </div>
					<?php $_SESSION["csrf_token"] = md5(rand(0,10000000)).time(); ?>
				<input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION["csrf_token"]);?>">
                    <input type="submit" class="btn btn-success btn-anim" name="reply" value="Reply" style="margin-bottom:10px;">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
<?php require_once('templates/chat_script_forconflict.php');?>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/additional-methods_new.js"></script>
<!-- jQuery Form Validation code -->
<script type="text/javascript"> 
	$(document).ready(function(){
		$.validator.addMethod('filesize', function (value, element, arg) {
            var minsize=2000; // min 1kb
            if((value>minsize)&&(value<=arg)){
            	return true;
            }else{
            	return false;
            }
        });
 // Setup form validation on the #register-form element
 $("#gen_tct").validate({
 	submitHandler : function(e) {
 		$(form).submit();
 	},
        // Specify the validation rules
        rules : {
        	message : {
				required : true
				
			}
			//attachment:{
                    //required:false,
                    //accept:"image/jpg,image/jpeg,image/png"
					//filesize: 200000   //max size 200 kb
			//	}
			},
        // Specify the validation error messages
        messages: {
			message : {
				required : "Please enter message"
			},
        	//attachment:{
        		//accept:"Please upload .jpg or .png or .jpeg file of notice."
                   // required:"Please upload file.",
					//filesize:" file size must be less than 200 KB."
			//	},
			
		},
		errorPlacement : function(error, element) {
			$(element).closest('div').find('.help-block').html(error.html());
		},
		highlight : function(element) {
			$(element).closest('div').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).closest('div').removeClass('has-error').addClass('has-success');
			$(element).closest('div').find('.help-block').html('');
		}
	});

});
</script>
<!--<script src="vendor/bower_components/tinymce/tinymce.min.js"></script>
<script src="js/tinymce-data.js"></script>-->
</body>
</html>