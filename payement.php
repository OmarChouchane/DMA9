
<?php

session_start();


if(isset($_POST['order_pay_btn'])){

    $order_status = $_POST['order_status'];
    $total_order_price = $_POST['total_order_price'];

}

?>





<?php include('layouts/header.php'); ?>





    <!--Payement-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weihggt-bold">Payement</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container text-center">
            
        <?php if(isset($_SESSION['total']) && $_SESSION['total'] != 0){?>
            <p>Total payement : $<?php echo $_SESSION['total'];?></p>
            <input class="button" type="submit" value="Pay Now">
        <?php } else if(isset($_POST['order_status'])  &&  $_POST['order_status'] == "not paid"){ ?>
            <p>Total payement : $<?php echo $_POST['total_order_price'];?></p>
            <input class="button" type="submit" value="Pay Now">
        <?php }else{ ?>
                <p>You don't have an order to pay</p>
        <?php } ?>
        </div>
    </section>






<?php include('layouts/footer.php'); ?>
