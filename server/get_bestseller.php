<?php 

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM bestsellers LIMIT 3");

$stmt->execute();

$bestseller_products = $stmt->get_result();

?>