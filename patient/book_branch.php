<?php
$title = 'Bookings';
require("./partials/head.php");

unset($_SESSION["branch"]);

if (!isset($_SESSION["service"])) {
  if (isset($_POST["service"])) {
    $_SESSION["service"] = $_POST["service"];
  } else {
    header("Location: book_service.php");
  }
}


switch ($_SESSION["service"]) {
  case "clean":
    $service = "Oral Prophylaxis";
    break;
  case "pasta":
    $service = "Dental Fillings";
    break;
  case "d_crown":
    $service = "Tooth Jacket";
    break;
  case "wisdom":
    $service = "Wisdom Tooth Extraction";
    break;
}
?>

<main>
  <h1 class="top-heading-text">Booking</h1>
  <p>Reserve an appointment with our doctors.</p>
  <div class="section-content">
    <h3>Your Booking Details:</h3>
    <div class="booking-details">
      <p>Service:<span> <?= $service ?></span></p>
    </div>
  </div>
  <section>
    <div class="section-content">
      <div class="booking-wrapper">

        <form method="post" action="book_date.php">
          <div class="input-wrapper">
            <label for="branch-option" class="label-text">Choose a Branch:</label>
            <select name="branch" id="branch-option" class="booking-select-input select-input">
              <option value="s_simon">San Simon</option>
              <option value="mexico">Mexico</option>
            </select>
          </div>
          <div class="form-btn-wrapper">
            <input class="submit-btn btn" type="submit" value="Next"></input>
            <button class="btn reset-btn" type="button" onClick="location.href='book_service.php'">Back</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</main>

<?php
require("./partials/footer.php");
?>