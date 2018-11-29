	<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-list"></i>Forms</a>
  <ul>
    <li><a href="manage-users.php"><i class="icon icon-home"></i> <span>Manage Users</span></a> </li>
	<li><a href="general_settings.php"><i class="icon icon-cog"></i><span>General Settings</span></a></li>
   
    <li class="submenu active"> <a href="#"><i class="icon icon-list"></i> <span>Order Management</span> <span class="label label-important">3</span></a>
      <ul>
									<li>
										<a href="todays-orders.php">
											<i class="icon-tasks"></i>
											Today's Orders
  <?php
  $f1="00:00:00";
$from=date('Y-m-d')." ".$f1;
$t1="23:59:59";
$to=date('Y-m-d')." ".$t1;
 $result = mysqli_query($con,"SELECT * FROM Orders where orderDate Between '$from' and '$to'");
$num_rows1 = mysqli_num_rows($result);
{
?>
											<b class="label orange pull-right"><?php echo htmlentities($num_rows1); ?></b>
											<?php } ?>
										</a>
									</li>
									<li>
										<a href="pending-orders.php">
											<i class="icon-tasks"></i>
											Pending Orders
										<?php	
	$status='Delivered';									 
$ret = mysqli_query($con,"SELECT * FROM Orders where orderStatus!='$status' || orderStatus is null ");
$num = mysqli_num_rows($ret);
{?><b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
<?php } ?>
										</a>
									</li>
									<li>
										<a href="delivered-orders.php">
											<i class="icon-inbox"></i>
											Delivered Orders
								<?php	
	$status='Delivered';									 
$rt = mysqli_query($con,"SELECT * FROM Orders where orderStatus='$status'");
$num1 = mysqli_num_rows($rt);
{?><b class="label green pull-right"><?php echo htmlentities($num1); ?></b>
<?php } ?>

										</a>
									</li>
								</ul>
    </li>
								<li><a href="add_coins_value.php"><i class="icon icon-tasks"></i> Manage Coins Value </a></li>
								<li><a href="transfer_coins_value.php"><i class="icon icon-tasks"></i> Transfer Coins Value </a></li>
								<li><a href="category.php"><i class="icon icon-tasks"></i> Create Category </a></li>
                                <!--<li><a href="subcategory.php"><i class="menu-icon icon-tasks"></i>Sub Category </a></li>-->
                                <li><a href="insert-product.php"><i class="icon icon-paste"></i>Insert Product </a></li>
                                <li><a href="manage-products.php"><i class="icon icon-table"></i>Manage Products </a></li>
								<li><a href="add_package.php"><i class="icon icon-table"></i>Manage Packages </a></li>
							   <li><a href="user-logs.php"><i class="menu-icon icon-tasks"></i>User Login Log </a></li>

							
  </ul>
</div>
