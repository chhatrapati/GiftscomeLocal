<?php session_start();
require_once('includes/config.php');
//require_once('includes/function.php');
?>
<!DOCTYPE html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once('templates/common_css.php');?>
</head>
<body class="animsition">
<?php
require_once('templates/header.php');
//error_reporting(1);
//print_r($_SESSION);
?>
	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
		<h2 class="l-text2 t-center">
			Compose Message
		</h2>
		<p class="m-text13 t-center">
			Send Message TO Friend
		</p>
	</section>
	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
			<?php require_once('templates/friends_sidebar.php');?>
				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					
					<div class="form-area">  
        <form role="form" method="post" id="compose">
		<?php
		 $reciver_id=$_POST['reciver_id'];
		 $reciver_name=$_POST['reciver_name'];
		 $sender_name=$_SESSION['username'];
		 $sender_id=$_SESSION['id'];
		$reciver_img=$_POST['reciver_img'];
		$login_userpic=$_SESSION['login_userpic'];
		
	   ?>
						
        <br style="clear:both">
                    <h3 class="s-text13" style="margin-bottom: 25px; font-size:25px; text-align: center;">Compose Message</h3>
					<input type="hidden" name="sender_id" id="sender_id" value="<?php echo $sender_id;?>">
					<input type="hidden" name="sender_name" id="sender_name" value="<?php echo $sender_name;?>">
					<input type="hidden" name="login_userpic" id="login_userpic" value="<?php echo $login_userpic;?>">
					<input type="hidden" name="reciver_id" id="reciver_id" value="<?php echo $reciver_id;?>">
					<input type="hidden" name="reciver_img" id="reciver_img" value="<?php echo $reciver_img;?>">
    				<div class="form-group">
						<input type="text" class="form-control" id="name" name="reciver_name" value="<?php echo $reciver_name;?>" placeholder="Name" required>
					</div>
						
                    <div class="form-group">
                    <textarea class="form-control" type="textarea" name="reciver_msg" id="message" placeholder="Message" maxlength="140" rows="7"></textarea>                   
                    </div>
            
        <input type="submit" id="submit" value="Send Message" name="submit" style="width:22%;float:right;" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
        </form>
    </div>
	<div id="results"></div>

											</div>
				</div>
			</div>
		</div>
	</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#compose").submit(function() {	

    	
		$.ajax({
			type: "POST",
			url: 'send.php',
			data:$("#compose").serialize(),
			success: function (data) {	
				// Inserting html into the result div on success
				$('#results').html(data);
			},
			error: function(jqXHR, text, error){
            // Displaying if there are any errors
            	$('#result').html(error);           
        }
    });
		return false;
	});
});
</script>


</body>
</html>