<?php //session_start();
require_once('includes/function.php');
require_once('includes/function.php');
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
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/redeem_banner.png);">
		<h2 class="l-text2 t-center">
			Products
		</h2>
		<p class="m-text13 t-center">
			New Arrivals Products
		</p>
	</section>
	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
			<?php require_once('templates/product_sidebar.php');?>
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
					   $limit = 10;  
                        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
                       $start_from = ($page-1) * $limit;  					
							$query = "SELECT * FROM  products where is_active=1 LIMIT $start_from, $limit";
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
                                    <div class="block2-img of-hidden pos-relative block2-labelnew">
                                        <img src="admin/productimages/<?php echo $productName;?>/<?php echo $productImage1;?>" alt="IMG-PRODUCT">

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
                                            <img alt="Game Coins" src="images/GameCoin.png" style="float:left;width:10%;padding-right: 5px;" /><b><?php echo $productPrice; ?></b>
                                        </span>
                                    </div>
                                    <input type="hidden" name="quantity" id="quantity<?php echo $row["id"]; ?>" class="form-control" value="1" />  
                                    <input type="hidden" name="hidden_name" id="name<?php echo $row["id"]; ?>" value="<?php echo $row["productName"]; ?>" />  
                                    <input type="hidden" name="hidden_price" id="price<?php echo $row["id"]; ?>" value="<?php echo $row["productPrice"]; ?>" /> 
									<input type="hidden" name="hidden_image" id="image<?php echo $row["id"]; ?>" value="<?php echo $row["productImage1"]; ?>" /> 
                                </div>
                            </div>
							<?php } ?>
					</div>
					<!-- Pagination -->
		<?php  
          $sql = "SELECT COUNT(id) FROM products";  
          $rs_result = mysqli_query($con,$sql);  
          $row = mysqli_fetch_row($rs_result); 	  
          $total_records = $row[0];  
          $total_pages = ceil($total_records / $limit);  
          $pagLink = "<div class='pagination flex-m flex-w p-t-26'>";  
       for ($i=1; $i<=$total_pages; $i++) {  
             $pagLink .= "<a  class='item-pagination flex-c-m trans-0-4 active-pagination' href='?page=".$i."'><p>".$i."</p></a>";  
			
         };  
      echo $pagLink . "</div>";  
                 ?>
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

	</script>
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
<script>
  
  cat();
  	function cat(){
		$.ajax({
			url	:	"product_catgory.php",
			method:	"POST",
			data	:	{category:1},
			success	:	function(data){
				$("#get_category").html(data);
				
			}
		})
	}
	</script>
	<script>
	
	
		$("body").delegate(".category","click",function(event){
		$("#productContainer").html("<h3>Loading...</h3>");
		event.preventDefault();
		var cid = $(this).attr('cid');
		//alert(cid);
		
			$.ajax({
			url		:	"get_seleted_category.php",
			method	:	"POST",
			data	:	{get_seleted_category:1,cat_id:cid},
			success	:	function(data){
				$("#productContainer").html(data);
			}
		})
	
	})
	</script>
</body>
</html>