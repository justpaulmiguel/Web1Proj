<?php


require("partials/head.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // insert logic here

}

?>

<main>
    <h1>Employees</h1>
    <section class="employees-wrapper">
        <!-- gets for looped later -->
        <div class="emp-wrapper">
            <div class="img-wrapper">
                <span>J</span>
            </div>
            <p>Joseph Galang</p>
            <p>josephGalang@gmail.com</p>
        </div>
        <div class="emp-wrapper">
            <div class="img-wrapper">
                <span>P</span>
            </div>
            <p>Paul Miguel</p>
            <p>paulMiguelMapagmahal@gmail.com</p>
        </div>
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