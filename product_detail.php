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
$gift_coins_exchange_rate = $user_obj->gift_coins_exchange_rate();
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
	<div class="container bgwhite p-t-35 p-b-20">
		<div class="flex-w flex-sb">
		<?php
                            $product_id=toInternalId($_GET['product_id']);
							$query = "SELECT * FROM  products where id=$product_id";
							$result = mysqli_query($con, $query) or die(mysqli_error($con));
					        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
							$price = $row['productPrice'];
							$price = $price*$gift_coins_exchange_rate;
							$productName=$row['productName'];
							$productCompany = $row['productCompany'];
							$category=$row['category'];
							$gift_coins_value=$row['gift_coins_value'];
							$validity_of_vip_package=$row['validity_of_vip_package'];
							$productImage1=$row['productImage1'];
							$productImage2=$row['productImage2'];
							$productImage3=$row['productImage3'];
							if($user_type=='vip')
							{
							$act_productPrice=$price;
							$dis= $act_productPrice*$discount_vip/100;
							$discount = number_format($dis);
							$productPrice = $act_productPrice - $dis;
							}
							else
							{
							$productPrice=$price;
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
								<div class="prc_<?php echo $productCompany;?>_detail">$ <?php echo $row['productPrice'];?></div>
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
				<img alt="Gift Coins" src="images/GiftCoin.png" /><b><?php  echo number_format($act_productPrice); ?></b>
				</span>
				<span class="dis_price">
				<img alt="Gift Coins" src="images/GiftCoin.png" /><b><?php  echo number_format($productPrice); ?></b>
				</span>
				<span class="discount" id="discount">(<?php echo $discount_vip;?>%)</span>
				<?php } else {?>
				<img alt="Gift Coins" src="images/GiftCoin.png" style="float:left;width:10%;padding-right: 5px;" /><b><?php  echo number_format($productPrice); ?></b>
				<?php }?>
				</span>
				<p class="s-text8 p-t-10 pro-des">
					<?php echo $product_description;?>
				</p>
				<!--  -->
				<div class="p-t-5 p-b-5">
					
					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
								<!-- Button -->
								<input type="button" name="add_to_cart" id="<?php echo $row["id"]; ?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 add_to_cart" value="Add to Cart" /> 
								<input type="hidden" name="quantity" id="quantity<?php echo $row["id"]; ?>" class="form-control" value="1" />
							</div>
						</div>
					</div>
				</div>
			</div>
				<?php } ?>		
		</div>
	</div>
	<!-- Relate Product -->
	<section class="relateproduct bgwhite p-t-10 p-b-20">
		<div class="container">
			<div class="sec-title p-b-20">
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
							$price = $row['productPrice'];
							$price = $price*$gift_coins_exchange_rate;
							$productName=$row['productName'];
							$productCompany = $row['productCompany'];
							$category=$row['category'];
							$gift_coins_value=$row['gift_coins_value'];
							$validity_of_vip_package=$row['validity_of_vip_package'];
							$productImage1=$row['productImage1'];
							$productImage2=$row['productImage2'];
							$productImage3=$row['productImage3'];
							if($user_type=='vip')
							{
							$act_productPrice=$price;
							$dis= $act_productPrice*10/100;
							$discount = number_format($dis);
							$productPrice = $act_productPrice - $dis;
							}
							else
							{
							$productPrice=$price;
							}
							$product_description=$row['productDescription'];
							$product_status=$row['product_status'];
						
								
									?>

					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative <?php if($user_type=='vip'){?>block2-labelnew <?php }?>">
								<img src="admin/productimages/<?php echo $productName;?>/<?php echo $productImage1;?>" alt="IMG-PRODUCT">
								<div class="prc_<?php echo $productCompany;?>">$ <?php echo $row['productPrice'];?></div>
								<div class="block2-overlay trans-0-4">
									<div class="block2-btn-addcart w-size1 trans-0-4 addcart">
										<!-- Button -->
										<input type="button" name="add_to_cart" id="<?php echo $row["id"]; ?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 add_to_cart" value="Add to Cart" />
										<input type="hidden" name="quantity" id="quantity<?php echo $row["id"]; ?>" class="form-control" value="1" /> 
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
							<img alt="Gift Coins" src="images/GiftCoin.png" /><b><?php  echo number_format($act_productPrice); ?></b>
							</span>
							<span class="dis_price">
							<img alt="Gift Coins" src="images/GiftCoin.png" /><b><?php  echo number_format($productPrice); ?></b>
							</span>
							<span class="discount" id="discount">(<?php echo $discount_vip;?>%)</span>
							<?php } elseif($user_type=='normal') {?>
							<img alt="Gift Coins" src="images/GiftCoin.png" style="float:left;width:10%;padding-right: 5px;" /><b><?php  echo number_format($productPrice); ?></b>
							<?php }?>
							</span>
							<?php
							$useragent=$_SERVER['HTTP_USER_AGENT'];
							if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
							{?>
							<div class="addcart">
							<input type="button" name="add_to_cart" id="<?php echo $row["id"]; ?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 add_to_cart mob_add_to_cart" value="Add to Cart" /> 
							</div>
							<?php }?>
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
		$('.addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});

		$('.btn-addcart-product-detail').each(function(){
			var nameProduct = $('.product-detail-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
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
                var product_quantity = $('#quantity' + product_id).val();
				var action = "add";
                if (product_quantity > 0)
                {
                    $.ajax({
                        url: "action.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            product_id: product_id,
                            product_quantity: product_quantity,
							action: action
                        },
                        success: function (data)
                        {
                            $('.order_table').html(data.cart_append);
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
<?php require_once('templates/chat_script.php');?>
</body>
</html>