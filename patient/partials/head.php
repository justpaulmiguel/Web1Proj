<?php
//CHECKS FOR LOGIN SESSION
session_start();
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"]) && !isset($_SESSION["permissionLvl"])) {
    header('Location: ../index.php');
    exit();
}
if ($_SESSION["permissionLvl"] > 0) {
    header("Location: ../admin/dashboard.php");
    exit();
}
require("../php/functions.php");
require_once('../php/updateAcceptedState.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- page icon -->
    <link rel="icon" type="image/x-icon" href="../../logo.ico">
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;800&family=Poppins:ital,wght@0,400;0,700;0,800;1,400&family=Raleway&display=swap" rel="stylesheet" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="bootstrap\bootstrap.min.css" />
    <script src="bootstrap\bootstrap.min.js"></script>
    <!-- Asset CSS -->
    <link rel="stylesheet" href="asset/user_styles.css" />
    <!-- Modal Library -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title><?= $title ?></title>

</head>

<body>
    <!---------------------------------------------------Top Bar Start------------------------------------------------------>
    <header>
        <div class="menu-wrapper">
            <span class="material-icons" id="menu-icon"> menu </span>
        </div>
        <div class="header-title">
            <div class="logo footer-place-holder-logo">
                <img src="../logo.png" alt="logo">

            </div>
            <p class="title-text">Joseph Galang Dental Clinic</p>
        </div>

    </header>
    <!---------------------------------------------------Top Bar End------------------------------------------------------>

    <?php require("sidebar.php") ?>
    <div class="side-content">
        <div class="wave-container">