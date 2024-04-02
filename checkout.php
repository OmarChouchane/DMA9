
<?php

session_start();

if(!empty($_SESSION['cart'])){


}else{
    header('Location: index.php');
}



?>





<?php include('layouts/header.php'); ?>






    <!--Checkout-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weihggt-bold">Check Out</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="checkout-form" method="POST" action="server/place_order.php">
                <p style="color:red;" class="text-center">
                    <?php if(isset($_GET['message'])){?>
                        Please <a style="text-decoration: none;" href="login.php">login </a>/ <a style="text-decoration: none;" href="register.php">register</a> to place an order
                    <?php } ?>
                </p>
                <div class="form-group checkout-small-element">
                    <label>Name</label>
                    <input type="text" class="form-control" id="checkout-email" name="name" placeholder="Name" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Email</label>
                    <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>Phone</label>
                    <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label>city</label>
                    <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required>
                </div>
                <div class="form-group checkout-large-element">
                    <label>Address</label>
                    <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required>
                </div>
                <div class="form-group checkout-btn-container">
                    <p>Total amount : $ <?php echo $_SESSION['total'];?></p>
                    <input type="submit" name="place_order" class="btn" id="checkout-btn" value="Place Order">
                </div>
            </form>
        </div>
    </section>






<?php include('layouts/footer.php'); ?>
