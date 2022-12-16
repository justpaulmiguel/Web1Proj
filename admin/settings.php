<?php
$title = 'My Settings';
require("partials/head.php") ?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPass = $_POST['currentPassword'];
    $newPass = $_POST["newPassword"];
    $confirmNewPass = $_POST["confirmNewPassword"];

    $willUpdate = true;
    // post values validation
    if (
        strlen($currentPass) == 0
        || strlen($newPass) == 0
        || strlen($confirmNewPass) == 0
    ) {

        echo showModalError("Incomplete details");
        $willUpdate = false;
    }

    // check if password is the same
    if (strcmp($newPass, $confirmNewPass) != 0) {
        echo  showModalError("New passwords are not the same!");
        $willUpdate = false;
    }

    if ($willUpdate) {
        require('../php/dbConnect.php');
        $query = sprintf("SELECT password FROM accounts WHERE email='%s' LIMIT 1;", $_SESSION['email']);
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <= 0) {
            echo showModalError("SQL Error");
        } else {

            $passHash = mysqli_fetch_array($result)[0];
            // checks db password before updating
            if (!password_verify(
                $currentPass,
                $passHash
            )) {
                echo showModalError("Entered current password is incorrect.");
            } else {
                $passHash = password_hash($newPass, PASSWORD_DEFAULT);
                // perform changing of password
                $query = sprintf(
                    "UPDATE  accounts SET password='%s' WHERE email='%s' LIMIT 1;",
                    $passHash,
                    $_SESSION['email']
                );
                if (mysqli_query($conn, $query)) {
                    echo showModalSuccess("Password updated successfully!");
                } else {
                    echo showModalError("Error updating of Password");
                }
                mysqli_close($conn);
            }
        }
    }
}


?>

<main>
    <h2>Change Password</h2>
    <section class="change-password-wrapper">
        <div class="section-content section-content-md">
            <form id="changePassForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-input-container">
                    <div class="input-wrapper">
                        <label for="inputNewPassword">New Password:</label>
                        <input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="password" max="100" name="newPassword" id="inputNewPassword" required />
                        <span class="input-notif-msg"></span>
                    </div>
                    <div class="input-wrapper">
                        <label for="inputConfirmNewPassword">Confirm New Password:</label>
                        <input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="password" max="100" name="confirmNewPassword" id="inputConfirmNewPassword" required />
                        <span class="input-notif-msg"></span>
                    </div>
                    <div class="input-wrapper">
                        <label for="inputCurrentPassword">Current Password:</label>
                        <input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="password" minlength="6" max="64" name="currentPassword" id="inputCurrentPassword" required />
                        <span class="input-notif-msg"></span>
                    </div>
                    <label for="togglePassword">
                        Show Passsword
                        <input id="togglePassword" type="checkbox">
                    </label>
                    <div class="btn-container">
                        <button type="submit" disabled class="submit-btn secondary-btn  btn disabled-btn">Change</button>
                        <button type="reset" class="reset-btn btn">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>


<?php require("partials/footer.php") ?>