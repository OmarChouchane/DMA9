<?php

session_start();

include 'server/connection.php';

class OrderHandler {
    private $conn;
    private $orderDetails;
    private $totalOrderPrice;
    private $orderStatus;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function fetchOrderDetails($orderId) {
        $stmt = $this->conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
        $stmt->bind_param('i', $orderId);
        $stmt->execute();
        $this->orderDetails = $stmt->get_result();
        $stmt->close();
    }

    public function calculateTotalOrderPrice() {
        $total = 0;
        foreach ($this->orderDetails as $row) {
            $price = $row['product_price'];
            $quantity = $row['product_quantity'];
            $total += ($price * $quantity);
        }
        $this->totalOrderPrice = $total;
    }

    public function getOrderDetails() {
        return $this->orderDetails;
    }

    public function getTotalOrderPrice() {
        return $this->totalOrderPrice;
    }

    public function setOrderStatus($status) {
        $this->orderStatus = $status;
    }

    public function getOrderStatus() {
        return $this->orderStatus;
    }
}

if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];
    $orderStatus = $_POST['order_status'];

    $orderHandler = new OrderHandler($conn);
    $orderHandler->fetchOrderDetails($orderId);
    $orderHandler->calculateTotalOrderPrice();
    $orderHandler->setOrderStatus($orderStatus);

    $orderDetails = $orderHandler->getOrderDetails();
    $totalOrderPrice = $orderHandler->getTotalOrderPrice();
} else {
    header('location: account.php');
    exit();
}
?>

<?php include('layouts/header.php'); ?>

<!-- Orders Details -->
<section id="orders" class="orders order-detail container my-5 py-5">
    <div class="container text-center mt-5 order-detail">
        <h2 class="font-weight-bold">Order Details</h2>
        <hr class="mx-auto">
    </div>

    <table class="mt-5 pt-5 mx-auto">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>

        <?php foreach ($orderDetails as $row) { ?>
        <tr>
            <td>
                <div class="product-info">
                    <img src="/assets/imgs/<?php echo $row['product_image']; ?>" alt="">
                    <div>
                        <p class="mt-4"><?php echo $row['product_name']; ?></p>
                    </div>
                </div>
            </td>
            <td>$<span><?php echo $row['product_price']; ?></span></td>
            <td><span class="product-quantity"><?php echo $row['product_quantity']; ?></span></td>
        </tr>
        <?php } ?>
    </table>

    <?php if ($orderHandler->getOrderStatus() == "not paid") { ?>
    <form style="float: right;" action="payment.php" method="POST">
        <input type="hidden" name="total_order_price" value="<?php echo $totalOrderPrice; ?>">
        <input type="hidden" name="order_status" value="<?php echo $orderHandler->getOrderStatus(); ?>">
        <input class="btn order-details-btn" type="submit" name="order_pay_btn" value="Pay Now">
    </form>
    <?php } ?>
</section>

<?php include('layouts/footer.php'); ?>
