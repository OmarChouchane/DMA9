<?php


include 'header.php';


if(isset($_GET['order_id'])){

    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    if($stmt->execute()){
        header('location: index.php?delete_success=order deleted successfully');
    }else{  
        header('location: index.php?error=error deleting order');
    }

}


?>