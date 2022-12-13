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

	<div class="main-content">
		<?php
		require("../php/dbConnect.php");
		$date = date('Y-m-d');
		$query = "SELECT booking_ID, account_ID, state,  DATE_FORMAT(date,'%W, %M %d %Y') as date , TIME_FORMAT(time, '%l:%i %p') as time  FROM bookings WHERE state='accepted' AND date='$date'";
		$result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) > 0) {
		?>
			<div class="section-header">
				<h2>Appointments Today</h2>
				<span>Left: <?= mysqli_num_rows($result); ?></span>
			</div>
			<div class="table-container">

				<form method="post" action="updateDashboard.php" id="complete-appointment">
					<table style="text-align: center;">
						<tr>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Contact</th>
							<th>Time</th>
							<th>Date</th>
							<th>State</th>
						</tr>
						<?php while ($row = mysqli_fetch_assoc($result)) {
							$bookID = $row["booking_ID"];
							$accID = $row['account_ID'];
							$time = $row['time'];
							$date = $row['date'];
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
										. "<a href=mailto:$email>" . $email . "</a>" .
										"<p>0" .
										$contactNo . "</p>" . "</td><td>"
										. $time . "</td><td>"
										. $date . "</td><td>"
										. "<button class='form-btn' type=button value='$bookID'>Completed</button>";
								}
							}
						}
						echo "</table> </form> </div>";
						?>

					<?php
				} else {
					echo "<h2>No appointments for today!</h2>";
				}
					?>


			</div>

</main>


<script>
	if (document.querySelector("#complete-appointment")) {
		const form = document.querySelector("#complete-appointment");
		form.addEventListener('submit', (e) => {
			e.preventDefault();

		})
		const btns = [...document.querySelectorAll(".form-btn")];
		btns.forEach(btn => {
			btn.addEventListener("click", (e) => {
				e.preventDefault();
				Swal.fire({
					title: 'Are you sure?',
					text: "Do you want to mark this appointment as complete",
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
						stateChangeInput.setAttribute("name", "stateChange");
						form.appendChild(stateChangeInput);
						form.submit();
					}
				})
			})
		})
	}
</script>

<?php require("partials/footer.php") ?>