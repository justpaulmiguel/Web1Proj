<?php
$title = 'Pending Requests';
require("partials/head.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require("./queryHandler/postRequests.php");
}

$pendingRequests = [];
require("./queryHandler/getRequests.php");

?>


<main>
    <h1>Requests</h1>

    <div class="section-content">
        <?php if (empty($pendingRequests)) : ?>
            <h2>You have no pending requests!</h2>
        <?php else : ?>
            <form id="patient-requests-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="table-container req-table-wrapper">
                    <table cellpadding="10" cellspacing="1">
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Branch</th>
                            <th>Name</th>
                            <th>Service</th>
                            <th>Booking ID</th>
                            <th>Status</th>
                        </tr>
                        <?php foreach ($pendingRequests as $pending) : ?>
                            <tr class="patient-req-row">
                                <td><?= $pending['date']; ?></td>
                                <td><?= $pending['time']; ?></td>
                                <td><?= getBranchName($pending['branch']); ?></td>
                                <td><?= $pending['name']; ?></td>
                                <td><?= getServiceName($pending['service']); ?></td>
                                <td><?= $pending['booking_ID']; ?></td>
                                <td>

                                    <div class="req-btn-container">
                                        <button class='form-btn accept-btn  btn btn-outline-primary' type='button' value='<?= $pending['booking_ID'] ?>'>Accept</button>
                                        <button class='form-btn decline-btn btn btn-outline-danger' type='button' value='<?= $pending['booking_ID']  ?>'>Decline</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

            </form>
        <?php endif ?>
    </div>

</main>


<?php require("partials/footer.php") ?>