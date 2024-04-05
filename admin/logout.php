<?php

session_start();


if(isset($_GET['logout']) && $_GET['logout'] == 1 ){
    unset($_SESSION['admin_logged_in']);
    unset($_SESSION['admin_user_id']);
    unset($_SESSION['admin_user_name']);
    unset($_SESSION['admin_user_email']);
    header('location: login.php');
    exit();
}

?>