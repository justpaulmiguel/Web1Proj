<?php
$dateToday = date('Y-m-d');
$dateOneWeek =  date('Y-m-d', strtotime("+1 week"));
$query = "SELECT branch,
        service,
        bookings.account_ID,
      TIME_FORMAT(time, '%l:%i %p') as time,
      DATE_FORMAT(date,'%b %d %Y') as date,
      CONCAT(fname,' ',  lname) as name
      FROM bookings 
      inner join account_info
      on account_info.account_ID = bookings.account_ID
      WHERE state='accepted'
       AND date<='$dateOneWeek' AND  WEEK(date) = WEEK('$dateToday')
       ORDER BY date ASC,time ASC ";


$result = mysqli_query($conn, $query);

$weekRecords = [];
require('../php/dbConnect.php');
if (mysqli_num_rows($result) > 0) {
    while ($i = mysqli_fetch_assoc($result)) {
        array_push($weekRecords, $i);
    }
}
$conn->close();
