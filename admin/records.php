<?php
$title = 'Past Records';


// todo add values to db
// todo work on the  logic

?>



<main>
    <h1>Past Records</h1>
    <p>Search our records.</p>



    <form action="" id="search-record-form">

        <select name="branch" id="branch" required>
            <option value="" disabled>Select a Filter</option>
            <option value="all" selected>All Branches</option>
            <option value="san simon">San Simon, Pampanga</option>
            <option value="mexico">Mexico, Pampanga</option>
        </select>

        <select name="filter" id="filter-select" required>
            <option value="" disabled>Select a Filter</option>
            <option value="date" selected>From Date</option>
            <option value="state">Appointment State</option>
            <option value="service">Service</option>
            <option value="email">Email</option>

        </select>

        <select name="sort" id="sort" required>
            <!-- <option value="select" selected disabled>Select a Filter</option> -->
            <option value="" disabled>Sort by</option>
            <option value="0" selected>Newest</option>
            <option value="1">Oldest</option>

        </select>



        <input type="submit" id="search-btn" value="Search">
    </form>
</main>


<?php require("partials/footer.php") ?>