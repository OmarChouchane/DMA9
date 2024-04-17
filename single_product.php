<?php
session_start();
include('server/connection.php');

class Product
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getProductById($product_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getRelatedProducts($product_id, $product_category)
    {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_id != ? LIMIT 4");
        $stmt->bind_param("si", $product_category, $product_id);
        $stmt->execute();
        return $stmt->get_result();
    }
}

// Create an instance of the Product class
$productManager = new Product($conn);

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Get product details
    $product = $productManager->getProductById($product_id);

    // Check if product exists
    if (!$product) {
        // Redirect if product not found
        header('location: index.php');
        exit(); // Terminate script execution
    }
} else {
    // Redirect if product_id is not set
    header('location: index.php');
    exit(); // Terminate script execution
}
?>

<?php include('layouts/header.php'); ?>

<!-- Single Product -->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">
        <!-- Product Image Section -->
        <div class="col-lg-5 col-md-6 col-sm-12">
            <!-- Main Product Image -->
            <img class="img-fluid w-100 pb-1" src="/assets/imgs/<?php echo $product['product_image']; ?>" alt="" id="mainImg">
            <!-- Small Images Section -->
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

        <!-- Product Details Section -->
        <div class="col-lg-6 col-12">
            
            <h3 class="py-4"><?php echo $product['product_name']; ?></h3>
            <h2>$<?php echo $product['product_price']; ?></h2>
            <form method="POST" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>" />
                <input type="hidden" name="product_image" value="<?php echo $product['product_image']; ?>" />
                <input type="hidden" name="product_name" value="<?php echo $product['product_name']; ?>" />
                <input type="hidden" name="product_price" value="<?php echo $product['product_price']; ?>" />
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
        // Retrieve related products
        $relatedProducts = $productManager->getRelatedProducts($product_id, $product['product_category']);
        while ($row_related = $relatedProducts->fetch_assoc()) {
        ?>
            <!-- Product Card -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <!-- Product Image -->
                <img src="/assets/imgs/<?php echo $row_related['product_image']; ?>" class="img-fluid mb-3">
                <!-- Product Name and Price -->
                <h5 class="p-name"><?php echo $row_related['product_name']; ?></h5>
                <h4 class="p-price">$<?php echo $row_related['product_price']; ?></h4>
                <!-- Buy Now Button with Link to Single Product Page -->
                <a href="single_product.php?product_id=<?php echo $row_related['product_id']; ?>"><button class="buy-btn">BUY NOW</button></a>
            </div>
        <?php } ?>
    </div>
</section>

<script>
    // JavaScript to handle image switching
    var mainImg = document.getElementById('mainImg');
    var smallImg = document.getElementsByClassName('small-img');

    for (let i = 0; i < smallImg.length; i++) {
        smallImg[i].onclick = function() {
            mainImg.src = smallImg[i].src;
        }
    }
</script>

<?php include('layouts/footer.php'); ?>
