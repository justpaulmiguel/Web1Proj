<?php
		require ("../php/dbConnect.php");	
	if(isset($_REQUEST['stateChange']))
	{
	
		$bookID1 = $_POST["stateChange"];
		$query2="UPDATE `bookings` SET `state` = 'completed' WHERE booking_ID='$bookID1'";
		$result2 = mysqli_query($conn,$query2);
		mysqli_query($conn,$query2);
		mysqli_close($conn);
        header("refresh: 0; url=dashboard.php");

	}
?>