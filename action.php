<?php  
include('includes/config.php');
session_start();
$user_obj = new Cl_User();
$user_id = $_SESSION['id'];
$user_type = $user_obj->user_type($user_id);
$discount_vip = $user_obj->vip_discount();
$gift_coins_exchange_rate = $user_obj->gift_coins_exchange_rate();
//echo '<pre>';print_r($_SESSION);
 //$connect = mysqli_connect("localhost", "root", "", "gifts_come");  
 if(isset($_POST["product_id"]))  
 {  
      $order_table = ''; 
      $order_table1 = ''; 	  
      $message = '';  
      if($_POST["action"] == "add")  
      {   
     $user_id= $_SESSION["id"];
	 $product_id= $_POST["product_id"];
	 $product_quantity = $_POST["product_quantity"];
	 /*get quantity of product if already added to cart*/
	$old_product_quantity = $user_obj->get_product_quantity($user_id,$product_id);
	if($old_product_quantity!='')
	{
		$product_quantity = $old_product_quantity + $_POST["product_quantity"];
		/*Update product into cart table if already added into cart*/
		$sql=$user_obj->update_pro_cart($user_id,$product_id,$product_quantity);
	}
	else
	{
	 /*insert product into cart table*/
	 $query=$user_obj->insert_pro_cart($user_id,$product_id,$product_quantity); 
	}         
			    
                     // $item_array = array(  
                          // 'product_id'               =>     $_POST["product_id"],  
                          // 'product_name'               =>     $_POST["product_name"],  
                          // 'product_price'               =>     $_POST["product_price"],  
                          // 'product_quantity'          =>     $_POST["product_quantity"] ,
						  // 'product_image'          =>     $_POST["product_image"],
						  // 'product_cat'          =>     $_POST["product_cat"],
						  // 'product_gift_coins'          =>     $_POST["product_gift_coins"],
						  // 'product_validity_of_vip_package'          =>     $_POST["product_validity_of_vip_package"]
						 
                     // );  
                    
           $cart_append ='';
		   /*Code to fetch cart items saved by user to purchase*/
		   $items_list =$user_obj->cart_items($user_id);
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
                    $cart_append.='<ul class="header-cart-wrapitem">
                        <li class="header-cart-item">
                            <div class="header-cart-item-img">
                                <img src="admin/productimages/'.$values["product_name"].'/'.$values["product_image"].'" alt="IMG">
                            </div>
                            <div class="header-cart-item-txt">
                                <a href="#" class="header-cart-item-name">
                                    '.$values["product_name"].'
                                </a>
                                <span class="header-cart-item-info">
                         			'.number_format($price). ' x ' .$values["product_quantity"].'
                                </span>
                               
                            </div>
                        </li>
                    </ul>';
                    $total = $total + ($values["product_quantity"] * $price);
                } 
                 $cart_append.='<div class="header-cart-total">
                    Total: '.number_format($total).'
                </div>
                <div class="header-cart-buttons">
                    <div class="header-cart-wrapbtn">
                        
                    </div>
                   <div class="header-cart-wrapbtn">
                      <!-- <form method="post" action="">
								   <button type="submit" name="ordersubmit"  class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
									Check Out
								</button>
                                       
								 </form>-->
					 <a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                            View Cart
                        </a>
                    </div>
                </div>';
            } 
			
            $output = array(  
				'cart_append'     =>     $cart_append,
				'cart_item'          => $count  
			);  
			echo json_encode($output); 
      }  
      if($_POST["action"] == "remove")  
      {  
      	$order_table = '';
		$order_table2 = '';
      	$order_table .= '  
      	<table class="table-shopping-cart">
			<tr class="table-head">
				<th class="column-1">Product Image</th>
				<th class="column-2">Product</th>
				<th class="column-4 p-l-70">Quantity</th>
				<th class="column-3"><img alt="Gift Coins" src="images/GiftCoin.png" class="top-icons" />Price</th>
				<th class="column-5">Total</th>
			</tr>';
			$items_list =$user_obj->cart_items($user_id);
			$count = mysqli_num_rows($items_list);
           while($values = mysqli_fetch_array($items_list, MYSQLI_BOTH)) { 
                if($values["product_id"] == $_POST["product_id"])  
                {  
                     $product_id =$values["product_id"];
					 $user_obj->remove_pro_cart($user_id,$product_id);
                     //$message = '<label class="text-success">Product Removed</label>';  
                    
			  			if(!empty($count))  
			  			{  
			       			$total = 0;
							$items_list =$user_obj->cart_items($user_id);
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
			            		$order_table .= '  
			                 	<tr class="table-row">
									<td class="column-1">
										<div class="cart-img-product b-rad-4 o-f-hidden">
											<img src="admin/productimages/'.$values["product_name"].'/'.$values["product_image"].'" alt="IMG-PRODUCT">
										</div>
									</td>  
			                   		<td class="column-2">'.$values["product_name"].'</td>  
			                  		<td class="column-4">
			                  			<input type="button" name="quantityP[]" id="quantity'.$values["product_id"].'" value="+" class="quantity" data-product_id="'.$values["product_id"].'" style="font-size:14pt;border:1px solid #f00;padding:10px;background-color:#45445"/> 
			                  			<input type="text" name="quantityVal[]" id="quantityVal'.$values["product_id"].'" value="'.$values["product_quantity"].'" class="quantityVal" data-product_id="'.$values["product_id"].'" style="margin:0 0px 0 9px;width:25px;"/>
			                  			<input type="button" name="quantityM[]" id="quantityM'.$values["product_id"].'" value="-" class="quantityM" data-product_id="'.$values["product_id"].'" style="font-size:14pt;border:1px solid #f00;padding:10px;background-color:#45445" />
			                  		</td>  
			                    	<td class="column-3"><img alt="Gift Coins" src="images/GiftCoin.png" class="top-icons" />'.$productPrice.'</td>  
			                      	<td align="right">'.number_format($values["product_quantity"] * $productPrice).' <button name="delete" class="btn btn-danger btn-xs delete" id="'.$values["product_id"].'"><i class="fa fa-remove"></i></button></td>  
			                      	  
			                 	</tr>';  
			            		$total = $total + ($values["product_quantity"] * $productPrice);
								$_SESSION['tp'] = $total;
								//$_SESSION['product_quantity'] = $values["product_quantity"];
								//$_SESSION['product_id'] = $values["product_id"];
			       			}
							$order_table .= '<tr>  
                                            <td colspan="3" align="right"><span class="m-text22 w-size19 w-full-sm">Total:</span></td>  
                                            <td align="right">'.number_format($total).'</td>  
                                            <td></td>  
                                        </tr>';
							$order_table .= '</table>';
			       			
			$total = 0;
			$items_list =$user_obj->cart_items($user_id);
		   $count = mysqli_num_rows($items_list);
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
			$order_table2.='<ul class="header-cart-wrapitem">
                        <li class="header-cart-item">
                            <div class="header-cart-item-img">
                                <img src="admin/productimages/'.$values["product_name"].'/'.$values["product_image"].'" alt="IMG">
                            </div>
                            <div class="header-cart-item-txt">
                                <a href="#" class="header-cart-item-name">
                                    '.$values["product_name"].'
                                </a>
                                <span class="header-cart-item-info">
                         			'.$productPrice. ' x ' .$values["product_quantity"].'
                                </span>
                               
                            </div>
                        </li>
                    </ul>';
					 
                    $total = $total + ($values["product_quantity"] * $productPrice);
                   }
                 $order_table2.='<div class="header-cart-total">
                    Total: '.$total.'
                </div>
                <div class="header-cart-buttons">
                    <div class="header-cart-wrapbtn">
                        <a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                            View Cart
                        </a>
                    </div>
                    <div class="header-cart-wrapbtn">
                        
                    </div>
					
                </div>';
			  			}
						
						
			  		
                }
           }  
            
			$output = array(  
				'order_table'     =>     $order_table,
				'order_table2'     =>     $order_table2,
				'cart_item'          =>     $count  
			);  
           echo json_encode($output); 
      }  
      	if($_POST["action"] == "quantity_change")  
      	{  
           $items_list =$user_obj->cart_items($user_id);
		   $count = mysqli_num_rows($items_list);
		   while($values = mysqli_fetch_array($items_list, MYSQLI_BOTH))  
           {  
                if($values['product_id'] == $_POST["product_id"])  
                {  
                    $values['product_quantity'] = $_POST["quantity"];
					$user_obj->update_pro_cart($user_id,$values['product_id'],$values['product_quantity']);
                }  
           }  
      	
	      	$order_table .= ' 
	      	<table class="table-shopping-cart">
				<tr class="table-head">
					<th class="column-1">Product Image</th>
					<th class="column-2">Product</th>
					<th class="column-4 p-l-70">Quantity</th>
					<th class="column-3"><img alt="Gift Coins" src="images/GiftCoin.png" class="top-icons" />Price</th>
					<th class="column-5">Total</th>
				</tr>';  
	  			if(!empty($count))  
	  			{  
	       			$total = 0;  
	       			$items_list =$user_obj->cart_items($user_id);
					$count = mysqli_num_rows($items_list);
					while($values = mysqli_fetch_array($items_list, MYSQLI_BOTH))   
	       			{
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
	            		$order_table .= '  
	                 	<tr class="table-row">
							<td class="column-1">
								<div class="cart-img-product b-rad-4 o-f-hidden">
									<img src="admin/productimages/'.$values["product_name"].'/'.$values["product_image"].'" alt="IMG-PRODUCT">
								</div>
							</td>  
	                   		<td class="column-2">'.$values["product_name"].'</td>  
	                  		<td class="column-4">
	                  			<input type="button" name="quantityP[]" id="quantity'.$values["product_id"].'" value="+" class="quantity" data-product_id="'.$values["product_id"].'" style="font-size:14pt;border:1px solid #f00;padding:10px;background-color:#45445"/> 
	                  			<input type="text" name="quantityVal[]" id="quantityVal'.$values["product_id"].'" value="'.$values["product_quantity"].'" class="quantityVal" data-product_id="'.$values["product_id"].'" style="margin:0 0px 0 9px;width:25px;" />
	                  			<input type="button" name="quantityM[]" id="quantityM'.$values["product_id"].'" value="-" class="quantityM" data-product_id="'.$values["product_id"].'" style="font-size:14pt;border:1px solid #f00;padding:10px;background-color:#45445" />
	                  		</td>  
	                    	<td class="column-3"><img alt="Gift Coins" src="images/GiftCoin.png" class="top-icons" />'.number_format($productPrice).'</td>  
	                      	<td align="right">'.number_format($values["product_quantity"] * $productPrice).' <button name="delete" class="btn btn-danger btn-xs delete" id="'.$values["product_id"].'"><i class="fa fa-remove"></i></button></td>  
	                      	  
	                 	</tr>';  
	            		$total = $total + ($values["product_quantity"] * $productPrice);
							$_SESSION['tp'] = $total;
							//$values['product_quantity'] = $values["product_quantity"];
							//$values['product_id'] = $values["product_id"];
	       			}  
	       			
	  			}  
	  		               $order_table .= '<tr>  
                                            <td colspan="3" align="right"><span class="m-text22 w-size19 w-full-sm">Total:</span></td>  
                                            <td align="right">'.number_format($total).'</td>  
                                            <td></td>  
                                        </tr>';
										$order_table .= '</table>';
			
			
			$total = 0; 
			$items_list =$user_obj->cart_items($user_id);
		   $count = mysqli_num_rows($items_list);
		   while($values = mysqli_fetch_array($items_list, MYSQLI_BOTH))  
	       		{
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
			$order_table1.='<ul class="header-cart-wrapitem">
                        <li class="header-cart-item">
                            <div class="header-cart-item-img">
                                <img src="admin/productimages/'.$values["product_name"].'/'.$values["product_image"].'" alt="IMG">
                            </div>
                            <div class="header-cart-item-txt">
                                <a href="#" class="header-cart-item-name">
                                    '.$values["product_name"].'
                                </a>
                                <span class="header-cart-item-info">
                         			'.$productPrice. ' x ' .$values["product_quantity"].'
                                </span>
                               
                            </div>
                        </li>
                    </ul>';
					 
                    $total = $total + ($values["product_quantity"] * $productPrice);
                   }
                 $order_table1.='<div class="header-cart-total">
                    Total: '.$total.'
                </div>
                <div class="header-cart-buttons">
                    <div class="header-cart-wrapbtn">
                        <a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                            View Cart
                        </a>
                    </div>
                    <div class="header-cart-wrapbtn">
                    </div>
                </div>';
					
			
			$output = array(  
				'order_table'     =>     $order_table,
				'order_table1'     =>     $order_table1,
				'cart_item'          =>    $count  
			);  
			echo json_encode($output);  
		}  
	}
 ?>