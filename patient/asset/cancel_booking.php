<?php

session_start();

require("../../php/dbConnect.php");

$bookingID = $_SESSION["bookingID"];

$query = "UPDATE bookings SET bookings.state = 'cancelled' WHERE bookings.booking_ID = '$bookingID'";
mysqli_query($conn, $query);
    
header("Location: ../dashboard.php");

?>