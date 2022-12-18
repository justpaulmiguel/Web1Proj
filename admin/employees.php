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


    <?php if ($_SESSION["permissionLvl"] == 2) : // Gets seen when permission level is admin level 
    ?>
        <section>
            <div class="section-content">
                <section class="employee-edit-btns-wrapper">
                    <h3>Manage Employees</h3>
                    <button class="btn add-btn" id="add-employee-btn">Add New </button>
                    <button class="btn remove-selected-btn" id="remove-employee-btn">Remove</button>
                </section>
            </div>
        </section>

    <?php endif; ?>


    <section>
        <div class="section-content emp-container">
            <h2>Employee List</h2>
            <div class="table-container">
                <table class="emp-table">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Job</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $employee) : ?>
                            <tr>
                                <td><?= $employee['account_ID'] ?></td>
                                <td><?= $employee['fname'] . " " . $employee['lname']; ?></td>
                                <td>
                                    <p class="
                                        <?= $employee["permissionLvl"] == 1
                                            ? "emp-text" : "admin-text" ?>
                                        ">
                                        <?= $employee["permissionLvl"] == 1
                                            ? "Employee" : "Administrator"   ?>
                                    </p>
                                </td>
                                <td>
                                    <p><?= $employee["email"] ?></p>

                                </td>
                                <td>
                                    <p>0<?= $employee["contactNo"] ?></p>

                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>

    </section>



</main>


<?php require("partials/footer.php"); ?>