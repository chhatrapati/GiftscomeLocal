<?php 
session_start();
require_once('includes/config.php');
require_once('includes/function.php');
?>
	<style>
	 #productContainer
	 {
		  font-family: Montserrat-Regular !important;
	 }
	 .wrap-pic-w  {
    border: 1px solid skyblue;
    margin-top: 33px;
    padding: 2px;
}
.bo-rad-23 {
    border-radius: 23px;
    width: 100%;
    height: 18%;
    margin-top:2%;
}
.p-b-5 {
    text-align: center;
}
input#search
{
	display:none;
}
input[type=text] {
    border: 2px solid red;
    border-radius: 4px;
	border: 1px solid #17a2b8!important;
}
	</style>

	<div class="col-md-12">
	 <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Search friends..." />
        <div class="result"></div>
    </div>
	</div>

														<?php
														$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
$row = mysqli_fetch_array($query); //echo '<pre>'; print_r($row);

              $_SESSION['login_userpic']=$row['user_picture'];
?>


				 <?php //echo '<pre>';print_r($_SESSION);
                        if (isset($_SESSION['id'])) {
                            $member_id = $_SESSION['id'];
                        }
    
					  $post = mysqli_query($con,"SELECT * FROM myfriends WHERE myid = '$member_id'")or die(mysqli_error($con));
								
							     $num_rows  =mysqli_num_rows($post);
							
							     if ($num_rows != 0 ){

							  	while($row = mysqli_fetch_array($post)){
				
								$myfriend = $row['myid'];
								//$member_id=$_SESSION["logged"];
								
								
								
									if($myfriend == $member_id){
									
									$myfriend1 = $row['myfriends'];
										
										$friends = mysqli_query($con,"SELECT * FROM users WHERE id = '$myfriend1'")or die(mysqli_error($con));
										$friendsa = mysqli_fetch_array($friends);
										?>
							 <div class="col-sm-6 col-md-3 col-lg-2 p-b-50">
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
									<form method="post" action="compose.php">
									 
									<input type="hidden" name="reciver_id" value="<?php echo $friendsa['id']; ?>">
									<input type="hidden" name="reciver_name" value="<?php echo $friendsa['name']; ?>">
									<input type="hidden" name="reciver_img" value="<?php echo $friendsa['user_picture']; ?>">
									<input type="hidden" name="sender_img" value="<?php echo $_SESSION['login_userpic'];?>">
									
									<input type="submit" name="compose" value="Send Message" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">

									
									
									
									</form>
									
				<!--<p  class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 pexample" rid="<?php //echo $user_id;?>" rpic="<?php //echo $user_picture;?>" rname="<?php //echo $name;?>" sid="<?php //echo $member_id;?>" sname="<?php// echo $loginusername;?>" spic="<?php //echo $login_userpic;?>">Message</p>-->
				
				
				<!--<a href="compose.php?reciver_id=<?php //echo $friendsa['id']; ?>&reciver_name=<?php //echo $friendsa['name'];?>&reciver_img=<?php //echo $_SESSION['user_picture'];?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Send Message</a>-->
			
				<a href="delete_friend.php?delete=<?php echo $friendsa['id']; ?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Remove Friend</a>
				</div>
							</div>		<?php } 
									else{
										
										$friends = mysqli_query($con,"SELECT * FROM users WHERE id = '$myfriend'")or die(mysqli_error($con));
										$friendsa = mysqli_fetch_array($friends);
										?>
								<div class="col-sm-6 col-md-3 col-lg-2 p-b-50">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-img wrap-pic-w of-hidden pos-relativ">
                                        <img src="users-images/<?php echo $friendsa['user_picture']; ?>" alt="IMG-PRODUCT">

                                        <div class="trans-0-4" >


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
									<form method="post" action="compose.php">
									
									<input type="hidden" name="reciver_id" value="<?php echo $friendsa['id']; ?>">
									<input type="hidden" name="reciver_name" value="<?php echo $friendsa['name']; ?>">
									<input type="hidden" name="reciver_img" value="<?php echo $friendsa['user_picture'];?>">
									<input type="hidden" name="sender_img" value="<?php echo $_SESSION['login_userpic'];?>">
									
									<input type="submit" name="compose" value="Send Message" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
									
									
									</form>
				<p mid="<?php echo $friendsa['id']; ?>" class="remove_friend flex-c-m size1 bg4 bo-rad-23 hov1 s-text1" rid="<?php echo $friendsa['id']; ?>">Remove friend</p>
									</div>
 </div>	
				<?php 	}
								 }}
								else{
									
								
						echo 'You do not have friends ';
										}
										
								
								 
									?>
                 	
		<div id="display"></div>
		
		
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
		//alert("hiii");
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("myfriend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(data){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
		  var myfriends = $('.search-box').append(data).find('.myfriends').html();
	      //alert(myfriends);
		  myfriends=myfriends.replace(" ","+");
        $(this).parent(".result").empty();
		
		 $.ajax({
			 
               type: "POST",

               url: "myfriend_autocomplete_result.php",

               data: {
                
              search: myfriends

               },
                success: function(html) {

                

                   $("#productContainer").html(html).show();

               }

           });
		
    });
});
</script>
<script>
$('.remove_friend').on('click', function() {	
var rid=($(this).attr('rid'));
//alert(myId);
//alert(myId);
 $.ajax({
            type: 'post',
            url: 'delete_friend.php',
         
			 data: {

                    rid: rid
					},
            success: function (result) {
				//$('#' + Rid).html(result);
				
             $("#display").html(result).show();
			 window.location.href='view_friends.php';
			  //$(".pexample").text("Hello world!");
			   //$(".pexample:first").replaceWith("Hello world!");
            }
          });

	
})
</script>
