<?php
$title = 'My Information';
require("partials/head.php");



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require("./queryHandler/postInformation.php");
}


// Read account info
$account = [];
require('./queryHandler/getInformation.php')
?>




<main>
    <h1>Account Details</h1>
    <div class="account-details-wrapper">
        <div class="section-content section-content-small">

            <?php if (count($account) <= 0) : ?>
                <h2>Error Fetching Account Details in the Server.</h2>

            <?php else : ?>
                <form id="edit-account-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-wrapper">
                        <label for="inputFName">First Name:

                        </label>
                        <input type="text" min="2" max="100" name="fname" value="<?= $account['fname']    ?>" id="inputFName" class="disabled-input account-input" required disabled />
                    </div>

                    <div class="input-wrapper">
                        <label for="inputLName">Last Name:</label>
                        <input type="text" min="2" max="100" name="lname" value="<?= $account['lname']    ?>" id="inputLName" required disabled class="disabled-input account-input" />
                    </div>

                    <div class="input-wrapper">
                        <label for="inputContactNumber">Contact Number:</label>
                        <!-- Use digits  -->
                        <div class="number-container">
                            <label id="dialCode" for="contactNo">+63</label>
                            <input type="text" maxlength="10" placeholder="91234567890" name="contactNo" id="inputContactNumber" required value="<?= $account['contactNo']    ?>" disabled class="disabled-input account-input" />
                            <span class="input-notif-msg"></span>
                        </div>

                    </div>

                    <button id="btn-edit-info" type="button" class="btn edit-btn secondary-btn information-btn">Edit</button>
                    <button id="submit-account-details-btn" type="submit" class="btn  hidden-btn secondary-btn update-btn">
                        Update Details
                    </button>
                    <button id="cancel-account-details-btn" type="button" class="btn secondary-btn hidden-btn cancel-btn">
                        Cancel
                    </button>
                </form>
        </div>


    <?php endif ?>



    </div>
</main>


<?php require("partials/footer.php") ?>