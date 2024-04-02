<?php 

include "server/connection.php";




// Check if the search button is clicked
if(isset($_GET['search'])){

    $category = $_GET['category'];
    $price = $_GET['price'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_price <= ?");

    $stmt->bind_param("si", $category, $price);

    $stmt->execute();

    $products = $stmt->get_result();



// Check if the search button is not clicked
}else{

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

    $adjacent = "2";

    $total_no_of_pages = ceil($total_records/$total_records_per_page);


    //4. get all products  
    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");
    $stmt2->execute();
    $products = $stmt2->get_result();
    
}




?>



<?php include('layouts/header.php'); ?>


    <style>


        .container1 {
            margin: auto;
            overflow: hidden;
            position: relative; /* Added position relative */
        }

        /* Search section styles */
        #search {
            padding: 20px;
            width: 250px; /* Adjust width as needed */
            position: fixed;
            overflow-y: hidden;
        }

        /* Shop section styles */
        #shop {
            padding: 20px;
            width: calc(100% - 250px); /* Adjust width to take the remaining space */
            margin-left: 250px; /* Adjust margin to make space for the fixed search */
        }

        /* Larger devices (width > 768px) */
        @media screen and (min-width: 768px) {
            #search {
                width: 250px; /* Adjust width as needed */
            }
        
            #shop {
                width: calc(100% - 250px); /* Adjust width to take the remaining space */
                margin-left: 250px; /* Adjust margin to make space for the fixed search */
            }
        }

        /* Smaller devices (width <= 768px) */
        @media screen and (max-width: 768px) {
            #search {
                position: relative !important; /* Not fixed */
                width: 100%; /* Full width */
            }
        
            #shop {
                margin-left: 0; /* Remove margin */
                width: 100%; /* Full width */
                padding-top: 0 !important;
            }

        }


        /* Range input styles */
        #customRange {
            width: 100%;
        }

        /* Range labels styles */
        .range-labels {
            display: flex;
            justify-content: space-between; /* Distribute items evenly */
        }

        /* Style the range value */
        #rangeValue {
            display: inline-block;
            margin-left: 10px;
            font-weight: bold;
            color: coral;
        }





        hr{
            width: 50px;
            border: 2px solid #fbb710;
            margin: 17px 0;
        }

        .product img{
            width: 100%;
            height: auto;
            box-sizing: border-box;
            object-fit: cover;
        }

        .pagination a{
            color: coral;
        }

        .pagination li:hover a{
            color: white;
            background-color: coral;
        }

        .pagination li.active a {
            background-color: orange !important;
            border: 1px solid orange !important;
        }
        
    </style>


    <div class="container1">


    <!--Search-->
    <section id="search" class="my-5 py-4 ms-2">
        <div class="container mt-5 pt-5">
            <p>Search Products</p>
            <hr>
        </div>

        <form action="shop.php" method="GET">

            <div class="row mx-auto container">
                <div class="col-12">
                    <p>Category</p>
                    <div class="form-check">
                        <input class="form-check-input" value="shoes" type="radio" name="category" id="category_one" <?php if(isset($_GET['category']) && $category == 'shoes') echo 'checked'; ?>>
                        <label class="form-check-label" for="flexRadioDefault1">Shoes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="coats"  type="radio" name="category" id="category_two" <?php if(isset($_GET['category']) && $_GET['category'] == 'coats') echo 'checked'; ?>>
                        <label class="form-check-label" for="flexRadioDefault2">Coats</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="watches"  type="radio" name="category" id="category_three" <?php if(isset($_GET['category']) && $_GET['category'] == 'watches') echo 'checked'; ?>>
                        <label class="form-check-label" for="flexRadioDefault3">Watches</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="bags"  type="radio" name="category" id="category_four" <?php if(isset($_GET['category']) && $_GET['category'] == 'bags') echo 'checked'; ?>>
                        <label class="form-check-label" for="flexRadioDefault4">Bags</label>
                    </div>
                </div>
            </div>

            <div class="row mx-auto container mt-5">
                <div class="col-12">
                    <div class="form-group">
                        <label for="customRange">Price</label>
                        <input type="range" class="form-range" min="1" max="1000" id="customRange" value="<?php if(isset($_GET['search'])){ echo $price;}else{ echo '500';}?>" name="price">
                        <div class="range-labels">
                            <span>1</span>
                            <span id="rangeValue"><?php if(isset($_GET['search'])){ echo $price;}else{ echo '500';}?></span>
                            <span>1000</span>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="form-group m-3">
                <input type="submit" name="search" value="Search" class="btn btn-primary">
            </div>
        </form>
    </section>



    <!--Shop-->
    <section id="shop" class="my-5 py-4">
        <div class="container mt-5 py-5">
            <h3>Our Products</h3>
            <hr>
            <p>Here you can check out our featured products</p>
        </div>
        <div class="row mx-auto container">

        <?php if($products->num_rows == 0){?>
            <div class="text-center">
                <h3>No products found</h3>
            </div>
        <?php }?>

        <?php while($row = $products->fetch_assoc()) {?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img onclick="window.location.href='<?php echo "single_product.php?product_id=".$row['product_id'];?>'" src="assets/imgs/<?php echo $row['product_image'];?>" class="img-fluid mb-3">
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h5 class ="p-name"><?php echo $row['product_name'];?></h5>
                <h4 class ="p-price">$<?php echo $row['product_price'];?></h4>
                <button class="buy-btn" onclick="window.location.href='<?php echo "single_product.php?product_id=".$row['product_id'];?>'" >BUY NOW</button>
            </div>

        <?php } ?>
        
            <nav aria-label="page navigation">
                <ul class="pagination justify-content-center mt-5">
                    <li class="page-item <?php if($page_no <= 1){echo 'disabled';} ?>">
                        <a class="page-link" href="<?php if($page_no <= 1){echo '#';}else{ echo '?page_no='.($page_no-1);} ?>">Previous</a>
                    </li>
                    <li class="page-item <?php if($page_no == 1){echo 'active';} ?>"><a class="page-link" href="?page_no=1">1</a></li>
                    <li class="page-item <?php if($page_no == 2){echo 'active';} ?>" aria-current="page">
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

        </div>
    </section>

    </div>





    <script>

        window.addEventListener('scroll', function() {
            if (window.innerWidth > 576) {
                var search = document.getElementById('search');
                var footer = document.querySelector('footer');
                var container = document.querySelector('.container1');
                var footerOffset = footer.offsetTop;
                var containerOffset = container.offsetTop;
                var containerHeight = container.offsetHeight;
                var windowHeight = window.innerHeight;
                var scrollPosition = window.scrollY;
                
                if (scrollPosition >= footerOffset - windowHeight + 80) {
                    search.style.position = 'absolute';
                    search.style.top = containerHeight - search.offsetHeight - 8 + 'px';
                } else {
                    search.style.position = 'fixed';
                    search.style.top = '0';
                }
            }
        });



        // Get the range input element
        var rangeInput = document.getElementById('customRange');

        // Get the span element to display the range value
        var rangeValue = document.getElementById('rangeValue');

        // Update the range value display when the input changes
        rangeInput.addEventListener('input', function() {
            rangeValue.textContent = rangeInput.value;
        });


    </script>


<?php include('layouts/footer.php'); ?>

 