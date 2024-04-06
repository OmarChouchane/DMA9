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

?>

<?php include 'layouts/header.php'?>

<?php

if(isset($_POST['add_to_wishlist'])){

    // Check if the user is logged in
    if($user_id == ''){
        header('location:login.php');
        exit(); // Exit to prevent further execution
    }

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
    }else{
        // Insert the product into the wishlist
        $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, product_id, product_name, product_price, product_image) VALUES(?,?,?,?,?)");
        $insert_wishlist->bind_param("issss", $user_id, $pid, $name, $price, $image); // Bind parameters
        $insert_wishlist->execute();
        $message = 'Product added to your wishlist!';
    }
}

?>

<section class="products">

   <h3 class="heading">Your Wishlist</h3>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
      $select_wishlist->bind_param("i", $user_id); // Bind parameter
      $select_wishlist->execute();
      $result = $select_wishlist->get_result();
      if($result->num_rows > 0){
         while($fetch_wishlist = $result->fetch_assoc()){
            $grand_total += $fetch_wishlist['product_price'];  
   ?>
   
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_wishlist['product_id']; ?>">
      <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['wishlist_id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_wishlist['product_name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_wishlist['product_price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_wishlist['product_image']; ?>">
      <a href="quick_view.php?pid=<?= $fetch_wishlist['product_id']; ?>" class="fas fa-eye"></a>
      <img class="img-fluid mb-3" src="assets/imgs/<?= $fetch_wishlist['product_image']; ?>" alt="">
      <div class="name"><?= $fetch_wishlist['product_name']; ?></div>
      <div class="flex">
         <div class="price">$<?= $fetch_wishlist['product_price']; ?>/-</div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="Add to Cart" class="btn" name="add_to_cart">
      <input type="submit" value="Delete Item" onclick="return confirm('Delete this from wishlist?');" class="delete-btn" name="delete">
   </form>
   
   <?php
      }
   }else{
      echo '<p class="empty">Your wishlist is empty</p>';
   }
   ?>
   </>

   <div class="wishlist-total">
      <p>Grand Total: <span>$<?= $grand_total; ?>/-</span></p>
      <a href="shop.php" class="option-btn">Continue Shopping</a>
      <a href="wishlist.php?delete_all" class="delete-btn <?= ($grand_total > 0)?'':'disabled'; ?>" onclick="return confirm('Delete all items from wishlist?');">Delete All Items</a>
   </div>

</section>

<?php include 'layouts/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
