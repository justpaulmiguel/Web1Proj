<?php require("partials/head.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contactNum = $_POST['contactNo'];

    $willUpdate = true;
    // Input validation
    if (strlen($fname) == 0 || strlen($lname) == 0  || strlen($contactNum) == 0) {
        echo showModalError("Incorrect Credentials. Please fix details before trying again.");
        $willUpdate = false;
    }
    if ($willUpdate) {
        require("../php/dbConnect.php");
        $query = sprintf(
            "UPDATE  account_info SET lname='%s' , fname='%s', contactNo='%u' WHERE email='%s'; ",
            trim($lname),
            trim($fname),
            trim($contactNum),
            $_SESSION['email']
        );
        if (mysqli_query($conn, $query)) {
            echo showModalSuccess("Account details updated successfully!");
        } else {
            echo showModalError("Error Account update");
        }
        mysqli_close($conn);
    }
}


// Read account info
$account = [];
// todo refactor later to use primary id
$query = sprintf("SELECT * FROM account_info WHERE email='%s' LIMIT 1;", $_SESSION['email']);

require("../php/dbConnect.php");
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) <= 0) {
    echo showModalError("Can't Retrieve Account Details");
} else {
    $account = mysqli_fetch_array($result);
}
mysqli_close($conn);
?>

?>


<main>
    <h1>Account Details</h1>
    <div class="account-details-wrapper">

        <?php if (count($account) <= 0) : ?>
            <h2>Error Fetching Account Details in the Server.</h2>

        <?php else : ?>
            <form id="edit-account-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="input-wrapper">
                    <label for="inputFName">First Name:

                    </label>
                    <input type="text" min="2" max="100" name="fname" value="<?= $account['fname']    ?>" id="inputFName" class="disabled-input" required disabled />
                </div>

                <div class="input-wrapper">
                    <label for="inputLName">Last Name:</label>
                    <input type="text" min="2" max="100" name="lname" value="<?= $account['lname']    ?>" id="inputLName" required disabled class="disabled-input" />
                </div>

                <div class="input-wrapper">
                    <label for="inputContactNumber">Contact Number:</label>
                    <!-- Use digits  -->
                    <input type="text" maxlength="11" name="contactNo" id="inputContactNumber" required value="<?= $account['contactNo']    ?>" disabled class="disabled-input" />
                </div>

                <button id="btn-edit-info" type="button" class="btn">Edit</button>
                <button id="submit-account-details-btn" type="submit" class="hidden-btn btn">
                    Edit Account
                </button>
                <button id="cancel-account-details-btn" type="button" class="btn hidden-btn">
                    Cancel
                </button>
            </form>


        <?php endif ?>



    </div>
</main>


<?php require("partials/footer.php") ?>