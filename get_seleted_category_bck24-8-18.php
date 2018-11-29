<?php session_start();
require_once('includes/config.php');
$user_obj = new Cl_User();
require_once('includes/function.php');
$userid = $_SESSION['id'];
$user_type = $user_obj->user_type($userid);
$discount_vip = $user_obj->vip_discount();
$gift_coins_exchange_rate = $user_obj->gift_coins_exchange_rate();
	if(isset($_POST["get_seleted_category"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM products WHERE category = '$id' AND is_active=1";
	$run_query = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($run_query)){
			$product_id=$row['id'];
			$productName=$row['productName'];
			$productImage1=$row['productImage1'];
			$price = $row['productPrice'];
            $price = $price*$gift_coins_exchange_rate;
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
		    $productCompany=$row['productCompany'];
			$product_status=$row['product_status'];
           ?>
			<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-img of-hidden pos-relative <?php if($user_type=='vip'){?>block2-labelnew <?php }?>">
                                        <img src="admin/productimages/<?php echo $productName;?>/<?php echo $productImage1;?>" alt="IMG-PRODUCT" class="pro-img">

                                        <div class="block2-overlay trans-0-4">
                                           <div class="block2-btn-addcart w-size1 trans-0-4">
											<input type="button" name="add_to_cart" id="<?php echo $row["id"]; ?>" style="margin-top:5px;" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 add_to_cart" value="Add to Cart" /> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="block2-txt p-t-20">
                                        <a href="product_detail.php?product_id=<?php echo toPublicId($product_id);?>" class="block2-name dis-block s-text3" id="pro_title">
                                            <?php echo $productName; ?>
                                        </a>
										<span class="block2-price m-text6 p-r-5">
										<?php if($user_type=='vip') {?>
										<span class="act_price">
										<img alt="Gift Coins" src="images/GiftCoin.png" /><b><?php  echo $act_productPrice; ?></b>
										</span>
										<span class="dis_price">
										<img alt="Gift Coins" src="images/GiftCoin.png" /><b><?php  echo $productPrice; ?></b>
										</span>
										<span class="discount" id="discount">(<?php echo $discount_vip;?>%)</span>
										<?php } else {?>
										<img alt="Gift Coins" src="images/GiftCoin.png" style="float:left;width:10%;padding-right: 5px;" /><b><?php  echo $productPrice; ?></b>
										<?php }?>
										</span>
                                    </div>
                                    <input type="hidden" name="quantity" id="quantity<?php echo $row["id"]; ?>" class="form-control" value="1" />  
                                    <input type="hidden" name="hidden_name" id="name<?php echo $row["id"]; ?>" value="<?php echo $productName; ?>" />  
                                    <input type="hidden" name="hidden_price" id="price<?php echo $row["id"]; ?>" value="<?php echo $productPrice; ?>" />  
                                    
                                </div>
                            </div>
<?php } }?>
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
<script>
        $(document).ready(function (data) {
            $('.add_to_cart').click(function () {
                var product_id = $(this).attr("id");
                var product_name = $('#name' + product_id).val();
                var product_price = $('#price' + product_id).val();
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
                            product_name: product_name,
                            product_price: product_price,
                            product_quantity: product_quantity,
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