<?php


$query = "";

require("../php/dbConnect.php");

if (isset($_POST['missed'])) {
    $id = $_POST['missed'];
    $note = $_POST['declineReason'];
    $query = sprintf("UPDATE  bookings SET state='declined',
     note='%s' WHERE booking_ID='%s' ;", $note, $id);

    if (mysqli_query($conn, $query)) {
        echo showModalSuccess('Cancelled successfully!');
    } else {
        echo showModalError("SQL Error");
    }
} else if (isset($_POST['completed'])) {
    $id = $_POST['completed'];
    $query = sprintf("UPDATE  bookings SET state='completed' 
    WHERE booking_ID='%s' ;", $id);

    if (mysqli_query($conn, $query)) {
        echo showModalSuccess('Completed successfully!');
    } else {
        echo showModalError("SQL Error");
    }
}
mysqli_close($conn);
