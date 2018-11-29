<?php 
session_start();
require_once('includes/config.php');
//require_once('includes/function.php');
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
				 							<div class="block2-btn-addcart w-size1 trans-0-4"></div>
                                            </div>
                                        </div>
                                        <div class="block2-txt p-t-20">
                                        	<a href="#" class="block2-name dis-block s-text3 p-b-5">
                                        		<?php echo $friendsa['name']; ?>
                                        	</a>
                                        </div>
                                        <a href="#" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 remove_friend" onclick="remove('<?php echo $friendsa['id']; ?>')" id="rid" name="rid" value="<?php echo $friendsa['id']; ?>">Remove Friend</a>
                                    </div>
                                    </div>		
	                                <?php 
	                            }
	                        } //while end
				} else { echo 'You do not have any friends '; }
                        ?>
<script>
	function remove(value)
	{
		$.ajax({
			url: "delete_friend.php",
			method: "POST",
			dataType: "text",
			data: "rid=" + value,
			success: function (data)
			{
				$('#productContainer').html(data);
				window.setTimeout(function(){location.reload(true)},2000);
			}
		});

	}	

</script>