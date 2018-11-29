<?php session_start();
require_once('includes/function.php');
require_once('includes/config.php');
	?>



<!DOCTYPE html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	 <link href="css/bootstrap.min.css" rel="stylesheet">
	 <style>
	 .main_menu > li > a {
    font-family: Montserrat-Regular !important;
	 }
	 #productContainer
	 {
		  font-family: Montserrat-Regular !important;
	 }
	</style>
</head>
<body class="animsition">
<?php
require_once('templates/header.php');
//error_reporting(1);
//print_r($_SESSION);
/*if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['product_id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
			echo "<script>window.location='product.php'</script>";
		}else{
			$message="Product ID is invalid";
		}
	}
}*/


?>

	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
		<h2 class="l-text2 t-center">
		View Request
		</h2>
		<p class="m-text13 t-center">
			
		</p>
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
			<?php require_once('templates/friends_sidebar.php');?>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
				
					<!--  -->
					<!--<div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">
							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="country" id="ddltest" name="sorting">
								     <option value='ASC'> Price: Low to High </option>
                                     <option value='DESC'> Price: High to Low </option>
								</select>

							</div>

							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting">
									<option>Price</option>
									<option>$0.00 - $50.00</option>
									<option>$50.00 - $100.00</option>
									<option>$100.00 - $150.00</option>
									<option>$150.00 - $200.00</option>
									<option>$200.00+</option>

								</select>
							</div>
						</div>

						<span class="s-text8 p-t-5 p-b-5">
							Showing 1–12 of 16 results
						</span>
					</div>-->
					

					<!-- Product -->
					<div class="row" id="productContainer">

					 <?php
                        if (isset($_SESSION['id'])) {
                       $member_id = $_SESSION['id'];
                        }

                 
                        $sendReq = "SELECT * FROM friendrequest";
					    $res = mysqli_query($con, $sendReq) or die(mysqli_error($con));
						$rowRe = mysqli_fetch_array($res, MYSQLI_BOTH);
						
						
						 $sender=$rowRe['sender_id'];
						
	                $query1 = mysqli_query($con,"SELECT * FROM friendrequest WHERE receiver_id='$member_id'");
					 
                                 if(mysqli_num_rows($query1) > 0) 
								 
								 {
								 
								 
                                 while($row = mysqli_fetch_array($query1)) 
								 
								 { 
								 
								 
                                 $query2 = mysqli_query($con,"SELECT * FROM users WHERE id = '" . $sender . "'");
                                 while($row2 = mysqli_fetch_array($query2)) 
								 
								 {
                                  
						
					?>
	
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relativ">
									<img src="users-images/<?php echo $row2['user_picture'];?>" alt="IMG-PRODUCT">

									<div class="trans-0-4">
									

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<!--<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>-->
									
									
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="#" class="block2-name dis-block s-text3 p-b-5">
										<?php echo $row2['name'];?>
									</a>
								</div>
								<a href="accept_request.php?accept=<?php echo $sender;?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Accept Request</a>
								<br>
								<a href="delete_request.php?accept=<?php echo $sender;?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Remove Request</a>
							</div>
									 
							
								</div>
								<?php
								 } }}else{
									echo " you don't have request";
								 }
							  ?>
							  
			
			
					</div>


											</div>
				</div>
			</div>
		</div>
			
	</section>
<?php require_once('templates/footer.php');?>
<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
	


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
	<script type="text/javascript">
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});

		$('.btn-addcart-product-detail').each(function(){
			var nameProduct = $('.product-detail-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});
	</script>

<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<link rel="stylesheet" href="css/jquery.range.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="js/jquery.range.js"></script>

</body>
</html>