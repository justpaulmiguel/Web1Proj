<?php
$title = 'Dashboard';
require("partials/head.php");
?>
<script>
	function validation()
	{
		choice=confirm("Do you want to Complete the session?");
		if(choice==false)
		{
			return false;
		}
		
	}
	
</script>


<main>
	
	<h1>Dashboard</h1>
	<table style="text-align: center;">
		<tr>
		<th>Order ID</th>
		<th>Account ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Contact</th>
		<th>Time</th>
		<th>Date</th>
		<th>State</th>
		</tr>
		<form method="post" action="updateDashboard.php" onsubmit="return validation()">
	<?php 
	require ("../php/dbConnect.php");
	$query = "SELECT * FROM bookings WHERE state='accepted'";
	$result = mysqli_query($conn,$query);
	if (mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			$bookID = $row["booking_ID"];
			$accID = $row['account_ID'];
			$time=$row['time'];
			$date=$row['date'];

			$query1="SELECT * FROM account_info WHERE account_id='$accID'";
			$result1 = mysqli_query($conn,$query1);
			if (mysqli_num_rows($result1) > 0)
			{
				while($row1 = mysqli_fetch_assoc($result1))
				{
					$fname=$row1['fname'];
					$lname=$row1['lname'];
					$email=$row1['email'];
					$contactNo=$row1['contactNo'];
					echo "<tr><td> "
					.$bookID."</td><td>"
					.$accID."</td><td>"
					.$fname."</td><td>"
					. $lname."</td><td>"
					. "<a href=mailto:$email>".$email."</a>/".$contactNo."</td><td>"
					. $time."</td><td>"
					. $date."</td><td>"
					."<button type=submit name=stateChange value='$bookID'>Completed</button>";
					
				}
			}
		}
	} 
	else{
		echo "No records found.";
	}

	?>
	</form>
	</table>

	
</main>



<?php require("partials/footer.php") ?>