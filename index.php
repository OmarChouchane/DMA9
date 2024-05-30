<?php 

session_start(); 



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/fontawesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">



    

    <link rel="stylesheet" href="assets/css/style.css">
    <title>DMA9</title>
    <link rel="icon" href="/assets/imgs/dma9.-logo-square.png" type="image/x-icon">
</head>
<body>
    


        

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-3 fixed-top" id="navbar">
            <div class="container">
                <img class="logo" src="assets/imgs/back2.png">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shop.php">Shop</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#contact-us-0">Contact Us</a>
                </li>
                <li class="nav-item icons"> 
                    <a href="cart.php"><i class="fa fa-shopping-cart">
                        <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0){
                            echo "<span class='cart-quantity'>".$_SESSION['quantity']."</span>";
                        } ?>
                       
                    </i></a> 
                    </li> 
                    <li class="nav-item icons">     
                    <a href="account.php"><i class="fa fa-user"></i></a>
                </li>
                <li class="nav-item">
                <a href="wishlist.php">
                    <i class="fa fa-heart mx-1" style="font-size: 18px;">
                    <?php if(isset($_SESSION['wishlist_item_count']) && $_SESSION['wishlist_item_count'] != 0){
                            echo "<span class='cart-quantity'>".$_SESSION['wishlist_item_count']."</span>";
                        } ?>
                    </i>
                </a>
                </li>

                
                </ul>
            </div>

            </div>
    </nav>


    <div id="banner-bg" class="container-fluid">



        <!--Home--> 
        <section id="home" data-aos="fade-up"  data-aos-duration="2000">
                <div class="container">
                    <p style="font-size: 60px;
                    margin-bottom: -4px;
                    font-weight: bold;
                    padding-left: 2px;">
                    Taste</p>
                    <h1><span>The Best Food</span><br/></h1><h1 style="padding-left: 11px;">in Town .</h1>
                    <p style="padding-left: 13px;">Order, Eat, Repeat ! Your delicious journey starts here.</p>
                    <button onclick="goTo()">ORDER NOW</button>
                </div>
        </section>
    
    
    
        <!--Upper-->
        <section id="upper" class="mb-5 py-5">
            <div class="container text-center mt-5" data-aos="fade-up" data-aos-duration="1000">
                <h3>The Most Popular</h3>
                <hr class="mx-auto">
                 <!--<p>Here you can check out our featured products</p>-->
            </div>
    
            <div class="container my-5 pb-3 custom-container" data-aos="fade-up" data-aos-duration="1000">
                <div class="row text-center">


                <?php  include('server/get_featured_products.php');  ?>

                <?php  while($row=$featured_products->fetch_assoc()){  ?>


                    <div  onclick="window.location.href='<?php echo "single_product.php?product_id=".$row['product_id'];?>'"  class="col-md-3" data-aos="zoom-in-up" data-aos-duration="1000">
                        <div class="custom-box">
                            <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt="Image 1" class="img-fluid">
                            <h5 class="mt-3"><?php echo $row['product_name']; ?></h5>
                            <p class="mt-3"><?php echo $row['product_description']; ?></p>
                            <h4 class ="p-price">$<?php echo $row['product_price']; ?></h4>
                            <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>"><button class="btn btn-primary mt-3 mb-4">BUY NOW</button></a>
                        </div>
                    </div>


                <?php } ?>
                </div>
            </div>
        </section>

    

    
        <!--Popular-->
        <section id="popular">
            <div class="cards mb-5  pb-5">
                <div class="container text-center mt-5"  data-aos="fade-up" data-aos-duration="1000">
                    <h3>Our Sandwiches</h3>
                    <hr class="mx-auto">
                      <!--<p>Here you can check out our featured products</p>-->
                </div>
                <div class="container">
                    <div class="row m-5 pt-5">
                    

                    <?php  include('server/get_sandwiches.php');  ?>

                    <?php  while($row=$coats_products->fetch_assoc()){  ?>


                        <div  onclick="window.location.href='<?php echo "single_product.php?product_id=".$row['product_id'];?>'"  class="card-body col-md-4" data-aos="zoom-in-up" data-aos-duration="1000">
                            <div class="card card-blog">
                                <div class="card-image text-center">
                                    <img class="img" src="assets/imgs/<?php echo $row['product_image']; ?>">
                                    <div class="card-caption text-center"><h4><?php echo $row['product_name']; ?></h4> </div>
                                    <h4 class ="p-price">$<?php echo $row['product_price']; ?></h4>
                                    <p class="mt-4"><?php echo $row['product_description']; ?></p>
                                    <button class="btn btn-primary mt-3 mb-4">Order Now</button>
                                    
                                </div>
                            </div>
                        </div>


                    <?php }  ?>



                </div>
            </div>
        </section>




        <!--Burgers-->
        <section id="burgers" class="home-products">
            <div class="cards">
                <div class="container text-center mt-5"  data-aos="fade-up" data-aos-duration="1000">
                    <h3>Our Burgers</h3>
                    <hr class="mx-auto">
                      <!--<p>Here you can check out our featured products</p>-->
                </div>
                <div class="container">
                    <div class="row m-5 pt-5">

                    <?php  include('server/get_burgers.php');  ?>

                    <?php  while($row=$shoes->fetch_assoc()){  ?>

                        <div  onclick="window.location.href='<?php echo "single_product.php?product_id=".$row['product_id'];?>'"  class="card-body col-md-3" data-aos="zoom-in-up" data-aos-duration="1000">
                            <div class="card card-blog">
                                <div class="card-image text-center">
                                    <img class="img" src="assets/imgs/<?php echo $row['product_image']; ?>">
                                    <div class="card-caption text-center"><h4><?php echo $row['product_name']; ?></h4> </div>
                                    <h4 class ="p-price">$<?php echo $row['product_price']; ?></h4>
                                    <p class="mt-4"><?php echo $row['product_description']; ?></p>

                                    <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>"><button class="btn btn-primary mt-3 mb-4">BUY NOW</button></a>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                    </div>
                </div>
            </div>
        </section>




        <!--Fries-->
        <section id="fries" class="home-products">
            <div class="cards">
                <div class="container text-center mt-5"  data-aos="fade-up" data-aos-duration="1000">
                    <h3>Our Fries</h3>
                    <hr class="mx-auto">
                    <!--<p>Here you can check out our featured products</p>-->
                </div>
                <div class="container">
                    <div class="row m-5 pt-5">

                    <?php  include('server/get_fries.php');  ?>

                    <?php  while($row=$watches->fetch_assoc()){  ?>

                        <div  onclick="window.location.href='<?php echo "single_product.php?product_id=".$row['product_id'];?>'"  class="card-body col-md-3" data-aos="zoom-in-up" data-aos-duration="1000">
                            <div class="card card-blog">
                                <div class="card-image text-center">
                                    <img class="img" src="assets/imgs/<?php echo $row['product_image']; ?>">
                                    <div class="card-caption text-center"><h4><?php echo $row['product_name']; ?></h4> </div>
                                    <h4 class ="p-price">$<?php echo $row['product_price']; ?></h4>
                                    <p class="mt-4"><?php echo $row['product_description']; ?></p>

                                    <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>"><button class="btn btn-primary mt-3 mb-4">BUY NOW</button></a>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                    </div>
                </div>
            </div>
        </section>






        <!--Contact Us-->

        <div id="contact-us-0" class="pb-5"></div>
  

        <section class="pb-5" id="contact-us">
            <div class="container" data-aos="zoom-in-up" data-aos-duration="1000">
                <div class="body">
                <div class="row justify-content-center text-center mb-lg-5">
                    <div class="col-lg-8 col-xxl-7">
                    <div class="container text-center mt-5"  data-aos="fade-up" data-aos-duration="1000">
                            <h3>Contact Us</h3>
                            <hr class="mx-auto">
                            <!--<p>Here you can check out our featured products</p>-->
                        </div>
                    </div>
                </div>
                <div class="row pb-5 ">
                    
                        <div class="col-md-6 map" data-aos="zoom-in-up" data-aos-duration="1000">
                        
                        
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10739.607942007151!2d10.19700484579142!3d36.8447621029688!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fd34c6d1e93bef%3A0x4153c4733f285343!2sNational%20Institute%20of%20Applied%20Science%20and%20Technology!5e0!3m2!1sen!2stn!4v1715343618339!5m2!1sen!2stn" width="100%" height="340" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  
                        
                    </div>

                    <div class="col-md-6" data-aos="zoom-in-up" data-aos-duration="1000">
                    
                        <form>
                            <div class="row text-center">
                            
                                <div class="col-12">
                                
                                    <div class="mb-3">
                                        <input class="form-control bg-light" placeholder="Full name" type="text">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <input class="form-control bg-light" placeholder="Email address" type="email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <textarea class="form-control bg-light" placeholder="Your message" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 send">
                                    <div class="">
                                        <button class="btn btn-primary submit" type="submit">Send message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </section>


    
    
    
    </div>

   





        <?php include('layouts/footer.php'); ?>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        
        
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <script>
          AOS.init();

        </script>


        <script src="assets/js/script.js"></script>
    
    </body>
    </html>


