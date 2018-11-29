<?php
session_start();
require_once('includes/config.php');
$user_obj = new Cl_User();
require_once('includes/function.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
			header('location:index.php');
		}else{
			$message="Product ID is invalid";
		}
	}
}
?>
<script type="text/javascript">
	if (window.location.hash == '#_=_'){
		history.replaceState 
		? history.replaceState(null, null, window.location.href.split('#')[0])
		: window.location.hash = '';
	}
</script>
<!DOCTYPE html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Lucky 28, Numbers Game, Play Game, Earn Coins, Earn Gifts">
	<meta name="keywords" content="Lucky 28, Numbers Game, Play Game, Earn Coins, Earn Gifts">
	<meta property="og:image" content="http://giftscome.com.cp-28.hostgatorwebservers.com/images/fb-bg.png"/>
	<meta property="og:title" content="Play Game & Get Coins"/>
	<meta property="fb:app_id" content="208527059935526"/>
	<?php require_once('templates/common_css.php');?>
	<link href="css/full-slider.css" rel="stylesheet">
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
	<link href="css/front-page.css" rel="stylesheet">
</head>
<body class="animsition">
	<?php require_once('templates/header.php');?>
			<!-- Slider Section -->
			<?php require_once('templates/pages/front/slider.php');?>
			<!-- End of Slider Section -->
			
			<!-- User level -->
			
			<?php require_once('templates/pages/front/user-level.php');?>
			
			<!-- *End Section For Player Level -->		

			<!-- Section For Three Banner-->
	        <?php require_once('templates/pages/front/section-three-banner.php');?>
			
			<!-- End Section For Three Banner-->

	        <!-- Section For List Scrollingr -->
			
			<?php require_once('templates/pages/front/list-scrolling-section.php');?>
			
	       <!--  End Section For List Scrollingr -->	
	
	       <!--  Section For Products -->
		   
		  <?php require_once('templates/pages/front/scrolling-gifts-section.php');?>

		  <!--  End Section For Products -->

	     <!--  Section For Players -->
	           
		 <?php require_once('templates/pages/front/players-section.php');?>
			   
	     <!-- End Section For Players -->
		 
<?php require_once('templates/footer.php');?>
	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>
	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>
	<?php require_once('templates/common_js.php');?>
	<?php require_once('templates/chat_script.php');?>
	<script src="js/jquery.sharebox.js"></script>
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>	
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
   $('.block2-btn-addcart').each(function(){
		var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
		$(this).on('click', function(){
			swal(nameProduct, "is added to cart !", "success");
		});
	});
</script>
<!-- For Daynamic Level -->
<?php $user_level = $user_obj-> get_level_point($uid); 
$all_level_points = $user_obj-> get_all_level_points($uid);
$user_points= $all_level_points['@temp_total := u.user_points'];
$user_levels_complete1= $all_level_points['user_levels_complete1'];
$user_levels_complete2= $all_level_points['user_levels_complete2'];
$user_levels_complete3= $all_level_points['user_levels_complete3'];
$user_levels_complete4= $all_level_points['user_levels_complete4'];
$user_levels_complete5= $all_level_points['user_levels_complete5'];
 $lev =$user_level['user_level'];
//print_r($all_level_points);?>
 
<script type="text/javascript">
	var str = "";
	var str1 ='<?php echo $lev ;?>';
	$('.step').each(function(){
	str = $(this).text();    
	if (str === str1){
	$('.step').removeClass('current');
	$(".step:contains('" + str + "')").addClass("current");
	$('div[id|="uncurrent"]').remove(); }  
})
</script> 
<script>
//var users_points = document.getElementById("users_points").value;
var madal_img=$("#image_lev").attr("src");
$( "<div><img src='"+madal_img+"'width='30' height='30'></div>" ).appendTo( ".current" );
</script>
<style>
</style>
<!-- for vertical scrolling -->
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/jquery.easy-ticker.js"></script> 
<script>
   $(function(){	
	$('.demo5').easyTicker({
		direction: 'up',
		visible: 3,
		interval: 1000,
		controls: {
			up: '.btnUp',
			down: '.btnDown',
			toggle: '.btnToggle'}
	});
   });
</script>
<script>
$("#req_daily_login_coins").click(function(){
				var id_user = '<?php echo $uid?>';
				var dataString = 'id_user='+ id_user;
					$.ajax({
						url : 'coins_supplement_bydaily-login.php', 
						type : 'post',
						data: dataString,
						success : function(data){
							$("#msg_1").html(data);
							$("#msg_1").show();
						 //window.setTimeout(function(){location.reload()},3000);
					}
				});		
			});
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("ref_link");

  /* Select the text field */
  copyText.select();

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  //alert("Copied the text: " + copyText.value);
}
</script>
</body>
</html>