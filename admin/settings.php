<?php require("partials/head.php") ?>

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
        echo  showModalError("New passwords are not the same!" . $currentPass . $newPass);
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
                echo showModalError("Entered current password is incorrect." . $currentPass);
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
            }
        }
    }
}


?>

<main>
    <h2>Change Password</h2>
    <section class="change-password-wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-wrapper">
                <label for="inputNewPassword">New Password:</label>
                <input type="password" max="100" name="newPassword" id="inputNewPassword" required />
            </div>

            <div class="input-wrapper">
                <label for="inputConfirmNewPassword">Confirm New Password:</label>
                <input type="password" max="100" name="confirmNewPassword" id="inputConfirmNewPassword" required />
            </div>

            <div class="input-wrapper">
                <label for="inputCurrentPassword">Current Password:</label>
                <input type="password" max="100" name="currentPassword" id="inputCurrentPassword" required />
            </div>

            <button type="submit">Change</button>
            <button type="reset">Reset</button>
        </form>
    </section>
</main>


<?php require("partials/footer.php") ?>