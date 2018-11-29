<?php session_start();
error_reporting(0);
//print_r($_SESSION);
require_once('includes/config.php');
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
<script>
	function start(){
		scrollDiv_init();
		scrollDiv_init1();
	}
</script>
</script>
<!DOCTYPE html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once('templates/common_css.php');?>
	<link href="css/full-slider.css" rel="stylesheet">
	 <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.css'>
	<style>
	 .gift{
	    padding:0 0 11px !important;
		width:30px !important;
		
	 }
	 .gftext{
		 font-size:15px !important;
		 font-family: Montserrat-Regular;
	 }
	 .gftext1{
		 font-size:15px !important;
		 font-family: Montserrat-bold;
		 padding-left:23px;
	 }
	 .center{
         width: 105px;
		 position: relative;

        
		
  
}
.img{
	padding-left:10px;
  
}
.img:hover{
	background:#08a6cc;
	
}
.line{
	margin-top:1px;
	margin-bottam:1px;
}

    </style>	
</head>

<body class="animsition" onLoad="start()">
	<?php require_once('templates/header.php');?>
	
	
	
	
	
															
    
<div class="col-lg-12"> 
<h1 style="text-align:center;font-size:26px;padding-top:1%">Game will be closed within-:</h1>
 <div class="clock" style=" display: flex;
    justify-content: center;
    align-items: center; padding-top:15px;padding-bottom:1px"></div>
</div>
<div class="container">
                                     
  <div class="dropdown">
    <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Select Coin
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li class="img"><a href="#" >+10</li>
      <li class="img"><a href="#">+20</a></li>
      <li class="img"><a href="#">+30</a></li>
	   <li class="img"><a href="#">+50</a></li>
	    <li class="img"><a href="#">+100</a></li>
	   
    </ul>
  </div>
</div><br>
<section class="banner bgwhite ">
	<div class="container">
			
		<div class="col-sm-10 col-md-8 col-lg-12 m-l-r-auto">
		<div class="row">
		 <div class="col-lg-6">
			 	
					<div class="block1 hov-img-zoom pos-relative m-b-30" style="border-bottom:1px solid #08a6cc;">
						<h1 class="list-heading">
						<div class="row">
						<div class="col-lg-2 gftext1">NUMBER</div>
						 <div class="col-lg-2 gftext1">PAYOUT GIFTS</div>
						<div class="col-lg-3 gftext1">PAYOUT GIFTS COIN</div>
						<div class="col-lg-5 gftext1">PLACE COIN</div>
						</div></h1>
						<div>
					
							<ul style="border:2px solid #08a6cc;text-align:center;">
								<li><a href="#">
								    <div class="row" style="padding-top:20px">
								     <div class="col-lg-2"><img src="images/balls0.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								     <div class="col-lg-2"><img src="images/balls1.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								     <div class="col-lg-2"><img src="images/balls2.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								    <div class="col-lg-2"><img src="images/balls3.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								     <div class="col-lg-2"><img src="images/balls4.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								      <div class="col-lg-2"><img src="images/balls5.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								      <div class="col-lg-2"><img src="images/balls6.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								     <div class="col-lg-2"><img src="images/balls7.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								      <div class="col-lg-2"><img src="images/balls8.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								    <div class="col-lg-2"><img src="images/balls9.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								    <div class="col-lg-2"><img src="images/balls10.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								     <div class="col-lg-2"><img src="images/balls11.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								     <div class="col-lg-2"><img src="images/balls12.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								    <div class="col-lg-2"><img src="images/balls13.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li>
								
								
							</ul>
							</div>
							</div>
							</div>
							<div class="col-lg-6">
					
					<div class="block1 hov-img-zoom pos-relative m-b-30" style="border-bottom:1px solid #08a6cc;">
						<h1 class="list-heading">
						<div class="row">
						<div class="col-lg-2 gftext1">NUMBER</div>
						 <div class="col-lg-2 gftext1">PAYOUT GIFTS</div>
						<div class="col-lg-3 gftext1">PAYOUT GIFTS COIN</div>
						<div class="col-lg-5 gftext1">PLACE COIN</div>
						</div></h1>
						<div>
							<ul style="border:2px solid #08a6cc;text-align:center;">
								<li><a href="#">
								    <div class="row" style="padding-top:20px">
								    <div class="col-lg-2"><img src="images/balls14.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								    <div class="col-lg-2"><img src="images/balls15.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								     <div class="col-lg-2"><img src="images/balls16.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								     <div class="col-lg-2"><img src="images/balls17.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								    <div class="col-lg-2"><img src="images/balls18.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								    <div class="col-lg-2"><img src="images/balls19.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								    <div class="col-lg-2"><img src="images/balls20.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								    <div class="col-lg-2"><img src="images/balls21.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								   <div class="col-lg-2"><img src="images/balls22.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								    <div class="col-lg-2"><img src="images/balls23.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								     <div class="col-lg-2"><img src="images/balls24.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								     <div class="col-lg-2"><img src="images/balls25.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								     <div class="col-lg-2"><img src="images/balls26.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									    
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li><hr class="line">
								<li><a href="#">
								    <div class="row">
								    <div class="col-lg-2"><img src="images/balls27.png" style="width:35px"></div>
									 <div class="col-lg-2"></div>
									 <div class="col-lg-3"><img src="images/logo-2.png" class="gift"><span class="gftext">500</span></div>
									 <div class="col-lg-5">
									         
											
											
											 <div class="center">
											 <img src="images/logo-3.png" class="gift">
											 <div class="input-group" style= "position: absolute;top: 0;left: 100px;>
    
    
											 <span class="input-group-btn">
                                                 <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus">-</span>
                                                 </button>
                                             </span>
                                             <input type="text" name="quant[2]" class="form-control input-number" value="30" min="1" max="100">
                                             <span class="input-group-btn">
                                             <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                              <span class="glyphicon glyphicon-plus">+</span>
                                             </button>
                                              </span></div>
                                               </div></div>
									 
									 </div></a>
								</li>
								
								
							</ul>
							</div>
							</div>
							</div>
							
							</div>
							<li><a href="#">
								    <div class="row">
								     <div class="col-lg-5"></div>
									
									 <div class="col-lg-1" style="padding:10px" ><button type="button" class="btn btn-success">Submit</button></div>
									 <div class="col-lg-1" style="padding:10px"><button type="button" class="btn btn-danger">Cancel</button></div>
									 <div class="col-lg-5"></div>
									  
			
									 </div></a>
								</li>
						</div>
						
						
					</div>
				</div>
			</div>
		
				
		</section>


	<section class="banner bgwhite p-t-40 p-b-40">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
	<!-- Footer -->
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
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/lightbox2/js/lightbox.min.js"></script>
	<!--===============================================================================================-->
	  
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	</script>
	<script>
	   $('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	</script>
	<script language="javascript">
		ScrollRate = 25;
		ScrollRate1 = 25;

		function scrollDiv_init() {
			DivElmnt = document.getElementById('MyDivName');
	//DivElmnt1 = document.getElementById('MyDivName1');
	ReachedMaxScroll = false;
	//ReachedMaxScroll1 = false;
	
	DivElmnt.scrollTop = 0;
	//DivElmnt.scrollTop1 = 0;
	PreviousScrollTop = 0;
	//PreviousScrollTop1 = 0;
	
	ScrollInterval = setInterval('scrollDiv()', ScrollRate);
	//ScrollInterval1 = setInterval('scrollDiv()', ScrollRate1);
}
function scrollDiv_init1() {
	
	DivElmnt1 = document.getElementById('MyDivName1');
	
	ReachedMaxScroll1 = false;
	
	
	DivElmnt.scrollTop1 = 0;
	
	PreviousScrollTop1 = 0;
	
	
	ScrollInterval1 = setInterval('scrollDiv()', ScrollRate1);
}

function scrollDiv() {
	
	if (!ReachedMaxScroll) {
		DivElmnt.scrollTop = PreviousScrollTop;
		PreviousScrollTop++;

		ReachedMaxScroll = DivElmnt.scrollTop >= (DivElmnt.scrollHeight - DivElmnt.offsetHeight);
	}
	else {
		ReachedMaxScroll = (DivElmnt.scrollTop == 0)?false:true;

		DivElmnt.scrollTop = PreviousScrollTop;
		PreviousScrollTop--;
	}
	
}
function scrollDiv1() {
	
	if (!ReachedMaxScroll1) {
		DivElmnt1.scrollTop = PreviousScrollTop1;
		PreviousScrollTop1++;

		ReachedMaxScroll1 = DivElmnt1.scrollTop >= (DivElmnt1.scrollHeight - DivElmnt1.offsetHeight);
	}
	else {
		ReachedMaxScroll1 = (DivElmnt1.scrollTop == 0)?false:true;

		DivElmnt1.scrollTop = PreviousScrollTop1;
		PreviousScrollTop1--;
	}
}

function pauseDiv() {
	clearInterval(ScrollInterval);
}
function pauseDiv1() {
	clearInterval(ScrollInterval1);
}

function resumeDiv() {
	PreviousScrollTop = DivElmnt.scrollTop;
	ScrollInterval = setInterval('scrollDiv()', ScrollRate);
}
function resumeDiv1() {
	PreviousScrollTop1 = DivElmnt1.scrollTop;
	ScrollInterval1 = setInterval('scrollDiv1()', ScrollRate1);
}
</script>
<script type="text/javascript">
   var clock;
   
   $(document).ready(function() {
    // Set dates.
    var futureDate  = new Date("march 23, 2018 12:02 PM EDT");
    var currentDate = new Date();

    // Calculate the difference in seconds between the future and current date
    var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;

    // Calculate day difference and apply class to .clock for extra digit styling.
    function dayDiff(first, second) {
     return (second-first)/(1000*60*60*24);
    }

    if (dayDiff(currentDate, futureDate) < 100) {
     $('.clock').addClass('twoDayDigits');
    } else {
     $('.clock').addClass('threeDayDigits');
    }

    if(diff < 0) {
     diff = 0;
    }

    // Instantiate a coutdown FlipClock
    clock = $('.clock').FlipClock(diff, {
     clockFace: 'DailyCounter',
     countdown: true
    });
   });
  </script>

  <style>
     .toplist{
		 width:130px;
		 height:130px;
		 
	 }
	 .toplist:hover{
		 border:1px solid #0daacf;
		 opacity:0.5;
	 }
	 .topname{
		 text-align:center;
		 font-family:poppins-semibold;
		 padding-top:14px;
		  padding-bottam:24px;
		
	 }
	 .topname:hover{
		 font-size:30%;
		 
	 }
	
	 
    
input:checked {
    height: 20px;
    width: 20px;
	color:#08a6cc;
	
	
}
#count-checked-checkboxes {
    color:red;
}

.flip-clock-wrapper ul li a div div.inn {
       font-size: 24px;
}
.flip-clock-wrapper ul li a div {
    height: 56%;
}
.flip-clock-dot.top {
    top: 41px;
}
.flip-clock-dot.bottom {
    bottom: 38px;
}
.flip-clock-dot {
    width: 5px !important;
    height: 5px !important;
}
.flip-clock-wrapper ul{
	height:40px;
}

  </style>
 <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.js'></script>
<script  src="js/index.js"></script>

</body>
</html>