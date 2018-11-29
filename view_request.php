<?php session_start();
require_once('includes/config.php');
?>
					 <?php
                        if (isset($_SESSION['id'])) {
                       $member_id = $_SESSION['id'];
                        }
                        $sendReq = "SELECT * FROM friendrequest";
					    $res = mysqli_query($con, $sendReq) or die(mysqli_error($con));
						$rowRe = mysqli_fetch_array($res, MYSQLI_BOTH);
						
						$sender=$rowRe['sender_id']; 
						$query1 = mysqli_query($con,"SELECT * FROM friendrequest WHERE receiver_id='$member_id'");
					 
                                 if(mysqli_num_rows($query1) > 0) 
								 
								 {
								 
                                 while($row = mysqli_fetch_array($query1)) 
								 
								 { 
								 
                                 $query2 = mysqli_query($con,"SELECT * FROM users WHERE id = '" .  $row["sender_id"] . "'");
                                 while($row2 = mysqli_fetch_array($query2)) 
								 
								 {
                                  
						
					?>
						<div class="col-sm-12 col-md-6 col-lg-2 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relativ">
									<img src="users-images/<?php echo $row2['user_picture'];?>" alt="IMG-PRODUCT">
									<div class="trans-0-4">
										<div class="block2-btn-addcart w-size1 trans-0-4"></div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="#" class="block2-name dis-block s-text3 p-b-5">
										<?php echo $row2['name'];?>
									</a>
								</div>
							<p id ="<?php echo $row["sender_id"];?>" class="accept_request flex-c-m size1 bg4 bo-rad-23 hov1 s-text1" aid="<?php echo $row["sender_id"];?>">Accept</p>
								<p mid="<?php echo $row["sender_id"];?>" class="remove_request flex-c-m size1 bg4 bo-rad-23 hov1 s-text1" rid="<?php echo $row["sender_id"];?>">Ignore</p>
							</div>
			
								</div>
								<div id="display"></div>
								<?php
								 } }}else{
									echo " you don't have request";
								 }
							  ?>
<script>
$('.accept_request').on('click', function() {

var myId = $(this).attr('id');	
var aid=($(this).attr('aid'));
//alert(myId);
//alert(aid);
 $.ajax({
            type: 'post',
            url: 'accept_request.php',
			 data: {
                    aid: aid
                   },
            success: function (result) {
				$('#' + aid).html(result);
				window.location.href='view_friends.php';
			
            }
          });

})
</script>
<script>
$('.remove_request').on('click', function() {
var Rid = $(this).attr('mid');	
var rid=($(this).attr('rid'));
//alert(myId);
//alert(myId);
 $.ajax({
            type: 'post',
            url: 'delete_request.php',
			 data: {
                     rid: rid
					},
            success: function (result) {
             $("#display").html(result).show();
			 window.location.href='view_friends.php';
            }
          });
})
</script>
<style>
.main_menu > li > a {
    font-family: Montserrat-Regular !important;
	 }
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
input#skills {
    display: none;
}
</style>