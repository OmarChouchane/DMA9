<?php

session_start();

class PaymentHandler {
    private $orderStatus;
    private $totalOrderPrice;

    public function __construct($orderStatus, $totalOrderPrice) {
        $this->orderStatus = $orderStatus;
        $this->totalOrderPrice = $totalOrderPrice;
    }

    public function displayPayment() {/*
        if (isset($_SESSION['total']) && $_SESSION['total'] != 0) {
            $total = $_SESSION['total'];
            return "<p>Total payment : $$total</p><input class='button' type='submit' value='Pay Now'>";
        } elseif ($this->orderStatus == "not paid") {*/
            /*return "<p>Total payment : {$this->totalOrderPrice}</p><input class='button' type='submit' value='Pay Now'>";*/
            return "<input class='button' type='submit' value='Pay Now'>";
            /*
        } else {
            return "<p>You don't have an order to pay</p>";
        }*/
    }
}

if (isset($_POST['order_pay_btn'])) {
    $orderStatus = $_POST['order_status'];
    $totalOrderPrice = $_POST['total_order_price'];
    $paymentHandler = new PaymentHandler($orderStatus, $totalOrderPrice);
} else {
    $paymentHandler = new PaymentHandler('', 0);
}

?>

<?php include('layouts/header.php'); ?>

<!-- Payment -->
<section class="my-5 py-5">
    <?php if (isset($_GET['message'])) {
        echo "<div class='alert alert-success text-center'>Order placed successfully</div>";} ?>

    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Payment</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container text-center">
        <?php echo $paymentHandler->displayPayment(); ?>
    </div>
</section>



<?php include('layouts/footer.php'); ?>
