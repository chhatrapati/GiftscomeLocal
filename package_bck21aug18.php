<?php session_start(); error_reporting(0); ?>
<!DOCTYPE html>
<head>
<title>Packages</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php require_once('templates/common_css.php');?>
<link rel="stylesheet" type="text/css" href="css/package.css">
</head>
<body class="animsition">
<?php require_once('templates/header.php');
if($_POST)
{
if (!isset($_SESSION['login']))
{ 
  $_SESSION['url'] = $_SERVER['REQUEST_URI'];
//echo 'not';  //echo '<pre>'; print_r($_SESSION); die();
//header('location:login.php');
?> 
<script type="text/javascript">
setTimeout(function () {
var basepath = window.location.protocol + '//' + window.location.hostname;
var path = basepath + '/gclive/login.php';
window.location.href= path; // the redirect goes here
},1000); // 5 seconds
</script>
<?php }}?>
<?php
//include('includes/function.php');
$_SESSION['uid'] = $_SESSION['id'];
$_SESSION['username'] = $_SESSION['username'];
$_SESSION['coins_value'] = $_SESSION['coins_value'];

$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; 
$paypal_id='amitesh.sharma-facilitator@gmail.com';  // put your seller ID.
?>
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/gamesbanner1.png);">
<h2 class="l-text2 t-center">
Packages
</h2>
</section>
<section class="bgwhite p-t-66 p-b-38">
<div class="container">
<!-- Portfolio -->
<div class="row">
<?php 
$query = "SELECT * FROM  package where is_active = 1";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
//print_r($result);
while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
$package_id=$row['package_id'];
$package_name=$row['package_name'];
$package_image=$row['package_image'];
$package_price=$row['package_price'];
$package_validity=$row['package_validity'];
$coins_value=$row['coins_value'];
$gift_coins=$row['gift_coins'];
$package_description=$row['package_description'];
?>
<div class="col-lg-3 col-md-3  mb5">
<div class="border box-shadow1">
<div class="price-header text-center">
<h4 class="text-white text-uppercase font-weight-bold"><?php echo $package_name;?></h4>
<h6 class="text-white">$ <?php echo $package_price;?> / <?php echo $package_validity;?> days </h6>
</div>
<ul class="price">
<li><?php echo $package_description;?></li>
<li>Game Coins: <?php echo $coins_value;?></li>
<li>Gift Coins: <?php echo $gift_coins;?></li>
<form action='<?php if (!isset($_SESSION['login'])) { '';} else {?><?php echo $paypal_url; ?><?php }?>' method='post' name='frmPayPal1'>
<input type='hidden' name='business' value='<?php echo $paypal_id;?>'>
<input type='hidden' name='cmd' value='_xclick'>
<input type='hidden' name='item_name' value='<?php echo $row['package_name'];?>'>
<input type='hidden' name='coins_value' value='<?php echo $row['coins_value'];?>'>
<input type='hidden' name='item_number' value='<?php echo $row['package_id'];?>'>
<input type='hidden' name='amount' value='<?php echo $row['package_price'];?>'>
<input type='hidden' name='no_shipping' value='1'>
<input type='hidden' name='currency_code' value='USD'>
<input type='hidden' name='handling' value='0'>
<input type='hidden' name='cancel_return' value='http://giftscome.com.cp-28.hostgatorwebservers.com/cancel.php'>
<input type='hidden' name='return' value='http://giftscome.com.cp-28.hostgatorwebservers.com/success.php'>
<?php
$user_id=$_SESSION['uid'];
$a="SELECT * FROM package_sales where user_id=$user_id";
$s=mysqli_query($con,$a);
$row=mysqli_fetch_array($s);
$package_sales_id=$row['package_sales_id'];
$package_validity=$row['package_validity'];
$saledate=$row['saledate'];

$q="SELECT * FROM package_sales WHERE CURDATE() < DATE_ADD(saledate, INTERVAL ".$package_validity." DAY)  AND package_id=".$package_id." and user_id =".$user_id."";
$sql= mysqli_query($con,$q);
$num=mysqli_num_rows($sql);
//var_dump($num);
if($num==0)
{
echo '<li class=""><input type="submit" class="buy-pck btn btn-bg py-3 px-4"  value="Buy Now"></li>';
}
else
{
echo '<li class=""><input type="button" class="btn btn-bg py-3 px-4" class="popup-with-zoom-anim"  value="Already Subscribed" disable style="background-color:#ccc;"></li>';
}
?>
</form> 
</ul>
</div>
</div>
<?php }?>

</div>
</section>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
<?php require_once('templates/chat_script.php');?>
<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
<span class="symbol-btn-back-to-top">
<i class="fa fa-angle-double-up" aria-hidden="true"></i>
</span>
</div>
<!-- Container Selection -->
<div id="dropDownSelect1"></div>
<div id="dropDownSelect2"></div>
</body>
</html>