<?php session_start();?>
<!DOCTYPE html>
<head>
	<title>Product Details</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once('templates/common_css.php');?>
</head>
<body class="animsition">
<?php require_once('templates/header.php');
$user_obj = new Cl_User();
$userid = $_SESSION['id'];
$user_type = $user_obj->user_type($userid);
$discount_vip = $user_obj->vip_discount();
require_once('includes/function.php');
?>
<?php
$product_id=toInternalId($_GET['product_id']);
$query = "SELECT * FROM  products where id=$product_id";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row=mysqli_fetch_array($result);

?>
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
		<h2 class="l-text2 t-center">
			<?php echo $row['productName'];?>
		</h2>
	</section>
	<!-- breadcrumb -->
	
	<!-- Product Detail -->
	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
		<?php
                            $product_id=toInternalId($_GET['product_id']);
							$query = "SELECT * FROM  products where id=$product_id";
							$result = mysqli_query($con, $query) or die(mysqli_error($con));
					        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
							$productName=$row['productName'];
							$productImage1=$row['productImage1'];
							$productImage2=$row['productImage2'];
							$productImage3=$row['productImage3'];
							if($user_type=='vip')
							{
							$act_productPrice=$row['productPrice'];
							$dis= $act_productPrice*$discount_vip/100;
							$discount = number_format($dis);
							$productPrice = $act_productPrice - $discount;
							}
							else
							{
							$productPrice=$row['productPrice'];
							}
							$product_description=$row['productDescription'];
							$product_status=$row['product_status'];
						?>
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>
					<div class="slick3">
					   <?php if ($productImage1!=''){?>
						<div class="item-slick3" data-thumb="admin/productimages/<?php echo $productName;?>/<?php echo $productImage1;?>">
							<div class="wrap-pic-w">
								<img src="admin/productimages/<?php echo $productName;?>/<?php echo $productImage1;?>" alt="IMG-PRODUCT">
							</div>
						</div>
					   <?php }?>
						<?php if ($productImage2!=''){?>
						<div class="item-slick3" data-thumb="admin/productimages/<?php echo $productName;?>/<?php echo $productImage2;?>">
							<div class="wrap-pic-w">
								<img src="admin/productimages/<?php echo $productName;?>/<?php echo $productImage2;?>" alt="IMG-PRODUCT">
							</div>
						</div>
						<?php }?>
						<?php if ($productImage3!=''){?>
						<div class="item-slick3" data-thumb="admin/productimages/<?php echo $productName;?>/<?php echo $productImage3;?>">
							<div class="wrap-pic-w">
								<img src="admin/productimages/<?php echo $productName;?>/<?php echo $productImage3;?>" alt="IMG-PRODUCT">
							</div>
						</div>
						<?php }?>
					</div>
				</div>
			</div>		
			<div class="w-size14 p-t-30 respon5">
				<h4 class="product-detail-name m-text16 p-b-13">
					<?php echo $productName;?>
				</h4>
				<span class="m-text17">
				<?php if($user_type=='vip') {?>
				<span class="act_price">
				<img alt="Game Coins" src="images/GameCoin.png" /><b><?php  echo $act_productPrice; ?></b>
				</span>
				<span class="dis_price">
				<img alt="Game Coins" src="images/GameCoin.png" /><b><?php  echo $productPrice; ?></b>
				</span>
				<span class="discount" id="discount">(<?php echo $discount_vip;?>%)</span>
				<?php } else {?>
				<img alt="Game Coins" src="images/GameCoin.png" style="float:left;width:10%;padding-right: 5px;" /><b><?php  echo $productPrice; ?></b>
				<?php }?>
				</span>
				<p class="s-text8 p-t-10">
					<?php echo $product_description;?>
				</p>
				<!--  -->
				<div class="p-t-33 p-b-60">
					<!--<div class="flex-m flex-w p-b-10">
						<div class="s-text15 w-size15 t-center">
							Size
						</div>
						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="selection-2" name="size">
								<option>Choose an option</option>
								<option>Size S</option>
								<option>Size M</option>
								<option>Size L</option>
								<option>Size XL</option>
							</select>
						</div>
					</div>
					<div class="flex-m flex-w">
						<div class="s-text15 w-size15 t-center">
							Color
						</div>

						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="selection-2" name="color">
								<option>Choose an option</option>
								<option>Gray</option>
								<option>Red</option>
								<option>Black</option>
								<option>Blue</option>
							</select>
						</div>
					</div>-->
					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<!--<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
								<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>
								<input class="size8 m-text18 t-center num-product" type="number" name="num-product" value="1">
								<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>-->
							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
								<!-- Button -->
								<input type="button" name="add_to_cart" id="<?php echo $row["id"]; ?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 add_to_cart" value="Add to Cart" /> 
								<input type="hidden" name="quantity" id="quantity<?php echo $row["id"]; ?>" class="form-control" value="1" />  
                                    <input type="hidden" name="hidden_name" id="name<?php echo $row["id"]; ?>" value="<?php echo $productName; ?>" />  
                                    <input type="hidden" name="hidden_price" id="price<?php echo $row["id"]; ?>" value="<?php echo $productPrice; ?>" /> 
									<input type="hidden" name="hidden_image" id="image<?php echo $row["id"]; ?>" value="<?php echo $productImage1; ?>" /> 
							</div>
						</div>
					</div>
				</div>
				<!--<div class="p-b-45">
					<span class="s-text8 m-r-35">SKU: MUG-01</span>
					<span class="s-text8">Categories: Mug, Design</span>
				</div>
					-->
				<!--  -->
				<!--<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Description
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
                <?php //echo $product_description;?>						
				</p>
					</div>
				</div>-->
			</div>
				<?php } ?>		
		</div>
	</div>
	<!-- Relate Product -->
	<section class="relateproduct bgwhite p-t-45 p-b-138">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Related Products
				</h3>
			</div>
			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
				<?php

			                $product_id=$_GET['product_id'];
							$query = "SELECT * FROM  products limit 6";
							$result = mysqli_query($con, $query) or die(mysqli_error($con));
					        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
							$productName=$row['productName'];
							$productImage1=$row['productImage1'];
							$productImage2=$row['productImage2'];
							$productImage3=$row['productImage3'];
							if($user_type=='vip')
							{
							$act_productPrice=$row['productPrice'];
							$dis= $act_productPrice*10/100;
							$discount = number_format($dis);
							$productPrice = $act_productPrice - $discount;
							}
							else
							{
							$productPrice=$row['productPrice'];
							}
							$product_description=$row['productDescription'];
							$product_status=$row['product_status'];
						
								
									?>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative <?php if($user_type=='vip'){?>block2-labelnew <?php }?>">
								<img src="admin/productimages/<?php echo $productName;?>/<?php echo $productImage1;?>" alt="IMG-PRODUCT">
								<div class="block2-overlay trans-0-4">
									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<input type="button" name="add_to_cart" id="<?php echo $row["id"]; ?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 add_to_cart" value="Add to Cart" />
										<input type="hidden" name="quantity" id="quantity<?php echo $row["id"]; ?>" class="form-control" value="1" />  
                                    <input type="hidden" name="hidden_name" id="name<?php echo $row["id"]; ?>" value="<?php echo $productName; ?>" />  
                                    <input type="hidden" name="hidden_price" id="price<?php echo $row["id"]; ?>" value="<?php echo $productPrice; ?>" /> 
									<input type="hidden" name="hidden_image" id="image<?php echo $row["id"]; ?>" value="<?php echo $productImage1; ?>" />
									</div>
								</div>
							</div>
							<div class="block2-txt p-t-20">
								<a href="product_detail.php?product_id=<?php echo toPublicId($row['id']);?>" class="block2-name dis-block s-text3 p-b-5">
									<?php echo $productName;?>
								</a>
							<span class="block2-price m-text6 p-r-5">
							<?php if($user_type=='vip') {?>
							<span class="act_price">
							<img alt="Game Coins" src="images/GameCoin.png" /><b><?php  echo $act_productPrice; ?></b>
							</span>
							<span class="dis_price">
							<img alt="Game Coins" src="images/GameCoin.png" /><b><?php  echo $productPrice; ?></b>
							</span>
							<span class="discount" id="discount">(<?php echo $discount_vip;?>%)</span>
							<?php } elseif($user_type=='normal') {?>
							<img alt="Game Coins" src="images/GameCoin.png" style="float:left;width:10%;padding-right: 5px;" /><b><?php  echo $productPrice; ?></b>
							<?php }?>
							</span>
							</div>
						</div>
					</div>
							<?php } ?>
					
				</div>
			</div>

		</div>
</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
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
<link rel="stylesheet" href="css/jquery.range.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="js/jquery.range.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
        $(document).ready(function (data) {
            $('.add_to_cart').click(function () {
                var product_id = $(this).attr("id");
                var product_name = $('#name' + product_id).val();
                var product_price = $('#price' + product_id).val();
                var product_quantity = $('#quantity' + product_id).val();
				var product_image = $('#image' + product_id).val();
                var action = "add";
                if (product_quantity > 0)
                {
                    $.ajax({
                        url: "action.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            product_id: product_id,
                            product_name: product_name,
                            product_price: product_price,
                            product_quantity: product_quantity,
							 product_image: product_image,
                            action: action
                        },
                        success: function (data)
                        {
                            $('#order_table').html(data.cart_append);
                            $('.badge').text(data.cart_item);
                            //alert("Product has been Added into Cart");
                        }
                    });
                } else
                {
                    alert("Please Enter Number of Quantity")
                }
            });
        });
</script>
<link rel="stylesheet" href="css/products.css"> 
</body>
</html>