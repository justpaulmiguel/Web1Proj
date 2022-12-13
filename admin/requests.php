<?php
$title = 'Pending Requests';
require("partials/head.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // todo add validation
    // todo add condition if no patientId
    $state = $_POST['requestType'] == 'accepted' ? 'accepted' : 'declined';
    $query = "";
    if (!empty($_POST['patientId'])) {
        require("../php/dbConnect.php");
        $query = '';
        if ($state == 'declined') {
            $note = $_POST['declineReason'];
            foreach ($_POST['patientId'] as $id) {
                $query .= sprintf("UPDATE  bookings SET state='%s', note='%s' WHERE booking_id='%s' ;", $state, $note, $id);
            }
        } else {
            foreach ($_POST['patientId'] as $id) {
                $query .= sprintf("UPDATE  bookings SET state='%s' WHERE booking_id='%s' ;", $state, $id);
            }
        }

        if (mysqli_multi_query($conn, $query)) {
            echo showModalSuccess($state == 'accepted' ?  "Accepted successfully" : 'Declined successfully');
        } else {
            echo showModalError("SQL Error");
        }
        mysqli_close($conn);
    }
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
    $pendingRequests = [];
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($pendingRequests, $row);
    }
}
mysqli_close($conn);

?>


<main>
    <h1>Requests</h1>

    <?php if (empty($pendingRequests)) : ?>
        <h2>You have no pending requests!</h2>
    <?php else : ?>
        <form id="patient-requests-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

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
                        <td><?= $pending['date']; ?></td>
                        <td><?= $pending['time']; ?></td>
                        <td><?= $pending['lname']; ?></td>
                        <td><?= $pending['fname']; ?></td>
                        <td><?= $pending['service']; ?></td>
                        <td>
                            <input type="checkbox" value="<?= $pending['booking_ID']; ?>" name="patientId[]">
                        </td>
                    </tr>


                <?php endforeach; ?>
            </table>

            <label for="accept-radio">
                <input value="accepted" name="requestType" class="" type="radio" checked id="accept-radio" />
                Accept
            </label>
            <label for="decline-radio">
                <input value="declined" name="requestType" class="" type="radio" id="decline-radio" />
                Decline
            </label>
            <button class="btn form-submit" type="submit">Submit</button>
        </form>
    <?php endif ?>











</main>


<?php require("partials/footer.php") ?>