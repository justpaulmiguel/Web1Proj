<?php
// Requires session details before accessing admin pages
// todo might add redirection info


# CHECKS IF AN ACCOUNT IS ALREADY LOGGED IN
session_start();
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"]) && !isset($_SESSION["permissionLvl"])) {


    header('Location: ../index.php');
    exit();
}
// todo fix later
// if ($_SESSION["permissionLvl"] !== 2) {
//     // header("Location: ../users/user.php");

//     echo "<script>alert(" . $_SESSION["permissionLvl"] . ")</script>";
//     echo $_SESSION["permissionLvl"];
// }

require("../php/functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;800&family=Poppins:ital,wght@0,400;0,700;0,800;1,400&family=Raleway&display=swap" rel="stylesheet" />

    <!-- css styles -->
    <link rel="stylesheet" href="assets/style.css">
    <!-- Modal Library -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>

    <!---------------------------------------------------Top Bar Start------------------------------------------------------>

    <header>
        <div class="header-title">
            <div class="logo footer-place-holder-logo"><span>L</span></div>
            <p class="title-text">Joseph Galang Dental Clinic</p>
        </div>
        <div class="split">
            <span class="material-icons" id="menu-icon"> menu </span>
        </div>
    </header>
    <!---------------------------------------------------Top Bar End------------------------------------------------------>

    <?php require("sidebar.php") ?>
    <div class="side-content">