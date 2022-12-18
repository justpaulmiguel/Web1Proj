<?php


$query = "SELECT bookings.account_ID,
bookings.booking_ID,
  TIME_FORMAT(time, '%l:%i %p') as time,
  DATE_FORMAT(date,'%b %d %Y') as date,
  CONCAT(fname,' ',  lname) as name,
  bookings.booking_ID,
  branch,
  service
  FROM bookings 
  INNER JOIN account_info
  ON account_info.account_ID = bookings.account_ID
  WHERE state='pending'
   ORDER BY date ASC, time ASC;";

require("../php/dbConnect.php");
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) <= 0) {
    $pendingRequests = [];
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($pendingRequests, $row);
    }
}
mysqli_close($conn);
