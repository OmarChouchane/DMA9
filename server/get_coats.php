<?php


include "connection.php";


$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='sandwich' LIMIT 3");

$stmt->execute();

$coats_products = $stmt->get_result();



?>