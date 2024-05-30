<?php

include "server/connection.php";

session_start();

class ProductHandler {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getProducts($pageNo = 1, $category = null, $maxPrice = null) {
        $perPage = 8;
        $offset = ($pageNo - 1) * $perPage;

        if ($category !== null && $maxPrice !== null) {
            $stmt = $this->conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_price <= ? LIMIT ?, ?");
            $stmt->bind_param("siii", $category, $maxPrice, $offset, $perPage);
        } elseif ($maxPrice !== null) {
            $stmt = $this->conn->prepare("SELECT * FROM products WHERE product_price <= ? LIMIT ?, ?");
            $stmt->bind_param("iii", $maxPrice, $offset, $perPage);
        } else {
            $stmt = $this->conn->prepare("SELECT * FROM products LIMIT ?, ?");
            $stmt->bind_param("ii", $offset, $perPage);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    public function getTotalPages() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS total_records FROM products");
        $stmt->execute();
        $stmt->bind_result($totalRecords);
        $stmt->fetch();
        $perPage = 8;
        return ceil($totalRecords / $perPage);
    }
}

$productHandler = new ProductHandler($conn);

$pageNo = isset($_GET['page_no']) ? $_GET['page_no'] : 1;
$category = isset($_GET['category']) ? $_GET['category'] : null;
$maxPrice = isset($_GET['price']) ? $_GET['price'] : null;

if (isset($_GET['search'])) {
    $products = $productHandler->getProducts($pageNo, $category, $maxPrice);
    $totalPages = 1; // No pagination for search results
} else {
    $products = $productHandler->getProducts($pageNo);
    $totalPages = $productHandler->getTotalPages();
}

// Now $products contains the result set of products for the current page, and $totalPages contains the total number of pages.
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
                        <input class="form-check-input" value="burger" type="radio" name="category" id="category_one" <?php if(isset($_GET['category']) && $category == 'burger') echo 'checked'; ?>>
                        <label class="form-check-label" for="flexRadioDefault1">Burger</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="sandwich"  type="radio" name="category" id="category_two" <?php if(isset($_GET['category']) && $_GET['category'] == 'sandwich') echo 'checked'; ?>>
                        <label class="form-check-label" for="flexRadioDefault2">Sandwich</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="fries"  type="radio" name="category" id="category_three" <?php if(isset($_GET['category']) && $_GET['category'] == 'fries') echo 'checked'; ?>>
                        <label class="form-check-label" for="flexRadioDefault3">Fries</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="pizza"  type="radio" name="category" id="category_four" <?php if(isset($_GET['category']) && $_GET['category'] == 'pizza') echo 'checked'; ?>>
                        <label class="form-check-label" for="flexRadioDefault4">Pizza</label>
                    </div>
                </div>
            </div>

            <div class="row mx-auto container mt-5">
                <div class="col-12">
                    <div class="form-group">
                        <label for="customRange">Price</label>
                        <?php
                    // Define $price variable
                    $price = isset($_GET['price']) ? $_GET['price'] : '500';
                    ?>

                    <?php $price = isset($_GET['price']) ? $_GET['price'] : '500'; ?>

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
                <form id="wishlist-form" action="wishlist.php" method="post">
                <input type="hidden" name="pid" value="<?php echo $row['product_id']; ?>">
                <input type="hidden" name="name" value="<?php echo $row['product_name']; ?>">
                <input type="hidden" name="price" value="<?php echo $row['product_price']; ?>">
                <input type="hidden" name="image" value="<?php echo $row['product_image']; ?>">
                <button id="heart-button" type="submit" name="add_to_wishlist" class="active">
                    <?php if(isset($_SESSION['wishlist-product'][$row['product_id']])) { ?>
                        <i class="fa fa-heart" style="color: red;"></i>
                    <?php } else {?>
                        <i class="fa fa-heart"></i>
                    <?php } ?>
                </button>

                </form>
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
        <li class="page-item <?php if($pageNo <= 1){echo 'disabled';} ?>">
            <a class="page-link" href="<?php if($pageNo <= 1){echo '#';}else{ echo '?page_no='.($pageNo-1);} ?>">Previous</a>
        </li>
        <li class="page-item <?php if($pageNo == 1){echo 'active';}if($totalPages == 0){echo 'disabled';} ?>"><a class="page-link" href="?page_no=1">1</a></li>
        <li class="page-item <?php if($pageNo == 2){echo 'active';}if($totalPages < 2){echo 'disabled';} ?>" aria-current="page">
            <a class="page-link" href="?page_no=2">2</a>
        </li>
        <?php if($totalPages > 2){ ?>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item <?php if($pageNo > 2){ echo 'active'; }?>"><a class="page-link" href="<?php if($pageNo < 3){ echo '?page_no=3'; }else{ echo '?page_no='.$pageNo; }?>">
                <?php if($pageNo < 3){ echo 3; }else{ echo $pageNo; } ?></a></li>
        <?php } ?>
        <li class="page-item <?php if($pageNo >= $totalPages){echo 'disabled';} ?>">
            <a class="page-link" href="<?php if($pageNo >= $totalPages){echo '#';}else{ echo '?page_no='.($pageNo+1);} ?>">Next</a>
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
   
    <style>
        #heart-button 
        i{
            color:grey;
        }
        .heart-red {
        background-color: red;
        }
        #heart-button 
        i:hover{
            color:red;
        }
        .red-heart {
        color: red; /* Set the color to red */
        }
    </style>
     <script>
        document.getElementById('heart-button').addEventListener('click',function(){
            document.getElementById("heart-icon").classList.toggle("heart-red ");
            
        });
    </script>
    
    



<?php include('layouts/footer.php'); ?>

 