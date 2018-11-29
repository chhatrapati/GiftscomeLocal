<?php
session_start();
require_once('includes/config.php');
require_once('includes/function.php');
if(isset($_POST['search']))
{
$term = mysqli_real_escape_string($con, $_REQUEST['search']);
$term=str_replace("+"," ",$term);
}
//$query = "SELECT * FROM products WHERE productName='$search' AND is_active=1";
//$result = mysqli_query($con, $query) or die(mysqli_error($db));

//while ($row = mysqli_fetch_array($result)) {
	//		$product_id=$row['id'];
		//	$productName=$row['productName'];
			//$productImage1=$row['productImage1'];
		    //$productPrice=$row['productPrice'];
		     //$productCompany=$row['productCompany'];
			//$product_status=$row['product_status'];
			
           ?>
		   
			<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
			
					<?php
					 $member_id = $_SESSION['id'];
					//echo "SELECT * FROM myfriends WHERE myid = '$member_id' OR myfriends = '$member_id'";
				$query = mysqli_query($con,"SELECT * FROM myfriends WHERE myid = '$member_id' OR myfriends = '$member_id'");	
                   $num_rows = mysqli_num_rows($query);	
			
						while ($row = mysqli_fetch_array($query)) {
						
							//echo $myfriend1 = $row['myfriends'];
							
							 $myfriend = $row['myid'];
						     $myfriend1 = $row['myfriends'];
								
						
			
              //$sql="SELECT * FROM users WHERE name LIKE '%".$search."%' and (id = '$myfriend1' or id='$myfriend') and id<>'$member_id' ORDER BY name ASC";				
			$friends = mysqli_query($con,"SELECT * FROM users WHERE name LIKE '%".$term."%' and (id = '$myfriend1' or id='$myfriend') and id<>'$member_id'")or die(mysqli_error($con));
									 while($friendsa=mysqli_fetch_array($friends))
										{
											?>
											<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-img wrap-pic-w of-hidden pos-relativ">
                                        <img src="users-images/<?php echo $friendsa['user_picture']; ?>" alt="IMG-PRODUCT">

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
                                            <?php echo $friendsa['name']; ?>
                                        </a>
                                    </div>
									</div>
									<form method="post" action="compose.php">
									
									<input type="hidden" name="reciver_id" value="<?php echo $friendsa['id']; ?>">
									<input type="hidden" name="reciver_name" value="<?php echo $friendsa['name']; ?>">
									<input type="hidden" name="reciver_img" value="<?php echo $_SESSION['user_picture']; ?>">
									<input type="submit" name="compose" value="Send Message" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
									</form>
								
									<a href="delete_friend.php?delete=<?php echo $friendsa['id']; ?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Remove Friend</a>
									<?php
											
										}
						}
								?>		
										
        				
                 		

					</div>
				</div>
<style>
.block2-img.wrap-pic-w.of-hidden.pos-relativ
{
	border: 1px solid skyblue;
    margin-top: 33px;
    padding: 2px;
}
.bo-rad-23 {
    border-radius: 23px;
    width: 100%;
    height: 18%;
    margin-top: 2%;
}
input#search {
    display: none;
}
</style>
