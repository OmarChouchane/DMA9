<?php include 'header.php'; ?>  



<?php



if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $products = $stmt->get_result();




}else if(isset($_POST['edit_btn'])){

    $product_id = $_POST['product_id'];
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_color = $_POST['product_color'];
    $product_special_offer = $_POST['product_special_offer'];

    $stmt1 = $conn->prepare("UPDATE products SET product_name = ?, product_description = ?, product_price = ?, product_category = ?, product_color = ?, product_special_offer = ? WHERE product_id = ?");
        $stmt1->bind_param('ssissii', $product_title, $product_description, $product_price, $product_category, $product_color, $product_special_offer, $product_id);

        if($stmt1->execute()){
            header('location: products.php?edit_success=product edited successfully');
        }else{
            header('location: products.php?edit_error=error editing product');
        }



}else{

    header('location: products.php');
    exit();
}



?>



<?php include 'sidemenu.php'; ?>  




        


    <div class="container page-title text-left mt-5 py-4">
        <h2>DASHBOARD</h2>
        <hr class="">
        <h1>Edit Product</h1>
    </div>

        
 


    <div class="mx-auto container">
            <form id="checkout-form" method="POST" action="edit_product.php">


                <?php while($product = $products->fetch_assoc()){ ?>


                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <div class="form-group checkout-small-element">
                        <label>Title</label>
                        <input type="text" class="form-control" id="product-title" name="product_title" placeholder="title" value="<?php echo $product['product_name']; ?>">
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Description</label>
                        <input type="text" class="form-control" id="product-description" name="product_description" placeholder="description" value="<?php echo $product['product_description']; ?>">
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Price</label>
                        <input type="text" class="form-control" id="product-price" name="product_price" placeholder="price" value="<?php echo $product['product_price']; ?>">
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Category</label>
                        <select class="form-control" id="product-category" name="product_category">
                            <option value="bags">Bags</option>
                            <option value="shoes">Shoes</option>
                            <option value="watches">Watches</option>
                            <option value="clothes">Clothes</option>
                        </select>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Color</label>
                        <input type="text" class="form-control" id="product-color" name="product_color" placeholder="color" value="<?php echo $product['product_color']; ?>">
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Special Offer</label>
                        <input type="text" class="form-control" id="product-offer" name="product_special_offer" placeholder="special offer" value="<?php echo $product['product_special_offer']; ?>">
                    </div>
                    <div class="form-group edit-product checkout-btn-container">
                        <input type="submit" name="edit_btn" class="btn" id="checkout-btn" value="Edit">
                    </div>

                <?php } ?>


            </form>
    </div>







<?php include 'footer.php'; ?>  
