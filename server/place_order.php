<?php

include 'connection.php';
session_start();

class OrderHandler {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function placeOrder() {
        // Check if user is not logged in
        if (!isset($_SESSION['logged_in'])) {
            header('location: ../checkout.php?message=fail');
            exit();
        } else {
            // Check if the place_order form is submitted
            if (isset($_POST['place_order'])) {
                // Get user info and store it in variables
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $city = $_POST['city'];
                $address = $_POST['address'];
                $order_cost = $_SESSION['total'];
                $order_status = 'on-hold';

                // Check if user_id is set in the session
                if (!isset($_SESSION['user_id'])) {
                    header('location: ../login.php?error=not_logged_in');
                    exit();
                }

                // Get the user_id from the session
                $user_id = $_SESSION['user_id'];
                $order_date = date('Y-m-d H:i:s');

                // Insert user info into the orders table
                $stmt = $this->conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param('issssss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
                $stmt_status = $stmt->execute();

                // Check if the query execution was successful
                if (!$stmt_status) {
                    header('location: ../index.php?error=order_failed');
                    exit();
                }

                // Get the auto-generated order ID
                $order_id = $stmt->insert_id;

                // Insert cart items into the order_items table
                $cart = $_SESSION['cart'];
                foreach ($cart as $product) {
                    $product_id = $product['product_id'];
                    $product_name = $product['product_name'];
                    $product_image = $product['product_image'];
                    $product_price = $product['product_price'];
                    $product_quantity = $product['product_quantity'];

                    $stmt1 = $this->conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt1->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
                    $stmt1->execute();
                }

                // Empty the cart --> delay until payment is done

                // Inform the user that the order is placed successfully
                header('location: ../payment.php?order_status=order_placed');
            }
        }
    }
}

$orderHandler = new OrderHandler($conn);
$orderHandler->placeOrder();

?>
