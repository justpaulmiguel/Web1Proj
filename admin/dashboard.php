<?php
$title = 'Dashboard';
require("partials/head.php");

// todo get the current record for the week

if (isset($_SESSION['flash_message'])) {
	$message = $_SESSION['flash_message'];
	echo showModalSuccess($message);
	unset($_SESSION['flash_message']);
}

?>



<main>
	<h1>Dashboard</h1>

	<div class="section-content">
		<?php
		require("../php/dbConnect.php");
		$date = date('Y-m-d');
		$query = "SELECT booking_ID, account_ID, state,   TIME_FORMAT(time, '%l:%i %p') as time  FROM bookings WHERE state='accepted' AND date='$date' ORDER BY time ASC ";
		$result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) > 0) {
		?>
			<div class="section-header">
				<h2>Appointments Today</h2>
				<div class="remaining-wrapper">
					<span>Left:</span>
					<div class="remaining-number-wrapper">
						<span><?= mysqli_num_rows($result); ?></span>
					</div>
				</div>
			</div>

			<form method="post" action="updateDashboard.php" id="complete-appointment">
				<div class="table-container appointment-today-wrapper">

					<table style="text-align: center;">
						<tr>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Contact</th>
							<th>Time</th>
							<th>Mark As</th>
						</tr>
						<?php while ($row = mysqli_fetch_assoc($result)) {
							$bookID = $row["booking_ID"];
							$accID = $row['account_ID'];
							$time = $row['time'];
							$query1 = "SELECT * FROM account_info WHERE account_id='$accID'";
							$result1 = mysqli_query($conn, $query1);
							if (mysqli_num_rows($result1) > 0) {
								while ($row1 = mysqli_fetch_assoc($result1)) {
									$fname = $row1['fname'];
									$lname = $row1['lname'];
									$email = $row1['email'];
									$contactNo = $row1['contactNo'];
									echo "<tr><td> "
										. $fname . "</td><td>"
										. $lname . "</td><td>"
										.
										"<p>0" .
										$contactNo . "</p>" . "<a href=mailto:$email>" . $email . "</a>" . "</td><td>"
										. $time . "</td><td>"
										. "<button class='form-btn completed-btn' type=button value='$bookID'>Completed</button>
										 <button class='form-btn missed-btn' type=button value='$bookID'>Missed</button>
										
										";
								}
							}
						}
						echo "</table></div> </form> ";
						?>

					<?php
				} else {
					echo "<h2>No appointments for today!</h2>";
				}
					?>


				</div>
				<div class="section-content">
					<h2>Remaining appointments for the week</h2>
					<?php require('./weekSched.php') ?>
					<?php if (count($weekRecords) == 0) : ?>
						<h3>No more appointments!</h3>
					<?php else : ?>
						<ul class="week-appointment-list">
							<?php foreach ($weekRecords as $rec) : ?>
								<li>
									<div class="week-list-item">
										<p><?= $rec["name"] ?></p>
										<p><?= $rec["date"] ?></p>
										<p><?= $rec["time"] ?></p>
									</div>
								</li>
							<?php endforeach ?>
						</ul>
					<?php endif ?>

				</div>
</main>


<script>
	if (document.querySelector("#complete-appointment")) {
		const form = document.querySelector("#complete-appointment");
		form.addEventListener('submit', (e) => {
			e.preventDefault();
		})
		const handleMissedBtnClick = (btn) => {
			btn.addEventListener('click', (e) => {
				e.preventDefault();
				Swal.fire({
					title: 'Missed Appointment Confirmation',
					text: "Do you want to mark this appointment as missed?",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes'
				}).then((result) => {
					if (result.isConfirmed) {
						const stateChangeInput = document.createElement("input");
						stateChangeInput.setAttribute("type", "hidden");
						stateChangeInput.setAttribute("value", btn.value);
						stateChangeInput.setAttribute("name", "missed");
						form.appendChild(stateChangeInput);
						form.submit();
					}
				})
			})

		};
		const handleCompletedBtnClick = (btn) => {
			btn.addEventListener('click', (e) => {
				e.preventDefault();
				Swal.fire({
					title: 'Completed Appointment Confirmation',
					text: "Do you want to mark this appointment as complete?",
					icon: 'info',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes'
				}).then((result) => {
					if (result.isConfirmed) {
						const stateChangeInput = document.createElement("input");
						stateChangeInput.setAttribute("type", "hidden");
						stateChangeInput.setAttribute("value", btn.value);
						stateChangeInput.setAttribute("name", "completed");
						form.appendChild(stateChangeInput);
						form.submit();
					}
				})
			})

		};
		const completedBtns = [...document.querySelectorAll(".completed-btn")];
		const missedBtns = [...document.querySelectorAll(".missed-btn")];
		completedBtns.map(handleCompletedBtnClick);
		missedBtns.map(handleMissedBtnClick);
	}
</script>

<?php require("partials/footer.php") ?>