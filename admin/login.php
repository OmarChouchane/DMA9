<?php

session_start();


include '../server/connection.php';



//if admin is already logged in
if(isset($_SESSION['admin_logged_in'])){

    header('location: index.php');
    exit();

}



// if admin is not logged in
if(isset($_POST['login_btn'])){


    $email = $_POST['email'];
    $password = md5($_POST['password']);


    // retrieve admin info from the database
    $stmt = $conn->prepare("SELECT admin_id,admin_name,admin_email,admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1"); 
    $stmt->bind_param('ss', $email,$password);    


    // If the query is successful
    if($stmt->execute()){ 

        $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
        $stmt->store_result();


        // if account exists
        if($stmt->num_rows() == 1){

            $stmt->fetch();

            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;

            header('location: index.php?login=You logged in successfully');


        
        // if account does not exist
        }else{

            header('location: login.php?error=invalid email or password');

        }


    // If the query is not successful
    }else{

        header('location: login.php?error=something went wrong, try again later');

    }



}


?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/fontawesome.min.css">


    <link rel="stylesheet" href="../assets/css/style.css">


    <link rel="stylesheet" href="dashboard.css">
    <title>DMA9 admin</title>
    <link rel="icon" href="/assets/imgs/dma9.-logo-square.png" type="../image/x-icon">
</head>
<body>


    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
            <div class="container">
                <img class="logo" src="../assets/imgs/dma9-logo-2.png">
            <div class="nav-buttons">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item admin">
                    <span>Admin.</span>
                </li>
                </ul>
            </div>
            </div>
    </nav>




    <!--Login-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3">
            <h2 class="form-weihggt-bold">Admin Login</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="login-form" action="login.php" method="POST">
                <?php if(isset($_GET['error'])){?>
                    <p style="color: red;"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" value="Login" name="login_btn">
                </div>
               
            </form>
        </div>
    </section>


    <?php include 'footer.php'; ?>  

