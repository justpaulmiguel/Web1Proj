<?php

session_start();
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
        <button class="submit-btn btn" onclick="location.href='book.php';"><?= $button ?></button>
      </div>
    </section>
  <?php
  }

  $records = [];

  $query = "SELECT * FROM bookings
  WHERE bookings.account_ID='$id' AND bookings.state in ('completed','declined','cancelled')
  ORDER BY bookings.date, bookings.time";
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
      <h2>Past Records</h2>
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



  <section class="section services-section">
    <div class="row" id="services">
      <div class="container-fluid">
        <div id="servicesTitle">Services</div>
        <div id="servicesContent">
          <div class="theService1">
            <div class="row">
              <div id="service1" class="container-fluid col-sm-3">
                <!-----------------------------------------Service 1------------------------------------------------>
                <h3 style="text-align: center">
                  Oral Prophylaxis <br />(cleaning)
                </h3>
                <p>
                  <img src="../home/images/Oral Prophylaxis.jpg" /><br />
                  It is called to the procedure done for the teeth
                  cleaning. It removes tartar and plaque build-up from the
                  surfaces of the teeth as well as those hidden in between
                  and under the gums. Some of the benefits of having an
                  oral prophylaxis are to Prevent Tooth Decay, Prevents
                  Gum Disease, Prevents Bad Breath, Removes Extrinsic
                  Stains, Lowers Risk for Diseases, Early detection of
                  Diseases and Financial Savings. Oral prophylaxis is
                  recommended to be done twice a year as a preventive
                  measure but should be performed every 3-4 months for
                  patients with more severe periodontal disease.
                </p>
              </div>
              <div id="service2" class="container-fluid col-sm-3">
                <!-----------------------------------------Service 2------------------------------------------------>
                <h3 style="text-align: center">
                  The Dental Fillings <br />(pasta)
                </h3>
                <p>
                  <img src="../home/images/Dental Fillings.jpg" /><br />
                  Dental filling is used to treat a small hole, or cavity,
                  in a tooth. To repair a cavity, a dentist removes the
                  decayed tooth tissue and then fills the space with a
                  filling material. We offer several dental filling
                  materials. Teeth can be filled with porcelain; silver
                  amalgam (which consists of mercury mixed with silver,
                  tin, zinc, and copper); or tooth-colored, plastic, and
                  materials called composite resin fillings. There is also
                  a material that contains glass particles and is known as
                  glass ionomer. This material is used in ways like the
                  use of composite resin fillings. Materials depends on
                  the availability.
                </p>
              </div>
              <div id="service3" class="container-fluid col-sm-3">
                <!-----------------------------------------Service 3------------------------------------------------>
                <h3 style="text-align: center">
                  Tooth Jacket <br />(Dental Crown)
                </h3>
                <p>
                  <img src="../home/images/Tooth Jacket.jpg" /><br />
                  A tooth jacket (also known as a dental crown) is a false
                  tooth that comes in a variety of material made to be
                  placed on a severely damaged tooth. Essentially, this a
                  tooth jacket caps off a severely damaged tooth
                  protecting it from further damage and replacing it the
                  same time. How is a tooth jacket is placed on your
                  teeth? To keep it simple, a dentist will file the
                  affected tooth down to size. This is to make room for
                  the dental crown that goes on top of the tooth. Usually,
                  the dentist will give you a temporary crown or jacket to
                  wear while the actual crown is being made. The waiting
                  time can be from a few days all the way up to a week or
                  two.
                </p>
              </div>
              <div id="service4" class="container-fluid col-sm-3">
                <!-----------------------------------------Service 4------------------------------------------------>
                <h3 style="text-align: center">
                  Wisdom Tooth <br />Extraction
                </h3>
                <p>
                  <img src="../home/images/Wisdom Tooth Extraction.jpg" /><br />
                  Wisdom tooth extraction is a surgical procedure to
                  remove one or more wisdom teeth — the four permanent
                  adult teeth located at the back corners of your mouth on
                  the top and bottom. If a wisdom tooth doesn't have room
                  to grow (impacted wisdom tooth), resulting in pain,
                  infection or other dental problems, you'll likely need
                  to have it pulled. This service may be done by a dentist
                  or an oral surgeon and to prevent potential future
                  problems, some dentists and oral surgeons recommend
                  wisdom tooth extraction even if impacted teeth aren't
                  currently causing problems.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php

require("./partials/footer.php");
?>