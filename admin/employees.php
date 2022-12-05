<?php


require("partials/head.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $willUpdate = true;
    // insert logic here
    if (empty($_POST['email']) || empty($_POST['type'])) {
        echo showModalError("Email is not set!");
        $willUpdate = false;
    }


    if ($willUpdate) {
        require('../php/dbConnect.php');
        $query = sprintf("UPDATE accounts SET permissionLvl='%u' WHERE email='%s' LIMIT 1;", 2, $_POST['email']);
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <= 0) {
            echo showModalError("SQL Error");
        } else {
            echo showModalSuccess("Email successfully added!");

            header("Refresh:3");
        }
        mysqli_close($conn);
    }
}

?>

<main>
    <h1>Employees</h1>
    <section class="employees-wrapper">
        <!-- gets for looped later -->

        <?php
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
                echo '
                    <div class="emp-wrapper">
                        <div class="img-wrapper">
                            <span>J</span>
                        </div>
                        <p>' . $row['fname'] . ' ' . $row['lname'] . ' </p>
                        <p>'  . $row['email'] .   '</p>
                    </div>
                ';
            }
        }
        mysqli_close($conn);


        ?>
    </section>


    <?php if ($_SESSION["permissionLvl"] == 2) : ?>
        <!-- // Gets seen when permission level is admin level -->
        <section class="employee-edit-btns-wrapper">
            <button class="btn" id="add-employee-btn">Add New</button>

            <button class="btn remove-selected-btn" id="remove-employee-btn">Delete</button>
            <!-- TODO add modal for add new employee later  -->
            <!-- todo add functionlity for the delete button later. (something like a radio btn) -->
        </section>

    <?php endif; ?>
</main>


<?php require("partials/footer.php") ?>