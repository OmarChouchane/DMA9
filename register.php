<?php


session_start();



include 'server/connection.php';


//if user is already logged in
if(isset($_SESSION['logged_in'])){

    header('location: account.php');
    exit();

}


//if user is not logged in
if(isset($_POST['register'])){


    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];


    // Check if passwords do not match
    if($password != $confirmPassword){ 
        header('location: register.php?error=passwords do not match');
    }


    // Check if password is less than 6 characters long
    else if(strlen($password) < 6){  
        header('location: register.php?error=password must be at least 6 characters long');
    }


    // If there is no error
    else{


        // Check if the email already exists in the database
        $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email = ?"); 
        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->store_result();
        $stmt1->fetch();



        // If the email already exists
        if($num_rows > 0){
            header('location: register.php?error=user with this email already exists');
        }



        // Insert user info into the users table
        else{

            $hashed_password = md5($password);

            $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?,?,?)");
            $stmt->bind_param('sss', $name, $email, $hashed_password); 


            // If the query is successful
            if($stmt->execute()){ 
                $user_id = $stmt->insert_id; // Get the auto-generated order ID
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                header('location: account.php?register=You registered successfully');
            }else{
                header('location: register.php?error=could not create account at the moment, try again later');
            }
        }
    }


}

?>




<?php include('layouts/header.php'); ?>



    <!--Register-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Register</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="register-form" method="POST" action="register.php">
                <?php if(isset($_GET['error'])){?>
                    <p style="color: red;"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="register-email" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="register-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="register" class="btn" id="register-btn" value="Register">
                </div>
                <div class="form-group">
                    <a id="login-url" class="btn" href="login.php">Do you have an account ? Login</a>
                </div>
            </form>
        </div>
    </section>


        
<?php include('layouts/footer.php'); ?>