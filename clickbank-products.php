<?php
session_start();
error_reporting(0);
require_once('includes/config.php');
$ch = curl_init();
// set URL and other appropriate options  
curl_setopt($ch, CURLOPT_URL,  "https://api.clickbank.com/rest/1.3/products/list?site=giftscome");  
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json", "Authorization: DEV-1C0RO2UR0VDIEGP4F87IG2QBANILPKAA:API-DEIQK6PUSUCOLLLKR1028EL8MBGT83CU"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  


$output = curl_exec($ch); 

//echo $output;
$array = json_decode($output,TRUE);
?>
<!DOCTYPE html>
<html>
<head>
	<title>GiftCoins Clickbank Products</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once('templates/common_css.php');?>	
<style>

	   .baner{
		   font-size:20px;
		   
		   font-family:Montserrat-regular;
	   }
       .p-t-40 {
    padding-top: 158px;
}
.note{
	color:red!important;
	font-size:12px;
}
.text_img {
    position: absolute;
    top: 50%;
    left: 35%;
    transform: translate(-50%, -50%);
    color: #fff;
}
#RCS:hover {
    text-decoration: none;
    color: #08a6cc !important;
}
</style>
</head>
<body class="animsition">
<?php require_once('templates/header.php');?>
<!-- Title Page -->
	<section class="p-t-40 p-b-50 flex-col-c-m Uearn" style="background-image: url(images/refer-earn1.png);">
		<h2 style="color:#fff;">
			GiftCoins Clickbank Products
		</h2>
	</section><br>
	<div class="container">
	<div class="row">
	     <?php foreach($array as $key=> $val) {
			 foreach($val as $key=> $values)
		{
			//print_r($values);
			foreach($values as $key=> $valnew)
		{
			$id = $valnew['id'];
			$title= $valnew['title'];
			$des = $valnew['description'];
			?>
			 <div class="col-sm-4 col-md-4 col-xs-12 block1 hov-img-zoom pos-relative m-b-30">
		
						<h3><?php echo $title;?></h3>
						<p><?php if($des!='') {echo substr($des,0,40);}?></p>
						<p><a href="http://5d1271pevji9-d4gi1shmonioe.hop.clickbank.net/" target="_top">Click Here!</a></p>
		 
	    </div>
		<?php
		}
		}
		}
		?>
		
	
	</div><br>
	</div>
	</div>
<?php require_once('templates/common_js.php');?>
<?php require_once('templates/footer.php');?>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/jquery.easy-ticker.js"></script> 
</body>
</html>