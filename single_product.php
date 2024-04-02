<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/fontawesome.min.css">
    

    <link rel="stylesheet" href="assets/css/style.css">
    <title>DMA9</title>
    <link rel="icon" href="/assets/imgs/" type="image/x-icon">
</head>
<body>
    <!--NavBar-->

    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-3  fixed-top">
        <div class="container">
            <img class="logo" src="assets/imgs/back2.png">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="shop.html">Shop</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
            </li>
            <li class="nav-item icons"> 
                <a href="cart.html"><i class="fa fa-shopping-cart">
                   
                </i></a>            
                <a href="account.html"><i class="fa fa-user"></i></a>
            </li>
            
            </ul>
        </div>

        </div>
</nav>

<!--single-product -->
<section class="single-product container my-5 pt-5">
    <div class="row mt-5 ">

      <!--<?php  while($row=$product->fetch_assoc()) { ?> -->
        
        <div class="col-lg-5  col-md-6 col-sm-12">
            <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php  echo $row['product_image'];?>" id="main-img"/>
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="assets/imgs/<?php  echo $row['product_image'];?>"  width="100%" class="small-img"/>

                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php  echo $row['product_image2'];?>"  width="100%" class="small-img"/>
                    
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php  echo $row['product_image3'];?>"  width="100%" class="small-img"/>   
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php  echo $row['product_image4'];?>"  width="100%" class="small-img"/>
                    
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-12">
            
            <h3 class="py-4"><?php  echo $row['product_name'];?></h3>
            <h2>$<?php  echo $row['product_price'];?></h2>
            
            <input style ="height:20px" type="number" name="product_quantity"value="1"/>
              <form method="POST" action="cart.php">
              <input type="hidden" name="product_id" value="<?php  echo $row['product_id'];?>" />
            <input type="hidden" name="product_image" value="<?php  echo $row['product_image'];?>" />
            <input type="hidden"  name="product_name" value="<?php  echo $row['product_name'];?>" />
            <input type="hidden"  name="product_price" value="<?php  echo $row['product_price'];?>" />
            <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>
            <br>
            <br>
            <br>
            </form>

            <h6>Product Description</h6>

            <h4 class="mt-5 mb-5"><?php  echo $row['product_description'];?></h4>

        </div>
        
    <?php }?>

    </div>
  </section>





<!--Related-products-->
<section id="related-products" class="my-5 pb-5">
<div class="container text-center mt-5 py-5">
  <h3 style="color:black">Related Products</h3>
  <hr class="mx-auto">
</div>


<section >
    <div class="row mx-auto container-fluid">
      
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img  class="img-fluid mb-3" src="assets/imgs/featured1.png" />
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h4 class="p-name">NAME</h4>
            <h6>DESCRIPTION</h6>
            <h5 class="p-price">€
              </h5>
            <button class="buy-btn">Order Now</button>
    
          </div>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img  class="img-fluid mb-3" src="assets/imgs/featured1.png" />
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h4 class="p-name">NAME</h4>
        <h6>DESCRIPTION</h6>
        <h5 class="p-price">€
          </h5>
        <button class="buy-btn">Order Now</button>

      </div>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img  class="img-fluid mb-3" src="assets/imgs/featured1.png" />
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h4 class="p-name">NAME</h4>
        <h6>DESCRIPTION</h6>
        <h5 class="p-price">€
          </h5>
        <button class="buy-btn">Order Now</button>

      </div>
      
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img  class="img-fluid mb-3" src="assets/imgs/featured1.png" />
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h4 class="p-name">NAME</h4>
        <h6>DESCRIPTION</h6>
        <h5 class="p-price">€
          </h5>
        <button class="buy-btn">Order Now</button>

      </div>

      

    </div>
    </section>
</section>






<footer class="mt-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img src="assets/imgs/back2.png" class="img-fluid mb-3 logo " alt="Restaurant Logo">
                <p>Dive into our mouthwatering creations and let your taste buds thank you later. Get ready for a whole new level of deliciousness!</p>
                <div class="social-icons">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Featured</h5>
                <ul>
                    <li><a href="#">Menu</a></li>
                    <li><a href="#">Specials</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">Reservations</a></li>
                    <li><a href="#">Reviews</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Contact Us</h5>
                <div>
                    <h6>Address</h6>
                    <p>1234 Street Name, City</p>
                </div>
                <div>
                    <h6>Phone</h6>
                    <p>12 345 678</p>
                </div>
                <div>
                    <h6>Email</h6>
                    <p>contact@restaurant.com</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Hours</h5>
                <ul>
                    <li>Monday - Friday: 11:00 AM - 10:00 PM</li>
                    <li>Saturday - Sunday: 10:00 AM - 11:00 PM</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="copyright mt-5 py-4">
        <div class="container text-center">
            <p>&copy; 2024 Restaurant. All Rights Reserved.</p>
        </div>
    </div>
</footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
    var mainImg = document.getElementById("main-img");
    var smallImg = document.getElementsByClassName("small-img");
    for(let i=0 ; i<4 ; i++){
    smallImg[i].onclick = function(){
        mainImg.src = smallImg[i].src
    }
}

</script>

</body>
</html>