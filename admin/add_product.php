<?php include 'header.php'; ?>  



<?php



if(isset($_POST['add_product_btn'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_color = $_POST['product_color'];
    $product_special_offer = $_POST['product_special_offer'];

    $image1 = $_FILES['product_image1']['tmp_name'];
    $image2 = $_FILES['product_image2']['tmp_name'];
    $image3 = $_FILES['product_image3']['tmp_name'];
    $image4 = $_FILES['product_image4']['tmp_name'];

    $image_name1 = $product_name . "1.png";
    $image_name2 = $product_name . "2.png";
    $image_name3 = $product_name . "3.png";
    $image_name4 = $product_name . "4.png";

    move_uploaded_file($image1, "../assets/imgs/" . $image_name1);
    move_uploaded_file($image2, "../assets/imgs/" . $image_name2);
    move_uploaded_file($image3, "../assets/imgs/" . $image_name3);
    move_uploaded_file($image4, "../assets/imgs/" . $image_name4);



    $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, product_price, product_category, product_color, product_special_offer, product_image, product_image2, product_image3, product_image4) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssssss', $product_name, $product_description, $product_price, $product_category, $product_color, $product_special_offer, $image_name1, $image_name2, $image_name3, $image_name4);

    if($stmt->execute()){
        header('location: products.php?add_success=new product added successfully');
    }else{
        header('location: products.php?add_error=new product adding error, try again');
    }



}



?>



<?php include 'sidemenu.php'; ?>  




        


    <div class="container page-title text-left mt-5 py-4">
        <h2>DASHBOARD</h2>
        <hr class="">
        <h1>Add New Product</h1>
    </div>

        
 


    <div class="mx-auto container">
            <form id="checkout-form" method="POST" action="add_product.php" enctype="multipart/form-data">

                    <div class="form-group checkout-small-element">
                        <label>Title</label>
                        <input type="text" class="form-control" id="product-title" name="product_title" placeholder="title" value="">
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Description</label>
                        <input type="text" class="form-control" id="product-description" name="product_description" placeholder="description" value="">
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Price</label>
                        <input type="text" class="form-control" id="product-price" name="product_price" placeholder="price" value="">
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Special Offer</label>
                        <input type="text" class="form-control" id="product-offer" name="product_special_offer" placeholder="special offer" value="">
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
                        <input type="text" class="form-control" id="product-color" name="product_color" placeholder="color" value="">
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Image 1</label>
                        <input type="file" class="form-control" id="product-image" name="product_image1">
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Image 2</label>
                        <input type="file" class="form-control" id="product-image" name="product_image2">
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Image 3</label>
                        <input type="file" class="form-control" id="product-image" name="product_image3">
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Image 4</label>
                        <input type="file" class="form-control" id="product-image" name="product_image4">
                    </div>
                    <div class="form-group edit-product checkout-btn-container">
                        <input type="submit" name="add_product_btn" class="btn" id="checkout-btn" value="Add">
                    </div>



            </form>
    </div>







<?php include 'footer.php'; ?>  
