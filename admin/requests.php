<?php require("partials/head.php") ?>


<main>
    <h1>Requests</h1>
    <form id="patient-requests-form" action="/path/to/db" method="get">

        <table border="2" cellpadding="10" cellspacing="1">
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th colspan="2">Name</th>
                <th>Service</th>
                <th>Doctor</th>
                <th>Checkbox</th>
            </tr>

            <tr align="center" class="patient-req-row">
                <td>09/01/2022</td>
                <td>9:00AM - 9:30PM</td>
                <td>Squarepants</td>
                <td>Spongebob</td>
                <td>Oral Propalaxyis</td>
                <td>Joseph Joestar</td>
                <td>
                    <input type="checkbox" value="id or somethis" name="patient" id="input-id1" data-id="patient-id">
                </td>
            </tr>


            <tr align="center" class="patient-req-row">
                <td>09/01/2022</td>
                <td>9:00AM - 9:30PM</td>
                <td>Squarepants</td>
                <td>Spongebob</td>
                <td>Oral Propalaxyis</td>
                <td>Joseph Joestar</td>
                <td>
                    <input type="checkbox" value="id or somethis" name="patient" id="input-id1" data-id="patient-id">
                </td>
            </tr>


            <tr align="center" class="patient-req-row">
                <td>09/01/2022</td>
                <td>9:00AM - 9:30PM</td>
                <td>Suarepants</td>
                <td>Spongebob</td>
                <td>Oral Propalaxyis</td>
                <td>Joseph Joestar</td>

                <td>
                    <input type="checkbox" value="id or somethis" name="patient" id="input-id3" data-id="patient-id">
                </td>
            </tr>


            <tr align="center" class="patient-req-row">
                <td>09/01/2022</td>
                <td>9:00AM - 9:30PM</td>
                <td>Squarepants</td>
                <td>Spongebob</td>
                <td>Oral Propalaxyis</td>
                <td>Joseph Joestar</td>

                <td>
                    <input type="checkbox" value="id or somethis" name="patient" id="input-id1" data-id="patient-id">
                </td>
            </tr>


            <tr align="center" class="patient-req-row">
                <td>09/01/2022</td>
                <td>9:00AM - 9:30PM</td>
                <td>Squarepants</td>
                <td>Spongebob</td>
                <td>Oral Propalaxyis</td>
                <td>Joseph Joestar</td>

                <td>
                    <input type="checkbox" value="id or somethis" name="patient" id="input-id1" data-id="patient-id">
                </td>
            </tr>


            <tr align="center" class="patient-req-row">
                <td>09/01/2022</td>
                <td>9:00AM - 9:30PM</td>
                <td>Squarepants</td>
                <td>Spongebob</td>
                <td>Oral Propalaxyis</td>
                <td>Joseph Joestar</td>

                <td>
                    <input type="checkbox" value="id or somethis" name="patient" id="input-id1" data-id="patient-id">
                </td>
            </tr>

        </table>
        <button value="accept" name="type" class="btn ">Accept</button>
        <button value="decline" name="type" class="btn remove-selected-btn">Decline</button>
        <!-- todo disable buttons when theres no marked -->
    </form>
</main>


<?php require("partials/footer.php") ?>