<?php
session_start();
error_reporting(0);
include('includes/config.php');
$user_obj = new Cl_User();
$uid =$_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="MediaCenter, Template, eCommerce">
	<meta http-equiv="pragma" content="no-cache" />
	<meta name="robots" content="all">
	<title>Game Zone</title>
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	<!-- Customizable CSS -->
<?php require_once('templates/common_css.php');?>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="admin/css/matrix-style.css" />
	<link rel="stylesheet" href="admin/css/matrix-media.css" />

</head>
<body class="animsition" style="font-family:Poppins-regular!important;">
	<?php require_once('templates/header.php');?>
	<!-- ============================================== HEADER : END ============================================== -->
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
		<h2 style="color:#fff;">Game Zone</h2>
	</section>
	<section class="bgwhite">
		<div class="container" style="padding:0px;">
			<div class="body-content outer-top-bd">
				<div class="container" style="padding:0px;">
					<div class="checkout-box inner-bottom-sm">
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="panel-group checkout-steps" id="accordion">
						
<!-- checkout-step-02  -->
<div class="panel panel-default checkout-step-02">
	<!-- panel-heading -->
		<!-- panel-body  -->
		<div class="panel-body" style="padding:0 !important;">
			<div class="row">		
				<div class="col-md-12 col-sm-12 already-registered-login coin-balance">
					<div class="row col-md-12 form-group">
						<?php
						//date_default_timezone_set('UTC');// change according timezone
						//$currentTime = date( 'Y-m-d H:i:s', time () );
					?>
				</div>
			<div id="pp">
	<table id="employee_grid" class="table table-condensed table-hover table-striped" width="60%" cellspacing="0" data-toggle="bootgrid">
			<thead>
				<tr>
					<th data-column-id="id" data-type="numeric" data-identifier="true">#</th>
					<th data-column-id="employee_name">Game Name</th>
					<th data-column-id="employee_salary">Date</th>
					<th data-column-id="employee_age">Winning No</th>
					<th data-column-id="employee_age">Total Bets</th>
					<th data-column-id="employee_age">My Bets</th>
					<th data-column-id="employee_age">Total Won</th>
					<th data-column-id="employee_age">My Won</th>
					<th data-column-id="employee_age">Status</th>
					
					
							
				</tr>
			</thead>
		</table>
					
				</div>	
				<!-- already-registered-login -->		
			</div>			
		</div>
		<!-- panel-body  -->
</div>
			</div><!-- /.checkout-steps -->
		</div>
	</div><!-- /.row -->
</div><!-- /.checkout-box -->
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
<?php //require_once('templates/common_js.php');?>
<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--<script  src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="nonymous"></script>-->
<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
<script type="text/javascript">

var grid = $("#employee_grid").bootgrid({
    ajax: true,
    rowSelect: true,   
    url: "response.php"
    
   })

$(".selection-1").select2({
	minimumResultsForSearch: 20,
	dropdownParent: $('#dropDownSelect1')
});
$(".selection-2").select2({
	minimumResultsForSearch: 20,
	dropdownParent: $('#dropDownSelect2')
});
</script>
<script src="js/main.js"></script>
<script src="js/jquery-1.11.1.min.js"></script>
<!-- jQuery Form Validation code -->
<script src="admin/js/jquery.dataTables.min.js"></script> 
<script src="admin/js/matrix.js"></script> 
<script src="admin/js/matrix.tables.js"></script>

</body>
</html>