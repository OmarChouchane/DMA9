<?php include 'header.php'; ?>  


<?php


//if user is not logged in
if(!isset($_SESSION['admin_logged_in'])){

    header('location: login.php');
    exit();

}

//get orders


    //1. determine page number
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        // if user has entered a page number
        $page_no = $_GET['page_no'];
    }else{
        // if user has not entered a page number
        $page_no = 1;

    }


    //2. return page number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");

    $stmt1->execute();

    $stmt1->bind_result($total_records);

    $stmt1->store_result();

    $stmt1->fetch();



    //3. determine number of products per page
    $total_records_per_page = 8;

    $offset = ($page_no - 1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $total_no_of_pages = ceil($total_records/$total_records_per_page);


    //4. get all products  
    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");
    $stmt2->execute();
    $products = $stmt2->get_result();



?>





<?php include 'sidemenu.php'; ?>  


        


    <div class="container page-title text-left mt-5 py-4">
        <div class="py-1">

            <p style="color:red;font-weight: 500;" class="text-center">
                    <?php if(isset($_GET['add_error'])){ echo $_GET['add_error'];}?>
            </p>
            <p style="color:green;font-weight: 500;" class="text-center">
                    <?php if(isset($_GET['add_success'])){ echo $_GET['add_success'];}?>
            </p>

            <p style="color:red;font-weight: 500;" class="text-center">
                    <?php if(isset($_GET['edit_error'])){ echo $_GET['edit_error'];}?>
            </p>
            <p style="color:green;font-weight: 500;" class="text-center">
                    <?php if(isset($_GET['edit_success'])){ echo $_GET['edit_success'];}?>
            </p>

            <p style="color:red;font-weight: 500;" class="text-center">
                    <?php if(isset($_GET['delete_error'])){ echo $_GET['delete_error'];}?>
            </p>
            <p style="color:green;font-weight: 500;" class="text-center">
                    <?php if(isset($_GET['delete_success'])){ echo $_GET['delete_success'];}?>
            </p>

        </div>
        <h2>DASHBOARD</h2>
        <hr class="">
        <h1>Products</h1>
    </div>

        
 

    <div class="container">

        <table class="table table-striped table-dark">
        <thead>
            <tr>
            <th scope="col">Product Id</th>
            <th scope="col">Product Image</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Price</th>
            <th scope="col">Product Offer</th>
            <th scope="col">Product Category</th>
            <th scope="col">Product Color</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>

        <?php while($product = $products->fetch_assoc()){ ?>

                <tr>

                    <th scope="row"><?php echo $product['product_id']; ?></th>
                    <td><img src="../assets/imgs/<?php echo $product['product_image']; ?>" style="width: 70px; height: 70px;"></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td>$<?php echo $product['product_price']; ?></td>
                    <td><?php echo $product['product_special_offer']; ?>%</td>
                    <td><?php echo $product['product_category']; ?></td>
                    <td><?php echo $product['product_color']; ?></td>
                    <td><a href="edit_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-primary">Edit</a></td>
                    <td><a href="delete_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-danger">Delete</a></td>

                </tr>

        <?php } ?>
        </tbody>
        </table>

    </div>



        <nav aria-label="page navigation">
                <ul class="pagination justify-content-center mt-5">
                    <li class="page-item <?php if($page_no <= 1){echo 'disabled';} ?>">
                        <a class="page-link" href="<?php if($page_no <= 1){echo '#';}else{ echo '?page_no='.($page_no-1);} ?>">Previous</a>
                    </li>
                    <li class="page-item <?php if($page_no == 1){echo 'active';}?>"><a class="page-link" href="?page_no=1">1</a></li>
                    <li class="page-item <?php if($page_no == 2){echo 'active';}else if($total_no_of_pages < 2){echo 'disabled';} ?>" aria-current="page">
                        <a class="page-link" href="?page_no=2">2</a>
                    </li>
                    <?php if($total_no_of_pages > 2){ ?>
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                        <li class="page-item <?php if($page_no > 2){ echo 'active'; }?>"><a class="page-link" href="<?php if($page_no < 3){ echo '?page_no=3'; }else{ echo '?page_no='.$page_no; }?>">
                            <?php if($page_no < 3){ echo 3; }else{ echo $page_no; } ?></a></li>
                    <?php } ?>
                    <li class="page-item <?php if($page_no >= $total_no_of_pages){echo 'disabled';} ?>">
                        <a class="page-link" href="<?php if($page_no >= $total_no_of_pages){echo '#';}else{ echo '?page_no='.($page_no+1);} ?>">Next</a>
                    </li>
                </ul>
        </nav>







<?php include 'footer.php'; ?>  
