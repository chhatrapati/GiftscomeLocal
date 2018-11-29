<?php
//session_start();
include('include/config.php');
if(isset($_POST['value']))
{
	$value=$_POST['value'];
$query="SELECT * FROM role where user_id = '" . $value . "' ";
$result=mysqli_query($con,$query);
//$row=mysqli_fetch_array($result);
//$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
//print_r ($row["menu_id"]);
$ids = array(); 
while ($row = mysqli_fetch_assoc($result))  
{
    $ids[] = $row["menu_id"]; 
} 
implode(", ", $ids);



	//echo $user_id=$row['user_id'];
	//echo $menuid=$row['menu_id'];
	?>
	 <h2 style="margin-left:114px;"> SELECT THE MENU YOU WANT TO ASSIGN USER</h2>
	 
	 	<div class="row">
				
								<div class="col-sm-4">
	 <?php
	 

						  $query2 = "SELECT DISTINCT sec_group FROM menu";
							$result1 = mysqli_query($con, $query2) or die(mysqli_error($con));
					
					        while ($row2 = mysqli_fetch_array($result1, MYSQLI_BOTH)) 
							{
								$sec=$row2['sec_group'];
							echo "<br>";
							
							echo "<h3>$sec</h3>";
							echo "<br>";
	                           $query1 = "SELECT * FROM menu where sec_group='$sec'";
							$result2= mysqli_query($con, $query1) or die(mysqli_error($con));
							//$a = 0;
							//$checkboxes = array();
				  while ($row1 = mysqli_fetch_array($result2, MYSQLI_BOTH)) {
								//echo $menuid;
								$sec_id=$row1['sec_id'];
								$sec_name=$row1['sec_name'];
								$sec_group=$row1['sec_group'];
								 $thisSub = [];
								 
								//echo "<br>";
								 //echo "<a href='$menu_url'>$menu_name</a>";
							
								?>
					
						 <input type="checkbox" id="check" name="menu_check[]" value="<?php echo $sec_id;?>" <?php echo (in_array($sec_id, $ids)) ? 'checked="checked"' : ''; ?>/>
								 <?php 
								 
								 echo $sec_name;
								
							
					
								 
	//echo 'hii';								
}}
}
?>
<br>
 </div>
	 </div>
	
