<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/fontawesome.min.css">
    

    <link rel="stylesheet" href="assets/css/style.css">
    <title>DMA9</title>
    <link rel="icon" href="/assets/imgs/"<?php 


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
                            <img src="/assets/imgs/<?php echo $value['product_image'];?>" alt="">
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
    
    
            <div class="checkout-container">
                <form method="POST" action="checkout.php">
                <input type="submit" name="checkout" class="btn checkout-btn" value="Check Out">
                </form>
            </div>
    
        </section>
    
    
    
    
        
    <?php include('layouts/footer.php'); ?> type="image/x-icon">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-3 fixed-top">
        <div class="container">
            <img class="logo" src="assets/imgs/back2.png">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="shop.html">Shop</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
            </li>
            <li class="nav-item icons"> 
                <a href="cart.html"><i class="fa fa-shopping-cart">
                   
                </i></a>            
                <a href="account.html"><i class="fa fa-user"></i></a>
            </li>
            
            </ul>
        </div>

        </div>
</nav>



<!--Account-->
<section class="my-5 py-5">
    <div class="row container mx-auto">
     <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-12">
         <h3 class="font-weight-bold">Account info</h3>
         <div class="account-info">
             <p>Name <span> ffffff</span></p>
             <p>Email<span> ffff@gmail.com</span></p>
             <p><a href="#" id="orders-btn">Your orders</a></p>
             <p><a href="#" id="logout-btn">Logout</a></p>

         </div>
     </div>
     <div class="col-lg-6 col-md-12 col-12">
         <form id="account-form">
             <h3>Change Password</h3>
             <div class="form-group">
                 <label >Password</label>
                 <input type="password" class="form-control" id="account-password"  name="password" placeholder="Password" required/>
             </div>
             <div class="form-group">
                 <label >Confirm Password</label>
                 <input type="password" class="form-control" id="account-password-confirm"  name="confirmPassword" placeholder="Password" required/>
             </div>
             <div class="form-group">
                 <input type="submit" value="Change Password" class="btn" id="change-pass-btn">
             </div>

         </form>
     </div>
    </div>

 </section>


 <!--Footer-->
<footer class="mt-5 pt-5">
    <div class="row container mx-auto pt-5">
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <img src="assets/imgs/back2.png" class="logo2" alt="">
            <p class="pt-3">We provide the best products the  most affordable prices</p>
            <img class="logo3" src="/assets/imgs/back2.png">
        <img class="logo3" src="/assets/imgs/back2.png">
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Featured</h5>
            <ul>
                <li><a href="#">men</a></li>
                <li><a href="#">women</a></li>
                <li><a href="#">boys</a></li>
                <li><a href="#">girls</a></li>
                <li><a href="#">new arrivals</a></li>
                <li><a href="#">clothes</a></li>
            </ul>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Contact Us</h5>
            <div>
                <h6>Address</h6>
                <p>1234 Street Name, City</p>
            </div>
            <div>
                <h6>Phone</h6>
                <p>12 345 678</p>
            </div>
            <div>
                <h6>Email</h6>
                <p>contact@gmail.com</p>
            </div>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Products</h5>
            <div class="row">
                <ul>
                    <li><a href="#">shoes</a></li>
                    <li><a href="#">watches</a></li>
                    <li><a href="#">coats</a></li>
                    <li><a href="#">dresses</a></li>
                    <li><a href="#">bags</a></li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
    </div>


    <div class="copyright mt-5">
        <div class="row container mx-auto text-center">
                <p>eCommerce @ 2025 All Rights Reserved to DMA9. Team</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>