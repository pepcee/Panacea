<?php 

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category = 1 LIMIT 4");

$stmt->execute();

$pharma_products = $stmt->get_result();

?>