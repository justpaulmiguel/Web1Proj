<?php require("partials/head.php") ?>


<main>
    <h1>Past Records</h1>
    <p>Lorem ipsum dolor sit amet </p>


    <form action="">
        <select name="filters" id="filters">
            <option value="select" selected disabled>Select a Filter</option>
            <option value="state">State</option>
            <option value="date">Date</option>
            <option value="service">Service</option>
            <option value="email">Email</option>
        </select>

        <br>
        <select name="stateFilters" id="stateFilters">
            <option value="selectState" selected disabled>Select a State</option>
            <option value="stateCompleted">Completed</option>
            <option value="stateDeclined">Date</option>
            <option value="stateCancelled">Service</option>
        </select>

        <br>
        <label for="dateFilter">Select Date</label>
        <input type="date" id="dateFilter" name="dateFilter">

        <br>
        <select name="serviceFilters" id="serviceFilters">
            <option value="selectService" selected disabled>Select a Service</option>
            <option value="cleaning">Cleaning</option>
            <option value="dentalCrown">Dental Crown</option>
            <option value="wisdomTExtract">Wisdom Tooth Extraction</option>
        </select>

        <br>
        <label for="emailFilter">Input Email</label>
        <input type="email" placeholder="email" name="emailFilter" id="emailFilter">

        <br>
        <input type="submit" value="Log In">
    </form>
</main>


<?php require("partials/footer.php") ?>