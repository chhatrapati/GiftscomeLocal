<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'gifts_come';
//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
$product_order='';
if(isset($_POST['product_order']))
{
$product_order=$_POST['product_order'];
}
//echo $query = "SELECT * FROM products WHERE productName='$product_order'";

echo $query = "SELECT * FROM products ORDER BY productName $product_order";
$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_array($result)) {
			
			
           ?>
		   
		   <table>
		   <tr>
		   <th>name</th>
		   <th>mobile</th>
		   </tr>
		   
		      <tr>
		   <td><?php echo $row['productName'];?></td>
		   <td><?php echo $row['productPrice'];?></td>
		   </tr>
		   
		   </table>
		       <?php } ?>