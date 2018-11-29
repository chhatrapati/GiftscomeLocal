<?php
session_start();
error_reporting(0);
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
<html>
<head>
<title>Your Website Title</title>
</head>
<body>
  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '482841608779740',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.12'
    });
  };
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.12&appId=240348863178921&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>  
<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>  
<script type="text/javascript">
function fb_share() {
  FB.ui( {
    method: 'feed',
    name: "Search Google",
    link: "https://www.google.com",
    picture: "https://www.google.co.uk/images/srpr/logo11w.png",
    caption: "The world's most popular search engine",
    actions: {"name":"Search", "link":"http://www.google.com"}
  },  function(response) {
  	
     if (response && !response.error_message) {
       alert('Post was published.');
     } else {
  alert('Post was not published.');
window.location.href = "/giftscome";}
   } );
}
function fb_share1() {
FB.ui(
  {
    method: 'share',
    href: 'https://developers.facebook.com/docs/',
  },
  // callback
  function(response) {
  	debugger;
    if (response && !response.error_message) {
      alert('Posting completed.');
      } else {
      alert('Error while posting.');
    }
  }
);
}

$(document).ready(function(){
  $('button.share-btnv').on( 'click', fb_share );
});

</script>
</body>
</html>


