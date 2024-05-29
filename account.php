<?php

session_start();

include 'server/connection.php';

class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function logout() {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        header('location: login.php');
        exit();
    }

    public function changePassword($password, $confirmPassword, $user_email) {
        if ($password != $confirmPassword) {
            header('location: account.php?error=passwords do not match');
        } else if (strlen($password) < 6) {
            header('location: account.php?error=password must be at least 6 characters long');
        } else {
            $password = md5($password);
            $stmt = $this->conn->prepare("UPDATE users SET user_password = ? WHERE user_email = ?");
            $stmt->bind_param('si', $password, $user_email);

            if ($stmt->execute()) {
                header('location: account.php?message=password changed successfully');
            } else {
                header('location: account.php?error=error changing password');
            }
        }
    }
}

class Order {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserOrders($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE user_id=?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }
}

// Initialize user and order objects
$user = new User($conn);
$order = new Order($conn);

// Check if user is logged in
if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit();
}

// Process logout request
if (isset($_GET['logout'])) {
    $user->logout();
}

// Process change password request
if (isset($_POST['change_password'])) {
    $user->changePassword($_POST['password'], $_POST['confirmPassword'], $_SESSION['user_email']);
}

// Get user orders
$user_id = $_SESSION['user_id'];
$orders = $order->getUserOrders($user_id);

include('layouts/header.php');

?>



    <!--Account-->
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <?php if(isset($_GET['register'])){?>
                <p class="text-center pt-3" style="color: green;"><?php echo $_GET['register']; ?></p>
            <?php } ?>
            <?php if(isset($_GET['login'])){?>
                <p class="text-center pt-3" style="color: green;"><?php echo $_GET['login']; ?></p>
            <?php } ?>
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
                <h3 class="font-weight-bold">Account info</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Name : <span><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}?></span></p>
                    <p>Email : <span><?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email'];}?></span></p>
                    <p><a href="#orders" id="orders-btn">Your orders</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                </div>
            </div>
            <div class="mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
                <form method="POST" action="account.php" id="account-form">
                <?php if(isset($_GET['error'])){?>
                    <p style="color: red;"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <?php if(isset($_GET['message'])){?>
                    <p style="color: green;"><?php echo $_GET['message']; ?></p>
                    <?php } ?>
                    <h3>Change Password</h3>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="account-password" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="account-password-confirm" placeholder="Confirm Password" name="confirmPassword" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Change Password" class="btn" name="change_password" id="change-pass-btn">
                    </div>
                </form>
            </div>
        </div>
    </section>





    <!--Orders-->
    <section id="orders" class="orders container my-5 py-5" class="">
        <div class="container text-center">
            <h2 class="font-weight-bold">Your Orders</h2>
            <hr class="mx-auto">
        </div>

        <table class="mt-5 pt-5 text-center">
            <tr>
                <th>Order Id</th>
                <th>Order Cost</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>Order Details</th>
            </tr>

            <?php while($row = $orders->fetch_assoc()){?>

            <tr>
                <td>
                    <div class="product-info">
                        <div>
                            <p class="mt-3 mx-auto"><?php echo $row['order_id'];?></p>
                        </div>
                    </div>
                </td>

                <td><span><?php echo $row['order_cost'];?></span></td>
                <td><span><?php echo $row['order_status'];?></span></td>
                <td><span><?php echo $row['order_date'];?></span></td>
                <td>
                    <form action="order_details.php" method="POST">
                    <input type="hidden" name="order_id" value="<?php echo $row['order_id'];?>">
                    <input type="hidden" name="order_status" value="<?php echo $row['order_status'];?>">
                        <input class="btn order-details-btn" type="submit" name="order_details_btn" value="details">
                    </form>
                <td>

            </tr>

            <?php } ?>

        </table>

    </section>





<?php include('layouts/footer.php'); ?>