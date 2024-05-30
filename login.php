<?php

session_start();

include 'server/connection.php';

class LoginHandler {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function loginUser($email, $password) {
        $password = md5($password);
        $stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");
        $stmt->bind_param('ss', $email, $password);

        if ($stmt->execute()) {
            $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
            $stmt->store_result();

            if ($stmt->num_rows() == 1) {
                $stmt->fetch();
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['logged_in'] = true;
                header('location: account.php?login=You logged in successfully');
                exit();
            } else {
                return 'invalid email or password';
            }
        } else {
            return 'something went wrong, try again later';
        }
    }
}

// Check if user is already logged in
if (isset($_SESSION['logged_in'])) {
    header('location: account.php');
    exit();
}

// Check if user is not logged in and login form is submitted
if (isset($_POST['login_btn'])) {
    $loginHandler = new LoginHandler($conn);
    $error = $loginHandler->loginUser($_POST['email'], $_POST['password']);
    if ($error) {
        header('location: login.php?error=' . $error);
        exit();
    }
}

?>

<?php include('layouts/header.php'); ?>

<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Login</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="login-form" action="login.php" method="POST">
            <?php if (isset($_GET['error'])) { ?>
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
            <div class="form-group">
                <a id="register-url" class="btn" href="register.php">Don't have an account? Register</a>
            </div>
        </form>
    </div>
</section>

<?php include('layouts/footer.php'); ?>
