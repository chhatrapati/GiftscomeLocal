<?php session_start();
include('includes/config.php');
$user_obj = new Cl_User();
?>
<?php
//echo '<pre>';print_r($_SESSION);
// code for insert product in order table
$uid= $_SESSION['id'];
$user_balance= $user_obj->get_user_coins_balance($uid);
$User_gift_coins= $user_balance['gift_coins'];
//$user_balance = $row['gift_coins'];
//$_SESSION['gift_coins'] = $user_balance;
if(isset($_POST['ordersubmit'])) 
{
	
    $quantity=$_SESSION['product_quantity'];
    $pdd=$_SESSION['product_id'];
	$_SESSION['tp'] = $_SESSION['tp'];
	
if(strlen($_SESSION['login'])==0)
{   
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
header('location:login.php');
}
if($_SESSION['tp'] <= $User_gift_coins)
{
header('location:payment-method.php');
}
else
{
	header('location:order-failed.php');
}
}
?>
<!DOCTYPE html>
<head>
	<title>Cart</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once('templates/common_css.php');?>
</head>
<body class="animsition">
<?php require_once('templates/header.php');?>
	
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
		<h2 class="l-text2 t-center">
			Cart
		</h2>
	</section>
	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
		 <div class="container-table-cart">
                            <div id="appned_tabel" class="wrap-table-shopping-cart bgwhite">
                                <table class="table-shopping-cart">
                                    <tr class="table-head">
                                        <th class="column-1">Product Image</th>
                                        <th class="column-2">Product</th>
                                        <th class="column-4 p-l-70">Quantity</th>
                                        <th class="column-3"><img alt="Gift Coins" src="images/GiftCoin.png" class="top-icons" />Price</th>
                                        <th class="column-5">Total</th>
                                    </tr> 
                                    <?php
									$items_list =$user_obj->cart_items($uid);
								    $count = mysqli_num_rows($items_list);
									if (!empty($count)) {
										$total = 0;
										while($values = mysqli_fetch_array($items_list, MYSQLI_BOTH)) {
											$price= $values["product_price"];
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
                                            ?>  
                                            <tr class="table-row">
                                                <td class="column-1">
                                                    <div class="cart-img-product b-rad-4 o-f-hidden">
                                                        <img src="admin/productimages/<?php echo $values["product_name"];?>/<?php echo $values["product_image"];?>" alt="IMG-PRODUCT">
                                                    </div>
                                                </td>
                                                <td class="column-2"><?php echo $values["product_name"]; ?></td>
												
                                                <td class="column-4">
                                                    <input type="button" name="quantityP[]" id="quantity<?php echo $values["product_id"]; ?>"  data-product_id="<?php echo $values["product_id"]; ?>" value="+" style="font-size:14pt;border:1px solid #f00;padding:10px;background-color:#45445" class="quantity" />
                                                    <input type="text" name="quantityVal[]" id="quantityVal<?php echo $values["product_id"]; ?>" value="<?php echo $values["product_quantity"]; ?>"  class="quantityVal"  style="margin:0 0px 0 9px;width:25px;"/>
                                                    <input type="button" name="quantityM[]" id="quantityM<?php echo $values["product_id"]; ?>"  data-product_id="<?php echo $values["product_id"]; ?>" value="-" style="font-size:14pt;border:1px solid #f00;padding:10px;background-color:#45445" class="quantityM" />
                                                </td>  
                                                <td class="column-3"><img alt="Gift Coins" src="images/GiftCoin.png" class="top-icons" /><?php echo number_format($productPrice); ?></td>  
                                                <td align="right"><?php $total_prc= $values["product_quantity"] * $productPrice; echo number_format($total_prc); ?> <button name="delete" class="btn btn-danger btn-xs delete" id="<?php echo $values["product_id"]; ?>"><i class="fa fa-remove"></i></button></td>  
                                                 
                                            </tr>  
										<?php
										$total = $total + ($values["product_quantity"] * $productPrice);
										$_SESSION['tp'] = $total;
									}
									?>  
                                        <tr>  
                                            <td colspan="3" align="right"><span class="m-text22 w-size19 w-full-sm">Total:</span></td>  
                                            <td align="right"><?php echo number_format($total); ?></td>  
                                            <td></td>  
                                        </tr>  
									<?php } else { ?>  
									<script type="text/javascript">
													setTimeout(function () {
													var basepath = window.location.protocol + '//' + window.location.hostname;
													var path = basepath + '/product.php';
													window.location.href= path; // the redirect goes here
													},500); // 5 seconds
								</script>
									<?php }?>
                                </table>
								</div>  
                        </div>
								<!-- Total -->
			<div class="w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
			
				<div class="size15 trans-0-4">
					<!-- Button -->
					<form method="post" action="" style="display:inline;">
					<button type="submit" name="ordersubmit"  class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Proceed to Checkout
					</button>
					</form>
				</div>
			</div>						
		</div>
	</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
<?php require_once('templates/chat_script.php');?>
 <script>
                            $(document).ready(function (data) {
                                $(document).on('click', '.delete', function () {
                                    var product_id = $(this).attr("id");
                                    var action = "remove";
                                    if (confirm("Are you sure you want to remove this product?"))
                                    {
                                        $.ajax({
                                            url: "action.php",
                                            method: "POST",
                                            dataType: "json",
                                            data: {product_id: product_id, action: action},
                                            success: function (data) {
												 $('.order_table').html(data.order_table2);
                                                $('#appned_tabel').html(data.order_table);
												if(data.cart_item=='0')
												{
													var basepath = window.location.protocol + '//' + window.location.hostname;
													var path = basepath + '/product.php';
													window.location.href= path; // the redirect goes here
												}
                                               $('.badge').text(data.cart_item);
                                            }
                                        });
                                    } else
                                    {
                                        return false;
                                    }
                                });
//                                $(document).on('keyup', '.quantity', function () {
                                $(document).on('click', '.quantity', function () {
                                    var product_id = $(this).data("product_id");
                                    //var quantity = $(this).val();
                                    var quantity = parseInt($("#quantityVal"+product_id).val())+1;
                                    var action = "quantity_change";
                                    if (quantity != '')
                                    {
                                        $.ajax({
                                            url: "action.php",
                                            method: "POST",
                                            dataType: "json",
                                            data: {product_id: product_id, quantity: quantity, action: action},
                                            success: function (data) {
                                                $('#appned_tabel').empty();
												$('#appned_tabel').html(data.order_table);
												$('.order_table').html(data.order_table1);
                                            }
                                        });
                                    }
                                });
                                $(document).on('click', '.quantityM', function () {
                                    var product_id = $(this).data("product_id");
                                    //var quantity = $(this).val();
                                    
                                    if((parseInt($("#quantityVal"+product_id).val())-1)==0)
                                    {
                                        var quantity = 0;
                                    }
                                    else
                                    {
                                        var quantity = parseInt($("#quantityVal"+product_id).val())-1;
                                    }
                                    
                                    var action = "quantity_change";
                                    if (quantity != '')
                                    {
                                        $.ajax({
                                            url: "action.php",
                                            method: "POST",
                                            dataType: "json",
                                            data: {product_id: product_id, quantity: quantity, action: action},
                                            success: function (data) {
												
                                                $('#appned_tabel').html(data.order_table);
												$('.order_table').html(data.order_table1);
                                            }
                                        });
                                    }
                                });
                            });
                        </script>
</body>
</html>