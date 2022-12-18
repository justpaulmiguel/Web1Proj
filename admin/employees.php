<?php
$title = 'Employees';

require("partials/head.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require("./queryHandler/postEmployees.php");
}




// Read all the employees and admin
$employees = [];
$result = require("./queryHandler/getEmployees.php");

?>

<main>
    <h1>Employees</h1>
    <section>
        <div class="section-content">
            <h2>Employee List</h2>
            <ul class="employee-list no-list-style">
                <?php foreach ($employees as $employee) : ?>
                    <div class="emp-wrapper">
                        <div class="img-wrapper">
                            <span><?= $employee['lname'][0] ?></span>
                        </div>
                        <div class="emp-details">
                            <p><?= $employee['lname'] . ", " .  $employee['fname']; ?> </p>
                            <div class="emp-bottom">
                                <p class="
                                <?= $employee["permissionLvl"] == 1
                                    ? "emp-text" : "admin-text" ?>
                                "><?= $employee["permissionLvl"] == 1
                                        ? "Employee" : "Administrator"   ?></p>
                                <p><?= $employee["email"] ?></p>
                            </div>
                        </div>


                    </div>
                <?php endforeach; ?>
            </ul>

        </div>

    </section>


    <?php if ($_SESSION["permissionLvl"] == 2) : // Gets seen when permission level is admin level 
    ?>
        <section>
            <div class="section-content">
                <section class="employee-edit-btns-wrapper">
                    <h3>Manage Employees</h3>
                    <button class="btn add-btn" id="add-employee-btn">Add New</button>
                    <button class="btn remove-selected-btn" id="remove-employee-btn">Delete</button>
                </section>
            </div>
        </section>

    <?php endif; ?>
</main>


<?php require("partials/footer.php"); ?>