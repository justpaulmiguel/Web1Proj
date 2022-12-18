<?php


$willUpdate = true;
if (empty($_POST['email']) || empty($_POST['type'])) {
    echo showModalError("Email is not set!");
    $willUpdate = false;
}

require('../php/dbConnect.php');
$query = sprintf("SELECT email, permissionLvl FROM accounts WHERE email='%s' LIMIT 1;", $_POST['email']);
$result = mysqli_query($conn, $query);



// Check if email exists
if (mysqli_num_rows($result) <= 0) {
    echo showModalError("No account with that email found.");
    $willUpdate = false;
} else if ((int)mysqli_fetch_assoc($result)['permissionLvl'] > 0) {
    // Check if account is already an employee
    echo showModalError("Account is already an employee!");
    $willUpdate = false;
}
mysqli_close($conn);


// will run if details are all valid
if ($willUpdate) {
    require('../php/dbConnect.php');
    // Updates the permission lvl of an account depending of the button type

    if ($_POST['type'] === 'add') {
        $query = sprintf("UPDATE accounts SET permissionLvl='%u' WHERE email='%s' LIMIT 1;", 1, $_POST['email']);
        $isQuerySuccessful = mysqli_query($conn, $query);
        if (!$isQuerySuccessful) {
            echo showModalError("SQL Error");
        } else {
            echo showModalSuccess("Email successfully added!. Page will get refreshed");
        }
    } else if ($_POST['type'] === 'remove') {
        if ($_SESSION['permissionLvl'] == 2) {
            mysqli_close($conn);
            echo showModalError("Administrator Access should not be removed.");
        } else {
            $query = sprintf("UPDATE accounts SET permissionLvl='%u' WHERE email='%s' LIMIT 1;", 0, $_POST['email']);
            $isQuerySuccessful = mysqli_query($conn, $query);

            if (!$isQuerySuccessful) {
                echo showModalError("SQL Error");
            } else {
                echo showModalSuccess("Email successfully removed!. Page will get refreshed");
            }
        }
    }
    mysqli_close($conn);
}
