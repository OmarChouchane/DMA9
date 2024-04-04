<?php

session_start();

include 'server/connection.php';

class RegistrationHandler {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registerUser($name, $email, $password, $confirmPassword) {
        // Check if passwords do not match
        if ($password != $confirmPassword) {
            header('location: register.php?error=passwords_do_not_match');
            exit();
        } elseif (strlen($password) < 6) {
            // Check if password is less than 6 characters long
            header('location: register.php?error=password_must_be_at_least_6_characters_long');
            exit();
        } else {
            // Check if the email already exists in the database
            $stmt1 = $this->conn->prepare("SELECT count(*) FROM users WHERE user_email = ?");
            $stmt1->bind_param('s', $email);
            $stmt1->execute();
            $stmt1->bind_result($num_rows);
            $stmt1->store_result();
            $stmt1->fetch();

            // If the email already exists
            if ($num_rows > 0) {
                header('location: register.php?error=user_with_this_email_already_exists');
                exit();
            } else {
                $hashed_password = md5($password);
                $stmt = $this->conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?,?,?)");
                $stmt->bind_param('sss', $name, $email, $hashed_password);

                // If the query is successful
                if ($stmt->execute()) {
                    $user_id = $stmt->insert_id; // Get the auto-generated user ID
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_name'] = $name;
                    $_SESSION['logged_in'] = true;
                    header('location: account.php?register=You_registered_successfully');
                    exit();
                } else {
                    header('location: register.php?error=could_not_create_account_at_the_moment_try_again_later');
                    exit();
                }
            }
        }
    }
}

// Check if user is already logged in
if (isset($_SESSION['logged_in'])) {
    header('location: account.php');
    exit();
}

// Check if user is not logged in and registration form is submitted
if (isset($_POST['register'])) {
    $registrationHandler = new RegistrationHandler($conn);
    $registrationHandler->registerUser($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirmPassword']);
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