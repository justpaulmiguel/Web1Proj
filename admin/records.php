<?php
$title = 'Past Records';


// todo add script to buttons
// todo defaults to date 

?>



<main>
    <h1>Past Records</h1>
    <p>Lorem ipsum dolor sit amet </p>


    <form action="">
        <p>Search our records.</p>

        <select name="branch" id="branch" required>
            <option value="" disabled>Select a Filter</option>
            <option value="all" selected>All Branches</option>
            <option value="san simon">San Simon, Pampanga</option>
            <option value="mexico">Mexico, Pampanga</option>
        </select>

        <select name="filter" id="filters" required>
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


        <select name="stateFilters" id="stateFilters">
            <option value="selectState" selected disabled>Select a State</option>
            <option value="completed">Completed</option>
            <option value="declined">Date</option>
            <option value="cancelled">Service</option>
        </select>

        <label for="dateFilter">Select Date</label>
        <input type="date" id="dateFilter" name="dateFilter">

        <select name="serviceFilters" id="serviceFilters">
            <option value="selectService" selected disabled>Select a Service</option>
            <option value="cleaning">Cleaning</option>
            <option value="dentalCrown">Dental Crown</option>
            <option value="wisdomTExtract">Wisdom Tooth Extraction</option>
        </select>

        <label for="emailFilter">Input Email</label>
        <input type="email" placeholder="email" name="emailFilter" id="emailFilter">

        <input type="submit" value="Search">
    </form>
</main>


<?php require("partials/footer.php") ?>