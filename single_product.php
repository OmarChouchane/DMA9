<?php 
session_start(); 
include('server/connection.php');

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    
    $stmt->execute();

    $result = $stmt->get_result();

    // Fetch the product details as an associative array
    $product = $result->fetch_assoc();

    // Check if product exists
    if(!$product) {
        // Redirect if product not found
        header('location: index.php');
        exit(); // Terminate script execution
    }
}else{
    // Redirect if product_id is not set
    header('location: index.php');
    exit(); // Terminate script execution
}
?>

<?php include('layouts/header.php'); ?>

<!-- Single Product -->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">
        <div class="col-lg-5 col-md-6 col-sm-12">
            <img class="img-fluid w-100 pb-1" src="/assets/imgs/<?php echo $product['product_image']; ?>" alt="" id="mainImg">
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="/assets/imgs/<?php echo $product['product_image']; ?>" width="100%" class="small-img">
                </div>
                <div class="small-img-col">
                    <img src="/assets/imgs/<?php echo $product['product_image2']; ?>" width="100%" class="small-img">
                </div>
                <div class="small-img-col">
                    <img src="/assets/imgs/<?php echo $product['product_image3']; ?>" width="100%" class="small-img">
                </div>
                <div class="small-img-col">
                    <img src="/assets/imgs/<?php echo $product['product_image4']; ?>" width="100%" class="small-img">
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-12">
            <h6>Men/Shoes</h6>
            <h3 class="py-4"><?php echo $product['product_name']; ?></h3>
            <h2>$<?php echo $product['product_price']; ?></h2>
            <form method="POST" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>"/>
                <input type="hidden" name="product_image" value="<?php echo $product['product_image']; ?>"/>
                <input type="hidden" name="product_name" value="<?php echo $product['product_name']; ?>"/>
                <input type="hidden" name="product_price" value="<?php echo $product['product_price']; ?>"/>
                <input type="number" name="product_quantity" value="1">
                <button class="buy-btn" name="add_to_cart" type="submit">ADD TO CART</button>
            </form> 
            <h4 class="my-5">Product details</h4>
            <span><?php echo $product['product_description']; ?></span>
        </div>
    </div>
</section>

<!-- Related Products -->
<section id="related-products" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
        <h3>Related Products</h3>
        <hr class="mx-auto">
    </div>
    <div class="row mx-auto container-fluid">
        <?php
        // Retrieve related products from the same category
        $stmt_related = $conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_id != ? LIMIT 4");
        $stmt_related->bind_param("si", $product['product_category'], $product_id);
        $stmt_related->execute();
        $result_related = $stmt_related->get_result();

        while ($row_related = $result_related->fetch_assoc()) {
        ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img src="/assets/imgs/<?php echo $row_related['product_image']; ?>" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h5 class="p-name"><?php echo $row_related['product_name']; ?></h5>
                <h4 class="p-price">$<?php echo $row_related['product_price']; ?></h4>
                <button class="buy-btn">BUY NOW</button>
            </div>
        <?php } ?>
    </div>
</section>

<script>
    var mainImg = document.getElementById('mainImg');
    var smallImg = document.getElementsByClassName('small-img');

    for(let i=0; i<smallImg.length; i++){
        smallImg[i].onclick = function(){
            mainImg.src = smallImg[i].src;
        }
    }
</script>

<?php include('layouts/footer.php'); ?>
