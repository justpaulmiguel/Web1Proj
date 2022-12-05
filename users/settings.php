<?php

require("./partials/head.php");
?>
<main>
  <h2>Change Email</h2>
  <section class="change-email-wrapper">
    <form action="/path/to/backend" method="post">
      <div class="input-wrapper">
        <label for="inputCurrentEmail">Current Email:</label>
        <input type="text" max="100" name="currentEmail" id="inputCurrentEmail" required />
      </div>

      <div class="input-wrapper">
        <label for="inputNewEmail">New Email:</label>
        <input type="text" max="100" name="newEmail" id="inputNewEmail" required />
      </div>

      <div class="input-wrapper">
        <label for="inputPassword">Password:</label>
        <input type="password" max="100" name="password" id="inputPassword" required />
      </div>

      <button type="submit">Change</button>
    </form>
  </section>
  <h2>Change Password</h2>
  <section class="change-password-wrapper">
    <form action="/path/to/backend" method="post">
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

<?php

require("./partials/footer.php");
?>