<?php
include('config.php');
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = $con->query("SELECT * FROM products WHERE productName LIKE '%".$searchTerm."%' ORDER BY productName ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['productName'];
}
//return json data
echo json_encode($data);
?>