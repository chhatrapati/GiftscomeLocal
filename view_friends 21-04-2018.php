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
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/friend.png);">
		<h2 class="l-text2 t-center">
			Friends
		</h2>
		<p class="m-text13 t-center">
			New Arrivals Friends List
		</p>
	</section>
	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
			<?php require_once('templates/friends_sidebar.php');?>
				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					
					<div class="row" id="productContainer">
				 <?php
                        if (isset($_SESSION['id'])) {
                            $member_id = $_SESSION['id'];
                        }

                        $userid = $_SESSION['id'];
                        $query = "SELECT * FROM  users where id !=$member_id";
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
                                <div class="block2 text-center">
                                    <div class="block2-img wrap-pic-w of-hidden pos-relativ">

											<?php $pic = $row['user_picture'];								  									
											if($row['user_picture'] == ""){ ?>
											<img src="users-images/user.png" style="width:100px; height:100px;">
											<?php }elseif (strpos($pic, 'https') !== false) {?>
											<img src="<?php echo $row['user_picture'];?>"  style="width:100px; height:100px;">
											<?php } else {?>
											<img src="users-images/<?php echo $row['user_picture'];?>" style="width:100px; height:100px;">
											<?php }?>
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
				</div>
			</div>
		</div>
		<div id="display"></div>
	</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
$('.pexample').on('click', function() {
	
var rid=($(this).attr('rid'));
var rname=($(this).attr('rname'));
var rpic=($(this).attr('rpic'));
var sid=($(this).attr('sid'));
var sname=($(this).attr('sname'));
var spic=($(this).attr('spic'));

//alert(rid);
//alert(rname);
//alert(rpic);
//alert(sid);
//alert(sname);
//alert(spic);



          $.ajax({
            type: 'post',
            url: 'send-request.php',
         
			 data: {

                    rid: rid,
                    rname :rname,
					rpic :rpic,
					sid :sid,
					spic :spic,
					sname : sname
					
                               },
            success: function (result) {
             $("#display").html(result).show();
			  //$(".pexample").text("Hello world!");
			   //$(".pexample:first").replaceWith("Hello world!");
            }
          });

	
})
</script>


</body>
</html>