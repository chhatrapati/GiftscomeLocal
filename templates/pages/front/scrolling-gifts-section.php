<section class="blog bgwhite p-t-30 p-b-30" style="border-bottom:1px solid #eee; ">
   <div class="container">
	  <div class="sec-title p-b-52">
		 <h3 class="m-text5 t-center">Redeem from our gift store</h3>
	  </div>
	   <div class="row">
		 <?php
		    $userid = $_SESSION['id'];
			$user_type = $user_obj->user_type($userid);
			$discount_vip = $user_obj->vip_discount();
			$gift_coins_exchange_rate = $user_obj->gift_coins_exchange_rate();
			$query = "SELECT * FROM  products limit 4";
			$result = mysqli_query($con, $query) or die(mysqli_error($con));
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {

				$price = $row['productPrice'];
                $price = $price*$gift_coins_exchange_rate;$product_id=$row['id'];
				$productName=$row['productName'];
				$productImage1=$row['productImage1'];
				$postingDate=$row['postingDate'];
				$productCompany=$row['productCompany'];
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
		 <div class="col-sm-6 col-xs-6 col-md-3 Product text-center">
			<!-- Block3 -->
			<div class="block3">
			   <a href="product_detail.php?product_id=<?php echo toPublicId($row['id']);?>" class="block3-img dis-block ">
			   <img src="admin/productimages/<?php echo $productName;?>/<?php echo $productImage1;?>" class="img-fluid" alt="IMG-BLOG">
			   </a>
			   <div class="prc_<?php echo $productCompany;?>_home">
			   $ <?php echo $row['productPrice'];?>
				</div>
			   <div class="block3-txt p-t-14">
				  <h4 class="p-b-7">
					 <a href="product_detail.php?product_id=<?php echo toPublicId($row['id']);?>" class="m-text11">
					 <?php echo $productName;?>
					 </a>
				  </h4>
				  <span class="s-text6" class="s-text7 " style="font-size:14px;">
				  <?php if($user_type=='vip') {?>
					<span class="act_price">
					<img alt="Gift Coins" src="images/GiftCoin.png" /><b><?php  echo number_format($act_productPrice); ?></b>
					</span>
					<span class="dis_price">
					<img alt="Gift Coins" src="images/GiftCoin.png" /><b><?php  echo number_format($productPrice); ?></b>
					</span>
					<span class="discount" id="discount">(<?php echo $discount_vip;?>%)</span>
					<?php } else {?>
					<img alt="Gift Coins" src="images/GiftCoin.png" width="20" height="20" style="padding-right: 5px;" /><b><?php echo number_format($productPrice);?></b>
					<?php }?>
				  
				  </span>
			   </div>
			</div>
		 </div>
		 <?php } ?>
	  </div>
   </div>
</section>