<?php
require_once('includes/function.php');
require_once('templates/header.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['product_id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
			echo "<script>window.location='products.php'</script>";
		}else{
			$message="Product ID is invalid";
		}
	}
}


?>
<!DOCTYPE html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	 <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="animsition">

	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
		<h2 class="l-text2 t-center">
			Women
		</h2>
		<p class="m-text13 t-center">
			New Arrivals Women Collection 2018
		</p>
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
			<?php include('sidebar.php');?>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					<!--<div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">
							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting">
									<option>Default Sorting</option>
									<option>Popularity</option>
									<option>Price: low to high</option>
									<option>Price: high to low</option>
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
					<div class="row">
					
					<?php
					
					
					      $category_id=$_GET['category_id'];
					       $query = "SELECT * FROM  products where category=$category_id";
							$result = mysqli_query($con, $query) or die(mysqli_error($con));
					        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
							
							$product_id=$row['id'];
							$productName=$row['productName'];
							$productImage1=$row['productImage1'];
							$productPrice=$row['productPrice'];
							$productCompany=$row['productCompany'];
							$product_status=$row['product_status'];
						
								
									?>

						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
									<img src="images/<?php echo $productImage1;?>" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<!--<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>-->
									<a href="product.php?page=product&action=add&product_id=<?php echo $product_id;?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Add to Cart</a>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product_detail.php?product_id=<?php echo $product_id;?>" class="block2-name dis-block s-text3 p-b-5">
										<?php echo $productName;?>
									</a>

									<span class="block2-price m-text6 p-r-5">
										Coins: <?php echo $productPrice;?>
									</span>
								</div>
							</div>
						</div>
							<?php } ?>
			

						<!--<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<img src="images/item-03.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button --
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">
										Denim jacket blue
									</a>

									<span class="block2-price m-text6 p-r-5">
										$92.50
									</span>
								</div>
							</div>
						</div>-->

						<!--<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<img src="images/item-05.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">
										Coach slim easton black
									</a>

									<span class="block2-price m-text6 p-r-5">
										$165.90
									</span>
								</div>
							</div>
						</div>-->

						<!--<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
									<img src="images/item-07.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">
										Frayed denim shorts
									</a>

									<span class="block2-oldprice m-text7 p-r-5">
										$29.50
									</span>

									<span class="block2-newprice m-text8 p-r-5">
										$15.90
									</span>
								</div>
							</div>
						</div>--

						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 --
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
									<img src="images/item-01.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button --
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">
										Herschel supply co 25l
									</a>

									<span class="block2-price m-text6 p-r-5">
										$75.00
									</span>
								</div>
							</div>
						</div>--

						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 --
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<img src="images/item-14.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button --
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">
										Denim jacket blue
									</a>

									<span class="block2-price m-text6 p-r-5">
										$92.50
									</span>
								</div>
							</div>
						</div>--

						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 --
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
									<img src="images/item-06.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button --
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">
										Herschel supply co 25l
									</a>

									<span class="block2-price m-text6 p-r-5">
										$75.00
									</span>
								</div>
							</div>
						</div>--

						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 --
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<img src="images/item-08.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button --
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">
										Denim jacket blue
									</a>

									<span class="block2-price m-text6 p-r-5">
										$92.50
									</span>
								</div>
							</div>
						</div>--

						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 --
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<img src="images/item-10.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button --
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">
										Coach slim easton black
									</a>

									<span class="block2-price m-text6 p-r-5">
										$165.90
									</span>
								</div>
							</div>
						</div>--

						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 --
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
									<img src="images/item-11.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button --
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">
										Frayed denim shorts
									</a>

									<span class="block2-oldprice m-text7 p-r-5">
										$29.50
									</span>

									<span class="block2-newprice m-text8 p-r-5">
										$15.90
									</span>
								</div>
							</div>
						</div>--

						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 --
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
									<img src="images/item-12.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button --
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">
										Herschel supply co 25l
									</a>

									<span class="block2-price m-text6 p-r-5">
										$75.00
									</span>
								</div>
							</div>
						</div>--

						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 --
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<img src="images/item-15.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button --
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.php" class="block2-name dis-block s-text3 p-b-5">
										Denim jacket blue
									</a>

									<span class="block2-price m-text6 p-r-5">
										$92.50
									</span>
								</div>
							</div>
						</div>-->
					</div>

					<!-- Pagination -->
					
					
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
<script>
function filterProducts() {
    var price_range = $('.price_range').val();
    $.ajax({
        type: 'POST',
        url: 'getProducts.php',
        data:'price_range='+price_range,
        beforeSend: function () {
            $('.price').css("opacity", ".5");
        },
        success: function (html) {
            $('#productContainer').html(html);
            $('.price').css("opacity", "");
        }
    });
}
</script>
	
	<script>
$('.price_range').jRange({
    from: 0,
    to: 15000,
    step: 50,
    format: '%s USD',
    width: 250,
    showLabels: true,
    isRange : true
});
</script>

<style>
input.flex-c-m.size4.bg7.bo-rad-15.hov1.s-text14.trans-0-4 {
    margin-top: 20px !important;
}
</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("select.country").change(function(){
        var selectedCountry = $(".country option:selected").val();
        //alert("You have selected the country - " + selectedCountry);
		 
		 $.ajax({

              

               type: "POST",

               url: "product_order.php",


               data: {

                product_order: selectedCountry

               },
                success: function(html) {

                

                   $("#productContainer").html(html).show();

               }

           });
		 
    });
});
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  /*$(function() {
    $( "#skills" ).autocomplete({
      source: 'search.php'
	  
    });
  });*/
 $(document).ready(function() {
   var selectedValue = '';
   $( '#skills' ).autocomplete({
       source: 'autocomplete.php',
       select: function(e, ui) {
         selectedValue = ui.item.value;
         //alert(selectedValue);
		 
		 $.ajax({

              

               type: "POST",

               url: "autocomplete_result.php",


               data: {

              search: selectedValue

               },
                success: function(html) {

                

                   $("#productContainer").html(html).show();

               }

           });
		 
		 
       }
   });
 });
  </script>
</body>
</html>