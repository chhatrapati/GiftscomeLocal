<?php
session_start();
require_once('includes/config.php');
require_once('includes/function.php');
if(isset($_POST['search']))
{
$search=$_POST['search'];
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
					
					<div class="row" id="productContainer">
				 <?php
                        if (isset($_SESSION['id'])) {
                            $member_id = $_SESSION['id'];
                        }

                        $userid = $_SESSION['id'];
                        $query = "SELECT * FROM  users where name='$search' and (id !=$member_id)";
						$result = mysqli_query($con, $query) or die(mysqli_error($con));
                        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {

                            $user_id = $row['id'];
                            $name = $row['name'];
                            $user_picture = $row['user_picture'];
							$_SESSION['user_picture']=$user_picture;
							$login_userpic=$_SESSION['login_userpic'];
							$loginusername=$_SESSION['name'];
						?>
							 <div class="col-sm-12 col-md-6 col-lg-3  p-b-50">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-img wrap-pic-w of-hidden pos-relativ">
									<?php if($row['social_id']!=''){?>
									<img src="<?php echo $row['user_picture'];?>"  width="100px" height="100px">
									<?php } else {
										if($row['user_picture'] == ""){ ?>
										<img src="users-images/user.png" width="100px" height="100px">
										<?php }else {?>
										<img src="users-images/<?php echo $row['user_picture'];?>" width="100px" height="100px">
									<?php }}?>
                                        <div class="trans-0-4">
                                            <div class="block2-btn-addcart w-size1 trans-0-4">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="block2-txt p-t-20">
                                        <a href="#" class="block2-name dis-block s-text3 p-b-5">
                                            <?php echo $name; ?>
                                        </a>
                                    </div>
									<?php
										$query1 = "SELECT * from friendrequest where sender_id ='$member_id' and receiver_id='$user_id'";
                      if ($result1=mysqli_query($con,$query1))
                         {
                              if(mysqli_num_rows($result1) > 0)
                                {
                            ?>
									
                                   <!--<a href="compose.php?reciver_id=<?php //echo $user_id; ?>&reciver_name=<?php //echo $name;?>&reciver_img=<?php //echo $_SESSION['user_picture'];?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Send Message</a>-->
				<p  class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 pexample" rid="<?php echo $user_id;?>" rpic="<?php echo $user_picture;?>" rname="<?php echo $name;?>" sid="<?php echo $member_id;?>" sname="<?php echo $loginusername;?>" spic="<?php echo $login_userpic;?>">Friend Request Sent</p>
								<?php
    }					
     else
	{
	?>
		<p  class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 pexample" rid="<?php echo $user_id;?>" rpic="<?php echo $user_picture;?>" rname="<?php echo $name;?>" sid="<?php echo $member_id;?>" sname="<?php echo $loginusername;?>" spic="<?php echo $login_userpic;?>">Add To friend</p>
             <?php				
				}}
  ?>
                 		
</div>
 </div>
<?php } ?>

					</div>

											</div>
