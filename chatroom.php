<?php
session_start();
require_once('includes/config.php');
 $member_id=$_SESSION['id'];
	 $chatroomid=$_REQUEST['id'];
	
	$chatq=mysqli_query($con,"select * from chatroom where chatroomid='$chatroomid'");
	$chatrow=mysqli_fetch_array($chatq);
	
	$cmem=mysqli_query($con,"select * from chat_member where chatroomid='$chatroomid'");
?>

<!DOCTYPE html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once('templates/common_css.php');?>
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	 <link href="css/bootstrap.min.css" rel="stylesheet">
	 <style>
	 .main_menu > li > a {
    font-family: Montserrat-Regular !important;
	 }
	 #productContainer
	 {
		  font-family: Montserrat-Regular !important;
	 }
	</style>
</head>
<body class="animsition">
<?php require_once('templates/header.php');?>
<?php
//error_reporting(1);
//print_r($_SESSION);
/*if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['product_id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
			echo "<script>window.location='product.php'</script>";
		}else{
			$message="Product ID is invalid";
		}
	}
}*/


?>

	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/friend.png);">
		<h2 class="l-text2 t-center">
		Chatroom
		</h2>
		<p class="m-text13 t-center">
			
		</p>
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
			<?php require_once('templates/friends_sidebar.php');?>

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
session_start();
require_once('includes/config.php');
?>

    <div class="panel panel-default" style="height:50px;">
				<span style="font-size:18px; margin-left:10px; position:relative; top:13px;"><strong><span  id="user_details"><span class="fa fa-users"></span><span class="badge"><?php echo mysqli_num_rows($cmem); ?></span></span> <?php echo $chatrow['chat_name']; ?></strong></span>
				<div class="showme" style="position: absolute; left:332px; top:-26px;">
					<div class="well">
						<strong>Room Member/s:</strong>
						<div style="height: 10px;"></div>
					<?php
						$rm=mysqli_query($con,"select * from chat_member left join `users` on users.id=chat_member.userid where chatroomid='$chatroomid'");
						while($rmrow=mysqli_fetch_array($rm)){
							?>
							<span>
							<?php
								$creq=mysqli_query($con,"select * from chatroom where chatroomid='$chatroomid'");
								$crerow=mysqli_fetch_array($creq);
								
								if ($crerow['userid']==$rmrow['userid']){
									?>
										<span class="fa fa-users">
									<?php
								}
								
							?>
						<?php echo $rmrow['name']; ?></span><br>
							<?php
						}
						
					?>
						
					</div>
				</div>
				<div class="pull-right" style="margin-right:10px; margin-top:7px;">
					<?php
						if ($chatrow['userid']==$member_id){
							?>
							<a href="chatlist.php" class="btn btn-danger">Back</a>
							<a href="member_add.php?id=<?php echo $chatroomid;?>" class="btn btn-primary">Add Member</a>
							<?php
						}
						else{
							?>
							<a href="chatlist.php" class="btn btn-primary"><span class="fa fa-arrow-left"></span> Back</a>
							<!--<a href="#leave_room" data-toggle="modal" class="btn btn-warning">Leave Room</a>-->
							<?php
						}
					?>
				</div>
			</div>
			<div>
				<div class="panel panel-default" style="height: 400px;">
					<div style="height:10px;"></div>
					<span style="margin-left:10px;">Welcome to Chatroom</span><br>
					<span style="font-size:10px; margin-left:10px;"><i>Note: Avoid using foul language and hate speech to avoid banning of account</i></span>
					<div style="height:10px;"></div>
					<div id="chat_area" style="margin-left:10px; max-height:320px; overflow-y:scroll;">
					</div>
				</div>
				
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Type message..." id="chat_msg">
					<span class="input-group-btn">
					<button class="btn btn-success" style="background:#17a2b8;" type="submit" id="send_msg" value="<?php echo $chatroomid; ?>">
					<span class="fa fa-check"></span> Send
					</button>
					</span>
				</div>
				
			</div>	
	</script>
            </div>
			
			
					</div>


											</div>
				</div>
			</div>
		</div>
			
	</section>
<?php require_once('templates/footer.php');?>
<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
	


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

		$('.btn-addcart-product-detail').each(function(){
			var nameProduct = $('.product-detail-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});
	</script>

<!--===============================================================================================-->
	<script src="js/main.js"></script>

<script>
$(document).ready(function(){
	
	
	displayChat();
	
		$(document).on('click', '#send_msg', function(){
			id = <?php echo $chatroomid; ?>;
			//alert(id);
			if($('#chat_msg').val() == ""){
				alert('Please write message first');
			}else{
				$msg = $('#chat_msg').val();
				$.ajax({
					type: "POST",
					url: "send_message.php",
					data: {
						msg: $msg,
						id: id,
					},
					success: function(){
						$('#chat_msg').val("");
						displayChat();
					}
				});
			}	
		});
		
		$(document).on('click', '#confirm_leave', function(){
			id = <?php echo $chatroomid; ?>;
			$('#leave_room').modal('hide');
			$('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
				$.ajax({
					type: "POST",
					url: "leaveroom.php",
					data: {
						id: id,
						leave: 1,
					},
					success: function(){
						window.location.href='chatlist.php';
					}
				});
				
		});
		
		$(document).on('click', '#confirm_delete', function(){
			id = <?php echo $chatroomid; ?>;
			$('#confirm_delete').modal('hide');
			$('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
				$.ajax({
					type: "POST",
					url: "deleteroom.php",
					data: {
						id: id,
						del: 1,
					},
					success: function(){
						window.location.href='chatlist.php';
					}
				});
				
		});
		
		$(document).keypress(function(e){
			if (e.which == 13){
			$("#send_msg").click();
			}
		});
		
		$("#user_details").hover(function(){
			$('.showme').removeClass('hidden');
		},function(){
			$('.showme').addClass('hidden');
		});
		
		//
	$(document).on('click', '.delete2', function(){
		var rid=$(this).val();
		$('#delete_room2').modal('show');
		$('.modal-footer #confirm_delete2').val(rid);
	});
	
	$(document).on('click', '#confirm_delete2', function(){
		var nrid=$(this).val();
		$('#delete_room2').modal('hide');
		$('body').removeClass('modal-open');
		$('.modal-backdrop').remove();
			$.ajax({
				url:"deleteroom.php",
				method:"POST",
				data:{
					id: nrid,
					del: 1,
				},
				success:function(){
					window.location.href='chatlist.php';
				}
			});
	});
	
	$(document).on('click', '.leave2', function(){
		var rid=$(this).val();
		$('#leave_room2').modal('show');
		$('.modal-footer #confirm_leave2').val(rid);
	});
	
	$(document).on('click', '#confirm_leave2', function(){
		var nrid=$(this).val();
		$('#leave_room2').modal('hide');
		$('body').removeClass('modal-open');
		$('.modal-backdrop').remove();
			$.ajax({
				url:"leaveroom.php",
				method:"POST",
				data:{
					id: nrid,
					leave: 1,
				},
				success:function(){
					window.location.href='chatlist.php';
				}
			});
	});
});
	
	function displayChat(){
		id = <?php echo $chatroomid; ?>;
		$.ajax({
			url: 'fetch_chat.php',
			type: 'POST',
			async: false,
			data:{
				id: id,
				fetch: 1,
			},
			success: function(response){
				$('#chat_area').html(response);
				$("#chat_area").scrollTop($("#chat_area")[0].scrollHeight);
			}
		});
	}
</script>

</body>
</html>