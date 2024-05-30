<?php


include "connection.php";


$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='pizza' LIMIT 4");

$stmt->execute();

$dresses_products = $stmt->get_result();



?>