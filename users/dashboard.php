<?php
$title = 'Dashboard';
require("./partials/head.php");

require("../php/dbConnect.php");

$email = $_SESSION["email"];

$query = "SELECT account_info.account_ID, account_info.fname FROM account_info WHERE email='$email'";
$result = mysqli_query($conn, $query);
$value = mysqli_fetch_array($result);
$id = $value['account_ID'];
$fname = $value['fname'];

?>

<main>
  
  <section class="section-greeting-wrapper">
    <br>
    <h2>Good to see you,</h2>

    <h1 class="top-heading-text"><?= $fname ?></h1>
    <br>
  </section>
  <?php
  $query = "SELECT bookings.booking_ID, bookings.service, bookings.date, bookings.time, bookings.branch, bookings.note
  FROM bookings
  WHERE bookings.account_ID='$id' AND bookings.state='accepted'
  ORDER BY bookings.date, bookings.time
  LIMIT 1";
  $result = mysqli_query($conn, $query);
  $count =  mysqli_num_rows($result);


  if ($count > 0) {
    $booking = mysqli_fetch_array($result);

    $bookingID = $booking['booking_ID'];
    $_SESSION["bookingID"] = $bookingID;

    switch ($booking['service']) {
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

    switch ($booking['branch']) {
      case "s_simon":
        $branch = "San Simon";
        break;
      case "mexico":
        $branch = "Mexico";
        break;
    }

    $time = $booking['time'];
    $time = date("h:i A", strtotime($time));

    $dateRaw = $booking['date'];
    $date = date("F j, Y", strtotime($dateRaw));

    $Today = date("Y-m-d");
    $NextDay = date("Y-m-d", strtotime('+1 day', strtotime($Today)));
    $FirstDay = date("Y-m-d", strtotime('sunday last week'));
    $LastDay = date("Y-m-d", strtotime('sunday this week'));
    $NextWeekLast = date("Y-m-d", strtotime('sunday next week'));

    if ($dateRaw == $Today) {
      $when = "Today";
    } else if ($dateRaw == $NextDay) {
      $when = "Tomorrow";
    } else if ($dateRaw > $FirstDay && $dateRaw < $LastDay) {
      $when = "Next " . date('l', strtotime("$dateRaw"));
    } else if ($dateRaw < $NextWeekLast) {
      $when = "Next Week, " . date('l', strtotime("$dateRaw"));
    } else if (date(('m'), strtotime($dateRaw)) == date('m')) {
      $when = date('jS', strtotime("$dateRaw")) . " of this Month";
    } else {
      $when = date('jS', strtotime("$dateRaw")) . " of " . date('F', strtotime("$dateRaw"));
    }

  ?>

    <section class="schedule-wrapper">

      <p>Your next approved schedule would be on:</p>
      <p class="heading-date"><?= $time ?><br><?= $when ?></p>
      <p class="subheading-date"><?= $date ?></p>
      <div class="schedule-details-wrapper">
        <div class="detail-wrapper">
          <p>Dental Service</p>
          <p class="outlined-text"><?= $service ?></p>
        </div>
        <div class="detail-wrapper">
          <p>Branch</p>
          <p class="outlined-text"><?= $branch ?> Branch</p>
        </div>
      </div>
      <button class="btn cancel-btn" id="cancelBookBtn" type="button" onclick="cancelBook()">Cancel Booking</button>
      <br><br>
    </section>

  <?php

  } else {

    $query = "SELECT * FROM bookings
    WHERE bookings.account_ID='$id' AND bookings.state='pending'";
    $result = mysqli_query($conn, $query);
    $count =  mysqli_num_rows($result);

    if ($count > 0) {

      $message = "Your scheduled booking is currently waiting for Approval";
      $button = "Book Another One?";
    } else {

      $message = "You currently have no scheduled booking";
      $button = "Book Now?";
    }
  ?>
    <section class="schedule-wrapper">

      <p class="heading-date"><?= $message ?></p>
      <div class="form-btn-wrapper">
        <button class="submit-btn btn" onclick="location.href='book_service.php';"><?= $button ?></button>
      </div>
    </section>
  <?php
  }

  $records = [];

  $query = "SELECT * FROM bookings
  WHERE bookings.account_ID='$id' AND bookings.state in ('completed','declined','cancelled')
  ORDER BY bookings.date, bookings.time DESC
  LIMIT 10";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) <= 0) {
  ?>
    <section class="section past-record-wrapper">
      <br><br>
      <h2>You have no Past Records</h2>
    </section>
  <?php
  } else {
    while ($row = mysqli_fetch_assoc($result)) {
      array_push($records, $row);
    }

  ?>

    <section class="section past-record-wrapper">
      <h2>Your Most Recent Past Records:</h2>
      <table border="2" cellpadding="8" cellspacing="0">
        <tr>
          <th>TYPE OF SERVICE</th>
          <th>DATE</th>
          <th>TIME</th>
          <th>BRANCH</th>
          <th>STATE</th>
          <th>NOTE</th>
        </tr>

        <?php foreach ($records as $record) :
          switch ($record['service']) {
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

          $time = $record['time'];
          $time = date("h:i A", strtotime($time));

          $dateRaw = $record['date'];
          $date = date("F j, Y", strtotime($dateRaw));

          switch ($record['branch']) {
            case "s_simon":
              $branch = "San Simon";
              break;
            case "mexico":
              $branch = "Mexico";
              break;
          }

          $state = $record['state'];
          $note = $record['note'];

        ?>
          <tr align="center">
            <td><?= $service ?></td>
            <td><?= $date ?></td>
            <td><?= $time ?></td>
            <td><?= $branch ?></td>
            <td><?= $state ?></td>
            <td><?= $note ?></td>
          </tr>
        <?php endforeach; ?>

      </table>
    </section>


  <?php

  }

  mysqli_close($conn);
  ?>
</main>
<?php

require("./partials/footer.php");
?>