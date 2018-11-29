<?php session_start();?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="">
	    <meta name="robots" content="all">
       <title>Contact Us</title>
	   <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<?php require_once('templates/common_css.php');?>
<style>
.row {margin-right: 0px;}
</style>
<!--Start of Zendesk Chat Script-->
<!--<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?5n3mHk9u51zdSTKylasbAjuABXN0b1yG";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>-->
<!--End of Zendesk Chat Script-->
</head>
<body class="animsition">
<?php require_once('templates/header.php');?>
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/Contact.jpg);">
		<h2 class="l-text2 t-center">Contact Us</h2>
	</section>
	<!-- content page -->
	<section class="bgwhite p-t-66">
		<div class="container">
			<div class="row">
					<div class="col-md-6 p-b-30">					
						<h4 class="m-text26 p-b-36 p-t-15">
							Send us your message
						</h4>
						<?php if(!empty($_SESSION['msg'])){?>
						<div class="alert alert-success" id="successMessage">
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
						</div>
						<?php }?>
                   <form class="leave-comment" id="myform" method="post" enctype="multipart/form-data">
						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Full Name" required>
						</div>
						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="subject" placeholder="Subject" required>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="mobile" placeholder="Phone Number" required>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email Address" required>
						</div>

						<textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Message"></textarea>

						<div class="w-size25">
							<!-- Button -->
							<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit" name="send_email" value="Send" ><i class="fa fa-paper-plane" aria-hidden="true" style="padding-right:10px "></i>Send</button>
						</div>
					</form>
					<?php
if (isset($_POST['send_email'])){
       
	 $name=$_POST['name'];
	 $email=$_POST['email'];
	 $mobile=$_POST['mobile'];
	 $subject=$_POST['subject'];
	 $message=$_POST['message'];
$to = $admin_email;
//$to = 'preetmtharu@gmail.com';
$subject = $subject;
$msg ='<p>Hi, <br /><br />Contact us form submit by:<br /><br /></p><div style="width: 600px; float: left;">Name: '.$name.'<div style="width: 600px; float: left;">Email: '.$email.'<div style="width: 600px; float: left;">Mobile: '.$mobile.'<div style="width: 600px; float: left;">Message: '.$message.'</h1>';
$user_obj->send_email($to,$subject,$msg);
$_SESSION['msg']='Mail sent successfully.';
}
?>
				</div>
				<div class="col-md-6 p-b-30"><h4 class="m-text26 p-b-36 p-t-15 text-center">Contact us</h4> 
			<form class="s-text7">
            <legend>GiftsCome</legend>
            <address>
               Twitter, Inc.<br>
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                P:(123) 456-7890
            </address>
               </form>
        </div>
			</div>
		</div>
	</section>
<?php require_once('templates/footer.php');?>
<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>
    <?php require_once('templates/common_js.php');?>
	<?php require_once('templates/chat_script.php');?>
<script>
	$(document).ready(function(){
		setTimeout(function() {
			$('#successMessage').fadeOut('fast');
        }, 5000); // <-- time in milliseconds
	});
</script>
</body>
</html>