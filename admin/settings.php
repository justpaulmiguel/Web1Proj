<?php require("partials/head.php") ?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPass = $_POST['currentPassword'];
    $newPass = $_POST["newPassword"];
    $confirmNewPass = $_POST["confirmNewPassword"];


    if (
        strlen($currentPass) == 0
        || strlen($newPass) == 0
        || strlen($confirmNewPass) == 0
    ) {

        echo showModalError("Incomplete details");
    }


    if (!strcmp($newPass, $confirmNewPass)) {
        echo  showModalError("New passwords are not the same!");
    }

    // Actual query

}
?>

<main>
    <h2>Change Password</h2>
    <section class="change-password-wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-wrapper">
                <label for="inputNewPassword">New Password:</label>
                <input type="password" max="100" name="newPassword" id="inputNewPassword" />
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