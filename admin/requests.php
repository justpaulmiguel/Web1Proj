<?php require("partials/head.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
}

$pendingRequests = [];

$query = "SELECT  bookings.account_id ,	bookings.booking_ID,bookings.service,bookings.date,bookings.time,
bookings.state,bookings.branch, account_info.fname,account_info.lname FROM bookings
INNER JOIN account_info
ON bookings.account_id = account_info.account_id
 WHERE state='pending'";

require("../php/dbConnect.php");
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) <= 0) {
    echo showModalError("Can't Retrieve Emails");
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($pendingRequests, $row);
    }
}
mysqli_close($conn);

?>


<main>
    <h1>Requests</h1>
    <form id="patient-requests-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" value="hello" name="hello">
        <table border="2" cellpadding="10" cellspacing="1">
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th colspan="2">Name</th>
                <th>Service</th>
                <th>Checkbox</th>
            </tr>
            <?php foreach ($pendingRequests as $pending) : ?>
                <tr align="center" class="patient-req-row">
                    <td><?= $pending['date'] ?></td>
                    <td><?= $pending['time'] ?></td>
                    <td><?= $pending['lname'] ?></td>
                    <td><?= $pending['fname'] ?></td>
                    <td><?= $pending['service'] ?></td>
                    <!-- <td>9:00AM - 9:30PM</td>
                    <td>Squarepants</td>
                    <td>Spongebob</td>
                    <td>Oral Propalaxyis</td> -->
                    <td>
                        <input type="checkbox" value="<?= $pending['booking_id'] ?>" name="patientId[]">
                    </td>
                </tr>

            <?php endforeach; ?>




        </table>

        <!-- todo have form event handler, add modal before continue -->
        <input value="accept" name="type" class="" type="radio" checked>Accept</input>
        <input value="decline" name="type" class="" type="radio">Decline</input>
        <button class="btn " type="submit">Submit</button>
        <!-- todo disable buttons when theres no marked -->
    </form>

</main>


<?php require("partials/footer.php") ?>