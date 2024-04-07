<?php include 'header.php'; ?>  



<?php



if(isset($_GET['order_id'])){

    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $orders = $stmt->get_result();




}else if(isset($_POST['edit_order'])){

    $order_status = $_POST['order_status'];
    $order_id = $_POST['order_id'];

    $stmt1 = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
    $stmt1->bind_param('si', $order_status, $order_id);

        if($stmt1->execute()){
            header('location: index.php?order_edit_success=order edited successfully');
        }else{
            header('location: index.php?order_edit_error=error editing order');
        }



}else{

    header('location: index.php');
    exit();
}



?>



<?php include 'sidemenu.php'; ?>  




        


    <div class="container page-title text-left mt-5 py-4">
        <h2>DASHBOARD</h2>
        <hr class="">
        <h1>Edit Order</h1>
    </div>

        
 


    <div class="mx-auto container">
            <form id="checkout-form" method="POST" action="edit_order.php">


                <?php while($order = $orders->fetch_assoc()){ ?>


                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                    <div class="form-group checkout-small-element">
                        <label>Order Id</label>
                        <input type="text" class="form-control" id="order-id" name="order_id" placeholder="Id" value="<?php echo $order['order_id']; ?>" readonly>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Order Price</label>
                        <input type="text" class="form-control" id="order-price" name="order_price" placeholder="0.00" value="<?php echo $order['order_cost']; ?>" readonly>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Order Status</label>
                        <select class="form-select" required name="order_status">
                            <option value="not paid" <?php if($order['order_status'] == "not paid"){ echo"selected" ;} ?>>Not Paid</option>
                            <option value="paid" <?php if($order['order_status'] == "paid"){ echo"selected" ;} ?>>Paid</option>
                            <option value="shipped" <?php if($order['order_status'] == "shipped"){ echo"selected" ;} ?>>Shipped</option>
                            <option value="delivered" <?php if($order['order_status'] == "delivered"){ echo"selected" ;} ?>>Delivered</option>
                        </select>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Order Date</label>
                        <input type="text" class="form-control" id="order-date" name="order_date" placeholder="date" value="<?php echo $order['order_date']; ?>" readonly>
                    </div>
                    <div class="form-group edit-order checkout-btn-container">
                        <input type="submit" name="edit_order" class="btn" id="checkout-btn" value="Edit">
                    </div>

                <?php } ?>


            </form>
    </div>







<?php include 'footer.php'; ?>  
