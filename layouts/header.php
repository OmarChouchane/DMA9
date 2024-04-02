
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
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>
                <li class="nav-item icons"> 
                    <a href="cart.php"><i class="fa fa-shopping-cart">
                        <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0){
                            echo "<span class='cart-quantity'>".$_SESSION['quantity']."</span>";
                        } ?>
                       
                    </i></a>            
                    <a href="account.php"><i class="fa fa-user"></i></a>
                </li>
                
                </ul>
            </div>

            </div>
    </nav>