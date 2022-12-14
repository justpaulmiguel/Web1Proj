<?php
session_start();

require("../php/dbConnect.php");
if (isset($_REQUEST['completed'])) {

	$bookID1 = $_POST["completed"];
	$query2 = "UPDATE `bookings` SET `state` = 'completed' WHERE booking_ID='$bookID1'";
	$result2 = mysqli_query($conn, $query2);
	mysqli_query($conn, $query2);
	mysqli_close($conn);
	$_SESSION['flash_message'] = "Update Successful. Appointment is complete.";
} else if (isset($_REQUEST['missed'])) {

	$bookID1 = $_POST["missed"];
	$query2 = "UPDATE `bookings` SET state` = 'cancelled',`note` = 'Did not show up' WHERE booking_ID='$bookID1'";
	$result2 = mysqli_query($conn, $query2);
	mysqli_query($conn, $query2);
	mysqli_close($conn);
	$_SESSION['flash_message'] = "Update Successful. Appointment is cancelled.";
} else {
	$_SESSION['flash_message'] = "Update Unsucessful";
}

header("refresh: 0; url=dashboard.php");
