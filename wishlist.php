<?php
include 'server/connection.php';
session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:login.php');
    exit(); // Exit to prevent further execution
}

// Check if the user is logged in
if(isset($_POST['delete'])){
    $wishlist_id = $_POST['wishlist_id'];
    $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE wishlist_id = ?");
    $delete_wishlist_item->bind_param("i", $wishlist_id); // Bind parameter
    $delete_wishlist_item->execute();
}

if(isset($_GET['delete_all'])){
    $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
    $delete_wishlist_item->bind_param("i", $user_id); // Bind parameter
    $delete_wishlist_item->execute();
    header('location:wishlist.php');
    exit(); // Exit to prevent further execution
}
// Retrieve the count of wishlist items for the current user
    $count_wishlist_items = 0;
    if (!empty($user_id)) {
    $count_wishlist_query = $conn->prepare("SELECT COUNT(*) AS count FROM `wishlist` WHERE user_id = ?");
    $count_wishlist_query->bind_param("i", $user_id);
    $count_wishlist_query->execute();
    $count_result = $count_wishlist_query->get_result();
    $count_row = $count_result->fetch_assoc();
    $count_wishlist_items = $count_row['count'];
    //echo ''. $count_wishlist_items .'';
    $_SESSION['wishlist_item_count'] = $count_wishlist_items;
}


?>

<?php include 'layouts/header.php'?>

<?php

if(isset($_POST['add_to_wishlist'])){

    // Check if the user is logged in
    if($user_id == ''){
        header('location:login.php');
        exit(); // Exit to prevent further execution
    }
    header('location:shop.php' );

    // Sanitize input data
    $pid = filter_var($_POST['pid'], FILTER_SANITIZE_STRING);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
    $image = filter_var($_POST['image'], FILTER_SANITIZE_STRING);

    // Check if the product is already in the wishlist
    $check_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE product_name = ? AND user_id = ?");
    $check_wishlist->bind_param("si", $name, $user_id); // Bind parameters
    $check_wishlist->execute();
    $result = $check_wishlist->get_result();
    if($result->num_rows > 0){
        $message = 'This product is already in your wishlist!';
        header('location:shop.php?This product is already in your wishlist!');
        
       
    }else{
        // Insert the product into the wishlist
        $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, product_id, product_name, product_price, product_image) VALUES(?,?,?,?,?)");
        $insert_wishlist->bind_param("issss", $user_id, $pid, $name, $price, $image); // Bind parameters
        $insert_wishlist->execute();
        $message = 'Product added to your wishlist!';
        header('location:shop.php?Product added to your wishlist!!');

        
    }

}

?>
<section class="container text-center my-3 py-3">
    <div class="container mt-5">
    <h2 class="font-weight-bold" >Your Wishlist</h2>
    
    </div>
    <div class="container row">
        <?php
        $grand_total = 0;
        $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
        $select_wishlist->bind_param("i", $user_id); // Bind parameter
        $select_wishlist->execute();
        $result = $select_wishlist->get_result();
        if ($result->num_rows > 0) {
            while ($product = $result->fetch_assoc()) {
                $grand_total += $product['product_price'];
                ?>
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <form action="cart.php" method="post" class="box">
                <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                <input type="hidden" name="wishlist_id" value="<?= $product['wishlist_id']; ?>">
                <input type="hidden" name="product_name" value="<?= $product['product_name']; ?>">
                <input type="hidden" name="product_price" value="<?= $product['product_price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo  $product['product_image']; ?>">
                
                <img class="img-fluid mb-3" src="assets/imgs/<?= $product['product_image']; ?>" alt="">
                <div><?= $product['product_name']; ?></div>
                <div>$<?= $product['product_price']; ?></div>
                <input type="number" name="product_quantity" value="1" min="1" max="99" style="width:20%"
                    onkeypress="if(this.value.length == 2) return false;">
                <button class="buy-btn" name="add_to_cart" type="submit">ADD TO CART</button>
            </form>
            <br>
            <form action="wishlist.php" method="post">
                <input type="hidden" name="delete" value="delete"> <!-- Add this hidden input field -->
                <input type="hidden" name="wishlist_id" value="<?= $product['wishlist_id']; ?>">
                <input style="background-color:transparent ; border: none;color:orange;"type="submit" value="Remove" onclick="return confirm('Delete <?php echo $product['product_name']; ?> from wishlist?');" class="buy-btn">
            </form>
        </div>

                <?php
            }
        } else {
            echo '<p class="empty">Your wishlist is empty</p>';
        }
        ?>
    </div>

    <div class="wishlist-total">
        <h4>Total: <span>$<?= $grand_total; ?></span></h4>
        <a style="color:orange;" href="shop.php" class="option-btn">Continue Shopping</a>
        <a style="color:orange;" href="wishlist.php?delete_all"
           class="delete-btn <?= ($grand_total > 0) ? '' : 'disabled'; ?>"
           onclick="return confirm('Delete all items from wishlist?');">Delete All Items</a>
    </div>
</section>


<script src="js/script.js"></script>

<?php include 'layouts/footer.php'; ?>
