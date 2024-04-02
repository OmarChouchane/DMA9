<?php

include 'connection.php';

session_start();


//if user is not logged in
if(!isset($_SESSION['logged_in'])){

    header('location: ../checkout.php?message=fail');
    exit();


    //if user is logged in
}else{


    if(isset($_POST['place_order'])){


        // Step 1: Get user info and store it in the database
    
        $name = $_POST['name']; 
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city']; 
        $address = $_POST['address']; 
        $order_cost = $_SESSION['total']; 
        $order_status = 'on-hold'; 
        $user_id = $_SESSION['user_id']; 
        $order_date = date('Y-m-d H:i:s'); 
    
        //insert user info into the orders table
    
        $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
        
        $stmt_status = $stmt->execute();
    
        if(!$stmt_status){
            header('location: ../index.php');
            exit();
        }	
    
        $order_id = $stmt->insert_id; // Get the auto-generated order ID
    
    
    
        // Step 2: Get cart items and store them in the database
    
        $cart = $_SESSION['cart']; 
        foreach($cart as $key => $value){
            $product = $_SESSION['cart'][$key];
            $product_id = $product['product_id'];
            $product_name = $product['product_name']; 
            $product_image = $product['product_image']; 
            $product_price = $product['product_price'];
            $product_quantity = $product['product_quantity']; 
    
            //insert cart items into the order_items table
    
            $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image,product_price, product_quantity, user_id, order_date) VALUES (?,?,?,?,?,?,?,?)");
            $stmt1->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
            $stmt1->execute();
        }
    
    
    
        // Step 3: Empty the cart --> delay until payement is done
    
    
        // step 4 : inform user whether the order is placed or not 
        header('location: ../payement.php?order_status=order placed successfully');
    
    
    }



}




?>