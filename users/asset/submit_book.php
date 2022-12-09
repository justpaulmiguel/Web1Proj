<?php
session_start();
if (isset($_SESSION["service"]) && isset($_SESSION["branch"]) && isset($_SESSION["date"])) {
    $service = $_SESSION["service"];
    $branch = $_SESSION["branch"];
    $date = $_SESSION["date"];
    $time = $_POST["datetime"];
} else {
    header("Location: ../book_service.php"); 
}

$_SESSION["submit"] = true;

require("../../php/dbConnect.php");

$email = $_SESSION["email"];

$query = "SELECT account_info.account_ID FROM account_info WHERE email='$email'";
$result = mysqli_query($conn, $query);
$value = mysqli_fetch_array($result);
$id = $value['account_ID'];

$query = "INSERT INTO bookings (bookings.account_ID, bookings.service, bookings.date, bookings.time, bookings.state, bookings.branch) VALUES ('$id', '$service', '$date', '$time', 'pending', '$branch')";

mysqli_query($conn, $query);

mysqli_close($conn);

header("Location: ../dashboard.php");
exit; 
?>