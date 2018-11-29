<?php
session_start();
include('include/config.php');
require_once('User.php');
$userinfo_obj = new User_Info();
if(strlen($_SESSION['user'])==0)
	{	
header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Gifts Come Admin</title>
<?php require_once('include/common_css.php');?>
<style>
.bg_lh {
    background: #21ADD0;
}
g.highcharts-button.highcharts-contextbutton.highcharts-button-normal {
    display: none;
}
text.highcharts-credits {
    display: none;
}
</style>
</head>
<body>
<?php require_once('include/header.php');?>
<!--sidebar-menu-->
<?php require_once('include/sidebar.php');?>
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb"> <a href="dashboard.php"> <i class="icon-dashboard"></i> <span class="label label-important"></span> My Dashboard </a> </li>
        <li class="bg_lg span3"> <a href="manage-users.php"> <i class="icon-user"></i> Users</a> </li>
        <li class="bg_ly"> <a href="pending-orders.php"> <i class="icon-tag"></i><span class="label label-success"></span> Orders </a> </li>
        <li class="bg_lo"> <a href="transfer_coins_value.php"> <i class="icon-gift"></i> Coins Management</a> </li>
        <li class="bg_ls"> <a href="manage-products.php"> <i class="icon-shopping-cart"></i> Shop</a> </li>
        <li class="bg_lo span3"> <a href="add_package.php"> <i class="icon-inbox"></i> Packages</a> </li>
        <li class="bg_ls"> <a href="game_setup.php"> <i class="icon-gift"></i> Game Management</a> </li>
        <li class="bg_lb"> <a href="user-logs.php"> <i class="icon-cogs"></i>User's Log</a> </li>
        <li class="bg_lg"> <a href="manage-slider.php"> <i class="icon-list"></i> Banners</a> </li>
        <li class="bg_lr"> <a href="announcement.php"> <i class="icon-bullhorn"></i> Announcements</a> </li>

      </ul>
    </div>
<!--End-Action boxes-->    

<!--Chart-box-->    
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>Site Analytics</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span9">
             <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
            </div>
            <div class="span3">
			<?php
			/*Fetch total no of users*/
			$total_users = $userinfo_obj->total_users();
			/*Fetch total no of products*/
			$total_products = $userinfo_obj->total_products();
			/*Fetch total no of orders*/
			$total_orders = $userinfo_obj->total_orders();
			/*Fetch total no of pending orders*/
			$total_pending_orders = $userinfo_obj->total_pending_orders();
			/*Fetch total no of Todays order*/
			$todays_orders = $userinfo_obj->total_todays_orders();
			/*Fetch total no of added new users*/
			$new_users = $userinfo_obj->total_new_user();
			?>
              <ul class="site-stats">
                <li class="bg_lh"><i class="icon-user"></i> <strong><?php echo $total_users;?></strong> <small>Total Users</small></li>
                <li class="bg_lh"><i class="icon-plus"></i> <strong><?php echo $new_users;?></strong> <small>New Users </small></li>
                <li class="bg_lh"><i class="icon-shopping-cart"></i> <strong><?php echo $total_products;?></strong> <small>Total Products</small></li>
                <li class="bg_lh"><i class="icon-tag"></i> <strong><?php echo $total_orders;?></strong> <small>Total Orders</small></li>
                <li class="bg_lh"><i class="icon-repeat"></i> <strong><?php echo $total_pending_orders;?></strong> <small>Pending Orders</small></li>
                <li class="bg_lh"><i class="icon-globe"></i> <strong><?php echo $todays_orders;?></strong> <small>Today's Orders</small></li>
              </ul>
            </div>
          </div>
		  
        </div>
      </div>
    </div>
<!--End-Chart-box--> 
    <hr/>
 
  </div>
</div>
<!--Footer-part-->
<?php require_once('include/footer.php');?>


<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.flot.min.js"></script> 
<script src="js/jquery.flot.pie.min.js"></script> 
<script src="js/matrix.charts.js"></script> 
<script src="js/jquery.flot.resize.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.dashboard.js"></script> 
<script src="js/matrix.charts.js"></script>
<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
var options = {
chart: {
renderTo: 'container',
plotBackgroundColor: null,
plotBorderWidth: null,
plotShadow: false
},
title: {
text: 'Total Bids On Game'
},
tooltip: {
formatter: function() {
return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
}
},
plotOptions: {
pie: {
allowPointSelect: true,
cursor: 'pointer',
dataLabels: {
enabled: true,
color: '#000000',
connectorColor: '#000000',
formatter: function() {
return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
}
}
}
},
series: [{
type: 'pie',
name: 'Browser share',
data: []
}]
}
 
$.getJSON("data.php", function(json) {
options.series[0].data = json;
chart = new Highcharts.Chart(options);
});
 
 
 
});
</script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
</body>
</html>