<?php
$title = 'Employees';

require("partials/head.php");

// TODO refactor later
// todo Add modal if email is already an employee


$employees = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $willUpdate = true;
    // insert logic here
    if (empty($_POST['email']) || empty($_POST['type'])) {
        echo showModalError("Email is not set!");
        $willUpdate = false;
    }

    // Check if email exists
    require('../php/dbConnect.php');
    $query = sprintf("SELECT email FROM accounts WHERE email='%s' LIMIT 1;", $_POST['email']);
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) <= 0) {
        echo showModalError("No account with that email found.");
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
            $query = sprintf("UPDATE accounts SET permissionLvl='%u' WHERE email='%s' LIMIT 1;", 0, $_POST['email']);
            $isQuerySuccessful = mysqli_query($conn, $query);

            if (!$isQuerySuccessful) {
                echo showModalError("SQL Error");
            } else {
                echo showModalSuccess("Email successfully removed!. Page will get refreshed");
            }
        }
        mysqli_close($conn);
    }
}

// Read all the employees and admin

$query = "SELECT accounts.permissionLvl,
account_info.email, account_info.lname,account_info.fname
FROM accounts
INNER JOIN account_info
ON accounts.email = account_info.email
WHERE accounts.permissionLvl >0;

";
require("../php/dbConnect.php");
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) <= 0) {
    echo showModalError("Can't Retrieve Emails");
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($employees, $row);
    }
}
mysqli_close($conn);
?>

<main>
    <h1>Employees</h1>
    <section class="employees-wrapper">

        <?php foreach ($employees as $employee) : ?>
            <div class="emp-wrapper">
                <div class="img-wrapper">
                    <span><?= $employee['lname'][0] ?></span>
                </div>

                <p><?= $employee['lname'] . " " .  $employee['fname']; ?> </p>
                <p><?= $employee["email"] ?></p>
                <p><?= $employee["permissionLvl"] == 1
                        ? "employee" : "administrator"   ?></p>
            </div>
        <?php endforeach; ?>
    </section>


    <?php if ($_SESSION["permissionLvl"] == 2) : ?>
        <!-- // Gets seen when permission level is admin level -->
        <section class="employee-edit-btns-wrapper">
            <button class="btn" id="add-employee-btn">Add New</button>
            <button class="btn remove-selected-btn" id="remove-employee-btn">Delete</button>
        </section>

    <?php endif; ?>
</main>


<?php require("partials/footer.php"); ?>