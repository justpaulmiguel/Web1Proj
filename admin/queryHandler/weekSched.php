<?php
$dateToday = date('Y-m-d');
$dateOneWeek =  date('Y-m-d', strtotime("+1 week"));
$query = "SELECT branch,
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
      inner join account_info
      on account_info.account_ID = bookings.account_ID
      WHERE state='accepted' AND
	  DATE(date) != DATE(CURDATE()) AND
      DATE(date) < DATE('$dateOneWeek') AND  WEEK(date) = WEEK(CURDATE())
       ORDER BY date ASC,TIME(time) ASC ";


require('../php/dbConnect.php');
$result = mysqli_query($conn, $query);

$weekRecords = [];
if (mysqli_num_rows($result) > 0) {
	while ($i = mysqli_fetch_assoc($result)) {
		array_push($weekRecords, $i);
	}
}
$conn->close();
