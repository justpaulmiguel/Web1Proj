<?php

$currentPass = $_POST['currentPassword'];
$newPass = $_POST["newPassword"];
$confirmNewPass = $_POST["confirmNewPassword"];

$willUpdate = true;
// post values validation
if (
    strlen($currentPass) == 0
    || strlen($newPass) == 0
    || strlen($confirmNewPass) == 0
) {

    echo showModalError("Incomplete details");
    $willUpdate = false;
}

// check if password is the same
if (strcmp($newPass, $confirmNewPass) != 0) {
    echo  showModalError("New passwords are not the same!");
    $willUpdate = false;
}

if ($willUpdate) {
    require('../php/dbConnect.php');
    $query = sprintf("SELECT password FROM accounts WHERE email='%s' LIMIT 1;", $_SESSION['email']);
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) <= 0) {
        echo showModalError("SQL Error");
    } else {

        $passHash = mysqli_fetch_array($result)[0];
        // checks db password before updating
        if (!password_verify(
            $currentPass,
            $passHash
        )) {
            echo showModalError("Entered current password is incorrect.");
        } else {
            $passHash = password_hash($newPass, PASSWORD_DEFAULT);
            // perform changing of password
            $query = sprintf(
                "UPDATE  accounts SET password='%s' WHERE email='%s' LIMIT 1;",
                $passHash,
                $_SESSION['email']
            );
            if (mysqli_query($conn, $query)) {
                echo showModalSuccess("Password updated successfully!");
            } else {
                echo showModalError("Error updating of Password");
            }
            mysqli_close($conn);
        }
    }
}
