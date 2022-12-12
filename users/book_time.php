<?php
$title = 'Bookings';
require("./partials/head.php");

require("../php/dbConnect.php");

unset($_SESSION["time"]);

//INITIALIZATION
if(!isset($_SESSION["date"])) {
  if(isset($_POST["date"])) {
    $dateRaw = $_POST["date"];
    $date = date("F j, Y", strtotime($dateRaw));
    $_SESSION["date"] = $_POST["date"];
  } else {
    header("Location: book_service.php"); 
  }
} else {
  $dateRaw = $_SESSION["date"];
  $date = date("F j, Y", strtotime($dateRaw));
}


switch ($_SESSION["service"]){
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

switch ($_SESSION["branch"]){
  case "s_simon":
    $branch = "San Simon";
    break;
  case "mexico":
    $branch = "Mexico";
    break;
}

?>

<main>
  <h1 class="top-heading-text">Booking</h1>
  <p>Reserve an appointment with our doctors.</p>
  <section class="booking-wrapper">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

      <p class="subheading-date">Service: <?=$service?></p>
      <p class="subheading-date">Branch: <?=$branch?></p>
      <p class="subheading-date">Date: <?=$date?></p>

      <div class="input-wrapper">
          <label for="date-option" class="heading-date">Choose what Time:</label>

          <div class="fieldset-wrapper">
            <fieldset id="timepick">
              <?php 
              //PREVENTING USER FROM CHOOSING ALREADY FULLY BOOKED TIME
              $count1 = 0;
              $count2 = 0;
              $count3 = 0;
              $count4 = 0;
              $count5 = 0;
              $count6 = 0;
              $count7 = 0;
              $finalcount = 0;
              $times = [];
              
              $query = "SELECT bookings.time FROM bookings
                WHERE bookings.date='$dateRaw' AND bookings.state ='accepted'";
              
                $result = mysqli_query($conn, $query);
              $count = mysqli_num_rows($result);
              
                if (mysqli_num_rows($result) <= 0) {
                  ?>
                    <input type="radio" name="datetime" id="val-to-input" value="09:00:00" required/>
                    <label for="val-to-input">9:00 - 10:00 AM</label><br />
                    <input type="radio" name="datetime" value="10:00:00" id="val-to-input2" />
                    <label for="val-to-input2">10:00 - 11:00 AM</label><br />
                    <input type="radio" name="datetime" value="12:30:00" id="val-to-input3" />
                    <label for="val-to-input3">12:30 - 1:30 PM</label><br />
                    <input type="radio" name="datetime" value="13:30:00" id="val-to-input4" />
                    <label for="val-to-input4">1:30 - 2:30 PM</label><br />
                    <input type="radio" name="datetime" value="14:30:00" id="val-to-input5" />
                    <label for="val-to-input5">2:30 - 3:30 PM</label><br />
                    <input type="radio" name="datetime" value="15:30:00" id="val-to-input6" />
                    <label for="val-to-input6">3:30 - 4:30 PM</label><br />
                    <input type="radio" name="datetime" value="16:30:00" id="val-to-input7" />
                    <label for="val-to-input7">4:30 - 5:30 PM</label><br />
                  <?php
                } else {
                  ?>
                    <input style="display:none;" type="radio" name="datetime" id="val-to-input0" value="n" required/>
                  <?php
                  while ($row = mysqli_fetch_assoc($result)) {
                    array_push($times, $row);
                  }
                  mysqli_close($conn);
              
                  foreach ($times as $time) {
                    switch ($time["time"]) {
                      case "09:00:00":
                        $count1++;
                        break;
                      case "10:00:00":
                        $count2++;
                        break;
                      case "12:30:00":
                        $count3++;
                        break;
                      case "13:30:00":
                        $count4++;
                        break;
                      case "14:30:00":
                        $count5++;
                        break;
                      case "15:30:00":
                        $count6++;
                        break;
                      case "16:30:00":
                        $count7++;
                        break;
                    }
                  }

                  if (!($count1 >= 2)) {
                    $finalcount++;
                    ?> 
                      <input type="radio" name="datetime" id="val-to-input" value="09:00:00" />
                      <label for="val-to-input">9:00 - 10:00 AM</label><br />
                    <?php
                  }
                  if (!($count2 >= 2)) {
                    $finalcount++;
                    ?>
                      <input type="radio" name="datetime" value="10:00:00" id="val-to-input2" />
                      <label for="val-to-input2">10:00 - 11:00 AM</label><br />
                    <?php
                  }
                  if (!($count3 >= 2)) {
                    $finalcount++;
                    ?>
                      <input type="radio" name="datetime" value="12:30:00" id="val-to-input3" />
                      <label for="val-to-input3">12:30 - 1:30 PM</label><br />
                    <?php
                  }
                  if (!($count4 >= 2)) {
                    $finalcount++;
                    ?>
                      <input type="radio" name="datetime" value="13:30:00" id="val-to-input4" />
                      <label for="val-to-input4">1:30 - 2:30 PM</label><br />
                    <?php
                  }
                  if (!($count5 >= 2)) {
                    $finalcount++;
                    ?>
                      <input type="radio" name="datetime" value="14:30:00" id="val-to-input5" />
                      <label for="val-to-input5">2:30 - 3:30 PM</label><br />
                    <?php
                  }
                  if (!($count6 >= 2)) {
                    $finalcount++;
                    ?>
                      <input type="radio" name="datetime" value="15:30:00" id="val-to-input6" />
                      <label for="val-to-input6">3:30 - 4:30 PM</label><br />
                    <?php
                  }
                  if (!($count7 >= 2)) {
                    $finalcount++;
                    ?>
                      <input type="radio" name="datetime" value="16:30:00" id="val-to-input7" />
                      <label for="val-to-input7">4:30 - 5:30 PM</label><br />
                    <?php
                  }
                  if($finalcount==0) {
                    ?>
                      <p class="subheading-date">NO AVAILABLE TIME SLOT LEFT</p>
                      
                    <?php
                  }
                }
                            
              ?>

            </fieldset>
          </div>
        </div>
      <div class="form-btn-wrapper">
        <input id="submit-book-btn" class="submit-btn btn" type="submit" value="Submit Booking">
        <button class="btn reset-btn" type="button" onClick="location.href='book_date.php'">Back</button>
      </div>
    </form>
    <?php
      //BOOKING SCRIPT
      if (isset($_POST["datetime"]) && isset($_SESSION["service"]) && isset($_SESSION["branch"]) && isset($_SESSION["date"])) {
        $service = $_SESSION["service"];
        $branch = $_SESSION["branch"];
        $date = $_SESSION["date"];
        $time = $_POST["datetime"];

        require("../php/dbConnect.php");

        $email = $_SESSION["email"];

        $query = "SELECT account_info.account_ID FROM account_info WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        $value = mysqli_fetch_array($result);
        $id = $value['account_ID'];

        $query = "INSERT INTO bookings (bookings.account_ID, bookings.service, bookings.date, bookings.time, bookings.state, bookings.branch) 
        VALUES ('$id', '$service', '$date', '$time', 'pending', '$branch')";

        if (mysqli_query($conn, $query)) {

          mysqli_close($conn);

          unset($_POST["datetime"]);
          unset($_SESSION["service"]);
          unset($_SESSION["branch"]);
          unset($_SESSION["date"]);

          ?>
          <script>
              Swal.fire({
                  icon: 'success',
                  text: 'Booking Success!',
                  confirmButtonColor: '#e05c2a'
              }).then(function() {
                  window.location = "dashboard.php";
              });
          </script>");
          <?php
        } else {

          mysqli_close($conn);
          
          ?>
          <script>
              Swal.fire({
                  icon: 'error',
                  text: 'ERROR!',
                  confirmButtonColor: '#e05c2a'
              })
          </script>");
          <?php
        }
      }
    ?>
  </section>
</main>


<?php
require("./partials/footer.php");
?>