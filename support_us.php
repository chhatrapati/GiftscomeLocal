<?php session_start();
include('includes/config.php');
$user_obj = new Cl_User();
if(strlen($_SESSION['login'])==0)
{   
	$_SESSION['url'] = $_SERVER['REQUEST_URI'];
	header('location:login.php');
}
$member_id = $_SESSION['id'];
?>
<!DOCTYPE html>
<head>
<title>Support Us</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php require_once('templates/common_css.php');?>
<link rel="stylesheet" href="css/support_ticket.css" />
<?php require_once('templates/datatable_css.php');?>
<style>
span.help-block {color: red !important;display: block !important;}
</style>
</head>
<body class="animsition">
<?php require_once('templates/header.php');?>
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);"><h2 style="color:#fff;">Support Ticket</h2></section>
	<!-- content page -->
	<section class="bgwhite p-t-20 p-b-38">
		<div class="container">
			<div class="row">
			<?php if(!empty($_SESSION['msg'])){?>
			                    <div class="col-md-12">
								<div class="alert alert-success" id="successMessage">
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
								</div>
								</div>
								<?php } ?>
				<div class="col-md-12 p-b-30">
					<h3 class="m-text26 p-t-15 p-b-16">Post a Support Ticket</h3>
					
					 <form method="post" action="support_us_submit.php"  name="gen_tct" id="gen_tct" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                      <label class="control-label mb-10 text-left">Subject* </label>
                      <input type="text" name="subject" class="form-control textbox" value="" placeholder="" required>
					  <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                      <label class="control-label mb-10 text-left">Message*</label>
                      <textarea class="msg" name="message" rows="6" cols="6" style="width:100%;" required></textarea>
					  <span class="help-block"></span>
                    </div>
					 <div class="form-group">
                      <label class="control-label mb-10 text-left">Attach document </label>
                     <input type="file" name="attachment" id="attachment" value="" class="span8 tip">
					 <span class="help-block"></span>
                    </div>
					<?php $_SESSION["csrf_token_3"] = md5(rand(0,10000000)).time(); ?>
				<input type="hidden" name="csrf_token_3" value="<?php echo htmlspecialchars($_SESSION["csrf_token_3"]);?>">
					<input type="submit" class="btn btn-success btn-anim" name="create" value="Create" required>
                  </form>
				</div>
							
			</div>
			
			  <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-default card-view">
                        <div class="panel-heading">
                           <div class="clearfix"></div>                         
                        </div>
                        <div class="panel-wrapper">
                           <div class="panel-body">
                              <div class="table-wrap">
                                 <div class="">
                <table id="example" class="display nowrap"  cellspacing="0" width="100%">
					<thead class="u_g_h">
                    <tr>
                      <th>S.No</th>
					  <th>ticket Id</th>
					  <th>Subject</th>
					  <th>Message</th>
                      <th>Create Date</th>
					  <th>Action</th>
                    </tr>
                  </thead>
				 	<?php
					        $select_tic = mysqli_query($con,"SELECT ticket_id,`message`,`sub`,`created_at`,`user_id` FROM tickets where user_id = '$member_id' ORDER BY ticket_id DESC;");
							$num=0;	
						    while ($row = mysqli_fetch_array($select_tic)) {
							$num++;
									 $ticket_id = $row['ticket_id'];
									 $user_id = $row['user_id'];
									 $sub = $row['sub'];
									 $message = $row['message'];
									 $created_at = $row['created_at'];
					?>
                  <tr>
				  <td><?php echo $num;?></td>
                    <td><?php echo $ticket_id;?></td>
                    <td><?php echo substr($sub,0,20);?></td>
                    <td><?php echo substr($message,0,20);?>...</td>
 					<td><?php echo $created_at;?></td>
					<?php $decryped_id = urlencode(base64_encode("$ticket_id")); ?>
					<?php 
						$status_query = "SELECT * FROM comments WHERE status_by_user=0 and ticket_id = '$ticket_id'";
						$result_query = mysqli_query($con, $status_query);
						$count = mysqli_num_rows($result_query); 
					?>
					<td id="open<?php echo $decryped_id;?>"><a href="ticket_view.php?ticket=<?php echo $decryped_id;?>" class="btn btn-primary ticket_open">Open</a>
					<?php if($count > 0 ) { ?>
					<span class="msg-count"><?php echo $count; ?> </span><?php } ?>
					</td>
                  </tr>
                  <?php } ?>
                </table>
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
<?php require_once('templates/datatable_js.php');?>
<?php require_once('templates/chat_script_forconflict.php');?>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/additional-methods_new.js"></script>
<!-- jQuery Form Validation code -->
<script type="text/javascript"> 
	$(document).ready(function(){
		/*$.validator.addMethod('filesize', function (value, element, arg) {
            var minsize=2000; // min 1kb
            if((value>minsize)&&(value<=arg)){
            	return true;
            }else{
            	return false;
            }
        });*/
 // Setup form validation on the #register-form element
 $("#gen_tct").validate({
 	submitHandler : function(e) {
 		$(form).submit();
 	},
        // Specify the validation rules
        rules : {
        	subject : {
        		required : true
        	},
        	message : {
				required : true
				
			}
			/*attachment:{
                    //required:false,
                    accept:"image/jpg,image/jpeg,image/png",
					filesize: 200000   //max size 200 kb
				}*/
			},
        // Specify the validation error messages
        messages: {
        	subject : {
        		required : "Please enter subject"
        	},
			message : {
				required : "Please enter message"
			},
        	/*attachment:{

        		accept:"Please upload .jpg or .png or .jpeg file of notice.",
                    //:"Please upload file.",
					filesize:" file size must be less than 200 KB."
				},*/
			
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
<script>
	$(document).ready(function(){
		setTimeout(function() {
			$('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
	});
</script>
</body>
</html>