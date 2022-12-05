<?php

require("./partials/head.php");

?>

<main>
  <h1 class="top-heading-text">Booking</h1>
  <p>Reserve an appointment with our doctors.</p>
  <section class="booking-wrapper">
    <form action="">
      <div class="input-wrapper">
        <label for="branch-option">branch:</label>
        <select name="branch" id="branch-option" class="booking-select-input select-input">
          <option value="San Simon">San Simon</option>
          <option value="Mexico">Mexico</option>
        </select>
      </div>
      <div class="input-wrapper">
        <label for="date-option">date:</label>
        <div class="fieldset-wrapper">
          <fieldset>
            <legend>February 10 2022</legend>

            <input type="radio" name="datetime" id="val-to-input" value="to be inserted in backend" checked />
            <label for="val-to-input">9 - 10 AM</label><br />

            <input type="radio" name="datetime" value="to be inserted in backend" id="val-to-input2" />

            <label for="val-to-input2">12:30 - 1 PM</label><br />
          </fieldset>
        </div>
      </div>

      <div class="input-wrapper">
        <label for="service-option">service type:</label>
        <select name="service" id="service-option" class="booking-select-input select-input">
          <option value="">Oral Check-up</option>
          <option value="Mexico">Braces</option>
        </select>
      </div>
      <div class="form-btn-wrapper">
        <button class="submit-btn btn" type="submit">Submit</button>
        <button class="btn reset-btn" type="button">Reset</button>
      </div>
    </form>
  </section>
</main>

<?php
require("./partials/footer.php");
?>