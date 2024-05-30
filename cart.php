<?php
session_start();

class CartManager {
    private $session;

    public function __construct() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        $this->session = &$_SESSION;
    }

    public function addToCart($product) {
        $productId = $product['product_id'];

        if (isset($this->session['cart'][$productId])) {
            $this->session['cart'][$productId]['product_quantity'] += $product['product_quantity'];
        } else {
            $this->session['cart'][$productId] = $product;
        }

        $this->calculateTotalCart();
        header("Location: cart.php");
        exit();
    }

    public function removeFromCart($productId) {
        if (isset($this->session['cart'][$productId])) {
            unset($this->session['cart'][$productId]);
            $this->calculateTotalCart();
        }
        header("Location: cart.php");
        exit();
    }

    public function editQuantity($productId, $quantity) {
        if (isset($this->session['cart'][$productId])) {
            $this->session['cart'][$productId]['product_quantity'] = $quantity;
            $this->calculateTotalCart();
        }
        header("Location: cart.php");
        exit();
    }

    private function calculateTotalCart() {
        $total = 0;
        $totalQuantity = 0;

        foreach ($this->session['cart'] as $product) {
            $total += ($product['product_price'] * $product['product_quantity']);
            $totalQuantity += $product['product_quantity'];
        }

        $this->session['total'] = $total;
        $this->session['quantity'] = $totalQuantity;
    }
}

$cartManager = new CartManager();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['add_to_cart'])) {
        $cartManager->addToCart($_POST);
    } else if (isset($_POST['remove_product'])) {
        $cartManager->removeFromCart($_POST['product_id']);
    } else if (isset($_POST['edit_quantity'])) {
        $cartManager->editQuantity($_POST['product_id'], $_POST['product_quantity']);
    }
}

?>

<?php include('layouts/header.php'); ?>

<style>
    hr {
        width: 50px;
        border: 2px solid #fbb710;
        margin: 17px 0;
    }
</style>

<!--Cart-->
<section class="cart container my-5 py-5">
    <!-- Cart content -->
    <div class="container mt-5">
        <h2 class="font-weight-bold">Your Cart</h2>
        <hr>
    </div>

    <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>

        <?php if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) { ?>

                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $value['product_image']; ?>" alt="">
                            <div>
                                <p><?php echo $value['product_name']; ?></p>
                                <small><span>$</span><?php echo $value['product_price']; ?></small>
                                <br>
                                <form action="cart.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                    <input type="submit" name="remove_product" class="remove-btn" value="Remove">
                                </form>
                            </div>
                        </div>
                    </td>

                    <td>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
                            <input type="submit" name="edit_quantity" class="edit-btn" value="Edit">
                        </form>
                    </td>

                    <td>
                        <span>$</span>
                        <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
                    </td>
                </tr>

        <?php }
        } ?>

    </table>

    <div class="cart-total">
        <table>
            <tr>
                <td>Total</td>
                <td>$<?php echo isset($_SESSION['total']) ? $_SESSION['total'] : "0.00"; ?></td>
            </tr>
        </table>
    </div>

    <div class="buttons">
        <div class="checkout-container">
            <form method="POST" action="checkout.php">
                <input type="submit" name="checkout" class="btn checkout-btn" value="Check Out">
            </form>
        </div>

        <div class="pdf-invoice-container">
            <form method="POST" action="invoice.php">
                <input type="submit" name="generate invoice" class="btn pdf-invoice-btn" value="Generate Invoice">
            </form>
        </div>
    </div>
</section>

<?php include('layouts/footer.php'); ?>
