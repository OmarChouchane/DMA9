<?php 

session_start(); 


include('layouts/header.php'); 

?>



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
                    

                    <?php  include('server/get_coats.php');  ?>

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

                    <?php  include('server/get_shoes.php');  ?>

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

                    <?php  include('server/get_watches.php');  ?>

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





        <!--Features-->
        <section id="features" class="py-5">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-8 order-lg-1 mb-5 mb-lg-0">
                        <div class="container-fluid px-5">
                            <div class="row gx-5">
                                <div class="col-md-6 mb-5" data-aos="fade-left" data-aos-duration="1000">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi bi-stopwatch icon-feature text-gradient d-block mb-3"></i>

                                        <h3 class="font-alt">Sor3a</h3>
                                        <p class="text-muted mb-0">prioritizing speed without compromising quality.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-5" data-aos="fade-left" data-aos-duration="1000">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi bi-emoji-laughing icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Bachecha</h3>
                                        <p class="text-muted mb-0"> Serving smiles with every dish.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-5 mb-md-0" data-aos="fade-left" data-aos-duration="1000">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi bi-check-lg icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Mawthou9</h3>
                                        <p class="text-muted mb-0">Selecting each ingredient, aiming confidence in our dishes.</p>
                                    </div>
                                </div>
                                <div class="col-md-6" data-aos="fade-left" data-aos-duration="1000">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi bi-cash icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">R5is</h3>
                                        <p class="text-muted mb-0">Affordable for all.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 order-lg-0">
                        <!-- Features section device mockup-->
                        
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
}
        </script>


        <script src="assets/js/script.js"></script>
    
    </body>
    </html>


