<?php
$title = 'My Settings';
require("partials/head.php") ?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['edit-account'])) {
    require("./queryHandler/postInformation.php");
  } else if (isset($_POST['change-password'])) {
    require("./queryHandler/postNewPassword.php");
  }
}

$account = [];
require("./queryHandler/getInformation.php");
?>

<main>
  <h2>Account Details</h2>
  <div class="account-details-wrapper">
    <div class="section-content section-content-small">

      <?php if (count($account) <= 0) : ?>
        <h2>Error Fetching Account Details in the Server.</h2>

      <?php else : ?>
        <form id="edit-account-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <input type="hidden" name="edit-account" value="1" />
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

            <div class="input-wrapper">
              <label for="inputLName">Email (Not changable):</label>
              <input type="text" class="no-change" value="<?= $_SESSION['email']    ?>" disabled class="disabled-input account-input" />
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
      <?php endif ?>
    </div>
  </div>

  <h2>Change Password</h2>
  <section class="change-password-wrapper">
    <div class="section-content section-content-md">
      <form id="changePassForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="change-password" value="1" />
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