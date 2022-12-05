<?php
require("./partials/head.php");
?>

<main>
  <h1>Account Details</h1>
  <div class="account-details-wrapper">
    <form id="edit-account-form" action="/go/to/php/backend" method="post">
      <div class="input-wrapper">
        <label for="inputFName">First Name:</label>
        <input type="text" min="2" max="100" name="firstName" value="Paul Justine" id="inputFName" class="disabled-input" required disabled />
      </div>

      <div class="input-wrapper">
        <label for="inputLName">Last Name:</label>
        <input type="text" min="2" max="100" name="lastName" value="Miguel" id="inputLName" required disabled class="disabled-input" />
      </div>

      <div class="input-wrapper">
        <label for="inputContactNumber">Contact Number:</label>
        <!-- Use digits  -->
        <input type="text" maxlength="11" name="contactNumber" id="inputContactNumber" required value="012346578" disabled class="disabled-input" />
      </div>

      <button id="btn-edit-info" type="button" class="btn">Edit</button>
      <button id="submit-account-details-btn" type="submit" class="hidden-btn btn">
        Edit Account
      </button>
      <button id="cancel-account-details-btn" type="button" class="btn hidden-btn">
        Cancel
      </button>
    </form>
  </div>
</main>
<?php
require("./partials/footer.php");
?>