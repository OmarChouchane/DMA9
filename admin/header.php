<?php 

session_start();

if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit();
}

include '../server/connection.php';


?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">


    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="dashboard.css">
    <title>The North Face</title>
    <link rel="icon" href="../assets/imgs/logo22.png" type="image/x-icon">
</head>
<body id="body-pd" class="body-pd">




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