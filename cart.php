<?php 


session_start();


if(isset($_POST['add_to_cart'])){
    
    if(isset($_SESSION['cart'])){ /// if cart is not empty

        $product_array_ids = array_column($_SESSION['cart'], 'product_id');
        
        if(!in_array($_POST['product_id'], $product_array_ids)){ // if product is not in cart

            $product_id = $_POST['product_id'];

            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity']
            );

            $_SESSION['cart'][$product_id] = $product_array;

        }else{ // if product is in cart

            foreach($_SESSION['cart'] as $key => $value){

                if($value['product_id'] == $_POST['product_id']){

                    $_SESSION['cart'][$key]['product_quantity'] += $_POST['product_quantity'];

                }

            }

        }

    }else{ // if cart is empty

        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_quantity' => $product_quantity
        );

        $_SESSION['cart'][$product_id] = $product_array;
        $_SESSION['cart'][$product_id] = $product_array;

    }

    calculateTotalCart();

}else if(isset($_POST['remove_product'])){ // remove product from cart


    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);

    calculateTotalCart();
    
    
}else if(isset($_POST['edit_quantity'])){ // edit product quantity

    
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;

    calculateTotalCart();


}else{

    //header('Location: index.php');

}


function calculateTotalCart(){

    $total = 0;
    $total_quantity = 0;

    foreach($_SESSION['cart'] as $key => $value){

        $product = $_SESSION['cart'][$key];
        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total += ($price * $quantity);
        $total_quantity += $quantity;

    }

    $_SESSION['total'] = $total;
    $_SESSION['quantity'] = $total_quantity;

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