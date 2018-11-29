<?php session_start();
require_once('includes/function.php');
require_once('includes/config.php');
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
	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/friend.png);">
		<h2 class="l-text2 t-center">
		Chat Room
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
                 <!-- Product -->
					<div class="row" id="productContainer">

<div class="col-lg-4">
	<div class="panel panel-default">
	<?php
	$member_id=$_SESSION['id'];
		$me=mysqli_query($con,"select * from chat_member left join chatroom on chatroom.chatroomid=chat_member.chatroomid where chat_member.userid='$member_id' order by chatroom.date_created desc");
		$numme=mysqli_num_rows($me);
	?>
		<div class="panel-heading"><center><strong>My Chatrooms <span class="badge"><?php echo $numme; ?></span></strong></center></div>
		<div class="panel-body">
		<table width="100%" class="table table-striped table-bordered table-hover" id="myChatRoom">
			<thead>
			<th>Chat Room Name</th>
			<th></th>
			</thead>
			<tbody>
			<?php
			   $member_id=$_SESSION['id'];
				$my=mysqli_query($con,"select * from chat_member left join chatroom on chatroom.chatroomid=chat_member.chatroomid where chat_member.userid='$member_id' order by chatroom.date_created desc");
					while($myrow=mysqli_fetch_array($my)){
						$nq=mysqli_query($con,"select * from chat_member where chatroomid='".$myrow['chatroomid']."'");
						?>
						<tr>
							<td><span class="fa fa-users"></span><span class="badge"><?php echo mysqli_num_rows($nq); ?></span> <a href="chatroom.php?id=<?php echo $myrow['chatroomid']; ?>"><?php echo $myrow['chat_name']; ?></a></td>
							<td>
								<?php
								    
									$memb=mysqli_query($con,"select * from chatroom where userid='$member_id' and chatroomid='".$myrow['chatroomid']."'");
									if (mysqli_num_rows($memb)>0){
										?>
										<button type="button" class="btn btn-danger btn-sm delete2" value="<?php echo $myrow['chatroomid']; ?>">Delete</button>
										<?php
									}
									else{
										?>
										<button type="button" class="btn btn-warning btn-sm leave2" value="<?php echo $myrow['chatroomid']; ?>">Leave</button>
										<?php
									}
								?>
							</td>
						</tr>
						<?php
					}
			?>
			</tbody>
		</table>
		</div>
	</div>
</div>

<div class="col-lg-8">
    <div class="panel panel-default" style="height:50px;">
		<span style="font-size:18px; margin-left:10px; position:relative; top:13px;"><strong><span class="fa fa-list"></span> List of Chat Rooms</strong></span>
		<div class="pull-right" style="margin-right:10px; margin-top:7px;">
			<a href="create_group.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add</a>
		</div>
	</div>
                    
</div>

            </div>
			
			<div id="leave"></div>
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


<!--===============================================================================================-->
	<script src="js/main.js"></script>

<script>
$(document).on('click', '.join_chat', function(){
		var cid=$(this).val();
		if ($('#status'+cid).val()==1){
			window.location.href='chatroom.php?id='+cid;
		}
		else if ($('#status'+cid).val()==2){
			$('#join_chat').modal('show');
			$('.modal-body #chatid').val(cid);
		}
		else{
			$.ajax({
				url:"addmember.php",
				method:"POST",
				data:{
					id: cid,
				},
				success:function(){
				window.location.href='chatroom.php?id='+cid;
				}
			});
		}
	});
	</script>
<script>

	$(document).on('click', '.delete2', function(){
		var nrid=$(this).val();
		//alert(nrid);
		
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
	
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".leave2").click(function(){
           var nrid=$(this).val();
            $.ajax({
                type: 'POST',
                url: 'leaveroom.php',
				data :{
					id: nrid,
					leave: 1,
				},
                success: function(ss) {
                 $("#leave").html(ss);
                }
            });
   });
});
</script

</body>
</html>