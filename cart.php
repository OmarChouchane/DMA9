<?php
session_start();

class ShoppingCart {
    private $cart;

    public function __construct() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $this->cart = &$_SESSION['cart'];
    }

    public function addToCart($product_id, $product_name, $product_price, $product_image, $product_quantity) {
        if (!isset($this->cart[$product_id])) {
            $product_array = array(
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => $product_image,
                'product_quantity' => $product_quantity
            );
            $this->cart[$product_id] = $product_array;
        } else {
            $this->cart[$product_id]['product_quantity'] += $product_quantity;
        }
        $this->calculateTotalCart();
    }

    public function removeFromCart($product_id) {
        if (isset($this->cart[$product_id])) {
            unset($this->cart[$product_id]);
            $this->calculateTotalCart();
        }
    }

    public function editQuantity($product_id, $product_quantity) {
        if (isset($this->cart[$product_id])) {
            $this->cart[$product_id]['product_quantity'] = $product_quantity;
            $this->calculateTotalCart();
        }
    }

    private function calculateTotalCart() {
        $total = 0;
        $total_quantity = 0;

        foreach ($this->cart as $key => $product) {
            $price = $product['product_price'];
            $quantity = $product['product_quantity'];

            $total += ($price * $quantity);
            $total_quantity += $quantity;
        }

        $_SESSION['total'] = $total;
        $_SESSION['quantity'] = $total_quantity;
    }
}

$shoppingCart = new ShoppingCart();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['add_to_cart'])) {
        $shoppingCart->addToCart($_POST['product_id'], $_POST['product_name'], $_POST['product_price'], $_POST['product_image'], $_POST['product_quantity']);
        header("Location: cart.php");
        exit();
    } else if (isset($_POST['remove_product'])) {
        $shoppingCart->removeFromCart($_POST['product_id']);
        header("Location: cart.php");
        exit();
    } else if (isset($_POST['edit_quantity'])) {
        $shoppingCart->editQuantity($_POST['product_id'], $_POST['product_quantity']);
        header("Location: cart.php");
        exit();
    }
}

?>


<?php include('layouts/header.php'); ?>



    <style>
        hr{
            width: 50px;
            border: 2px solid #fbb710;
            margin: 17px 0;
        }
    </style>







    <!--Cart-->
    <section class="cart container my-5 py-5">
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


            <?php if(isset($_SESSION['cart'])){ 
                foreach($_SESSION['cart'] as $key => $value){ ?>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/<?php echo $value['product_image'];?>" alt="">
                        <div>
                            <p><?php echo $value['product_name'];?></p>
                            <small><span>$</span><?php echo $value['product_price'];?></small>
                            <br>
                            <form action="cart.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>">
                                <input type="submit" name="remove_product" class="remove-btn" value="Remove">
                            </form>
                        </div>
                    </div>
                </td>

                <td>
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>">
                        <input type="number" name="product_quantity" value="<?php echo $value['product_quantity'];?>">
                        <input type="submit" name="edit_quantity" class="edit-btn" value="Edit">
                    </form>
                </td>

                <td>
                    <span>$</span>
                    <span class="product-price"><?php echo $value['product_quantity']*$value['product_price'];?></span>
                </td>
            </tr>

            <?php }}?>


        </table>


        <div class="cart-total">
            <table>
                <tr>
                    <td>Total</td>
                    <td>$<?php if(isset($_SESSION['cart'])){  echo $_SESSION['total'];}else{ echo "0.00"; } ?></td>
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