<?php

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$contactNum = $_POST['contactNo'];

$willUpdate = true;
// Input validation
if (strlen($fname) == 0 || strlen($lname) == 0  || strlen($contactNum) == 0) {
    echo showModalError("Incorrect Credentials. Please fix details before trying again.");
    $willUpdate = false;
}
if ($willUpdate) {
    require("../php/dbConnect.php");
    $query = sprintf(
        "UPDATE  account_info SET lname='%s' , fname='%s', contactNo='%u' WHERE email='%s'; ",
        trim($lname),
        trim($fname),
        trim($contactNum),
        $_SESSION['email']
    );
    if (mysqli_query($conn, $query)) {
        echo showModalSuccess("Account details updated successfully!");
    } else {
        echo showModalError("Error Account update");
    }
    mysqli_close($conn);
}
