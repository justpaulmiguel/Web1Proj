<?php
$title = 'Dashboard';
require("partials/head.php");

// todo get the current record for the week

if (isset($_SESSION['flash_message'])) {
	$message = $_SESSION['flash_message'];
	echo showModalSuccess($message);
	unset($_SESSION['flash_message']);
}



$date = date('Y-m-d');
$query = "SELECT 
		booking_ID,
		bookings.account_ID, 
		state,
		 branch, 
		 service,
		 email,
		 contactNo,
		 CONCAT(fname,' ',  lname) as name,
		TIME_FORMAT(time, '%l:%i %p') as time ,
		DATE_FORMAT(date,'%b %d %Y') as date

		   FROM bookings
		   INNER JOIN
		   account_info on  account_info.account_ID = bookings.account_ID
		    WHERE state='accepted' AND date='$date' 
			ORDER BY time ASC ";

require("../php/dbConnect.php");
$result = mysqli_query($conn, $query);
$todaysAppointment = [];
if (mysqli_num_rows($result) <= 0) {
	$todaysAppointment = [];
} else {
	while ($row = mysqli_fetch_assoc($result)) {
		array_push($todaysAppointment, $row);
	}
}
mysqli_close($conn);
?>



<main>
	<h1>Dashboard</h1>
	<div class="section-content">

		<?php if (mysqli_num_rows($result) > 0) : ?>
			<div class="section-header">
				<h2>Appointments Today</h2>
				<div class="remaining-wrapper">
					<span>Remaining Appointments:</span>
					<div class="remaining-number-wrapper">
						<span><?= mysqli_num_rows($result); ?></span>
					</div>
				</div>
			</div>
			<form method="post" action="updateDashboard.php" id="complete-appointment">
				<div class="table-container appointment-today-wrapper">
					<table>
						<thead>
							<tr>
								<th>Date</th>
								<th>Account ID</th>
								<th>Name</th>
								<th>Contact</th>
								<th>Appointment Time</th>
								<th>Branch</th>
								<th>Type of Service</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($todaysAppointment as $row) : ?>
								<tr class="">
									<td><?= $row['date']; ?></td>
									<td><?= $row['account_ID']; ?></td>
									<td><?= $row['name']; ?></td>

									<td>
										<p class="dashboard-number"><?= $row['contactNo'] ?></p>
										<a href="mailto:<?= $row['email'] ?>"><?= $row['email'] ?></a>

									</td>
									<td><?= $row['time']; ?></td>
									<td><?= getBranchName($row['branch']); ?></td>
									<td><?= getServiceName($row['service']); ?></td>
									<td>
										<button class='form-btn completed-btn' type=button value='$bookID'>Completed</button>
										<button class='form-btn missed-btn' type=button value='$bookID'>Missed</button>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</form>
		<?php else : ?>
			<h2>No appointments for today!</h2>
		<?php endif ?>

	</div>


	<div class="section-content">
		<h2>Upcoming Appointments</h2>
		<?php require('./weekSched.php') ?>
		<?php if (count($weekRecords) == 0) : ?>
			<h3>No more appointments!</h3>
		<?php else : ?>
			<div class="table-container">
				<table>
					<thead>
						<tr>
							<th>Date</th>
							<th>Account ID</th>
							<th>Name</th>
							<th>Contact</th>
							<th>Appointment Time</th>
							<th>Branch</th>
							<th>Type of Service</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($weekRecords as $row) : ?>
							<tr class="">
								<td><?= $row['date']; ?></td>
								<td><?= $row['account_ID']; ?></td>
								<td><?= $row['name']; ?></td>

								<td>
									<p class="dashboard-number"><?= $row['contactNo'] ?></p>
									<a href="mailto:<?= $row['email'] ?>"><?= $row['email'] ?></a>

								</td>
								<td><?= $row['time']; ?></td>
								<td><?= getBranchName($row['branch']); ?></td>
								<td><?= getServiceName($row['service']); ?></td>

							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
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
					title: 'Missed Appointment',
					text: "Do you want to mark this appointment as missed?",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#a35709',
					cancelButtonColor: 'gray',
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
					title: 'Complete Appointment ',
					text: "Do you want to mark this appointment as complete?",
					icon: 'info',
					showCancelButton: true,
					confirmButtonColor: '#a35709',
					cancelButtonColor: 'gray',
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