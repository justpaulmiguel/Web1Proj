<?php
$title = 'Bookings';
require("./partials/head.php");
$min = date("Y-m-d",strtotime("+1 day")); 
$max = date("Y-m-d",strtotime("+2 month")) ;

unset($_SESSION["date"]);

if(!isset($_SESSION["branch"])) {
  if(isset($_POST["branch"])) {
    $_SESSION["branch"] = $_POST["branch"];
  } else {
    header("Location: book_service.php"); 
  }
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
    <form id="formDate" method="post" action="book_time.php" autocomplete="off">

      <p class="subheading-date">Service: <?=$service?></p>
      <p id="branch" class="subheading-date">Branch: <?=$branch?></p>
      
      <div class="input-wrapper">
        <label for="date-option" class="heading-date">Choose the Date:</label>
          <input type="text" id="date" name="date" placeholder="Select a Date" required>
      </div>
      <div class="form-btn-wrapper">
        <input class="submit-btn btn" type="submit" value="Next"></input>
        <button class="btn reset-btn" type="button" onClick="location.href='book_branch.php'">Back</button>
      </div>
    </form>
  </section>
</main>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>

/*
var form = document.getElementById("formDate");

$(document).ready(function (){
            $(form).submit(function (event) {
              e.preventDefault();
              Swal.fire({
                  icon: 'error',
                  text: 'Please select a date first!',
                  confirmButtonColor: '#e05c2a'
              }).then(function() {
                  window.location = "book_date.php";
              });
                          })
        })
*/


 //Datepicker Dialog (flatpickr)

 var branch = document.getElementById("branch").textContent;
 var min = new Date();
 var max = min.setMonth(min.getMonth() + 2);

 switch (branch) {
  case "Branch: San Simon":
    var disable = [2,4,6];
    break;
  case "Branch: Mexico":
    var disable = [1,3,5];
    break;
 }



 config = {
 minDate: new Date().fp_incr(1),
 maxDate: max,
 disable: ["2022-12-25"],
 dateFormat: "Y-m-d",
 monthSelectorType: "static", 
 "disable": [
     function(date) {
         // return true to disable
         return (date.getDay() === 0 || date.getDay() === disable[0] || date.getDay() === disable[1] || date.getDay() === disable[2]);

     },

 ],
  onChange: function(dates) {
    if (dates.length == 2) {
        var start = dates[0];
        var end = dates[1];

        // interact with selected dates here
    }
  },
  allowInput: true, // prevent "readonly" prop
    onReady: function(selectedDates, dateStr, instance) {
        let el = instance.element;
        function preventInput(event) {
            event.preventDefault();
            return false;
        };
        el.onkeypress = el.onkeydown = el.onkeyup = preventInput; // disable key events
        el.onpaste = preventInput; // disable pasting using mouse context menu

        el.style.caretColor = 'transparent'; // hide blinking cursor
        el.style.cursor = 'pointer'; // override cursor hover type text
        el.style.color = '#585858'; // prevent text color change on focus
        el.style.backgroundColor = '#f7f7f7'; // prevent bg color change on focus
    },
}

 flatpickr("input[name=date]", config);

</script>

<?php
require("./partials/footer.php");
?>