<?php


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
		   account_info 
           ON account_info.account_ID = bookings.account_ID
		    WHERE state='past'
			ORDER BY DATE(date) ASC, TIME(time) ASC ";

require("../php/dbConnect.php");
$result = mysqli_query($conn, $query);
$pastAppointments = [];
if (mysqli_num_rows($result) <= 0) {
    $pastAppointments = [];
} else {
    while ($row = mysqli_fetch_array($result)) {
        array_push($pastAppointments, $row);
    }
}

mysqli_close($conn);
