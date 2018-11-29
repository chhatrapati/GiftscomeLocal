<?php
include('includes/config.php');
if(isset($_POST["category"])){
	$category_query = "SELECT * FROM category where is_active =1";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["id"];
			$cat_name = $row["categoryName"];
			echo "
				<li class='p-t-4'><a href='#' style='text-decoration:none;' class='s-text13 category' cid='$cid'>$cat_name</a></li>
			";
		}
		echo "</div>";
	}
}
?>