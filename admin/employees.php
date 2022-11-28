<?php require("partials/head.php") ?>


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
    <section class="employee-edit-btns-wrapper">
        <button class="btn">Add New</button>

        <button class="btn remove-selected-btn">Delete</button>
        <!-- TODO add modal for add new employee later  -->
        <!-- todo add functionlity for the delete button later. (something like a radio btn) -->
    </section>
</main>


<?php require("partials/footer.php") ?>