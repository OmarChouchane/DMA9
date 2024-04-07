<?php


include 'header.php';


if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    if($stmt->execute()){
        header('location: products.php?delete_success=product deleted successfully');
    }else{  
        header('location: products.php?error=error deleting product');
    }

}
?>