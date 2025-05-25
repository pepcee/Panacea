<?php 

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM categories LIMIT 5");

$stmt->execute();

$categories = $stmt->get_result();

?>