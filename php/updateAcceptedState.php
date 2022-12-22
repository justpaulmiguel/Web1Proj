<?php

/**
 * Script that gets run every refresh of the site.
 * What it does is getting all accepted state where the date and time 
 *  is less than
 * today's date, and marking them all with past state.
 */
$query = "UPDATE 
    bookings
   SET state='past'
    WHERE 
    state = 'accepted' AND DATE(date) <= CURDATE() AND 
    DATE_ADD(TIMESTAMP(date,time), INTERVAL 1 HOUR) <= NOW()
    ";

require("dbConnect.php");
mysqli_query($conn, $query);
mysqli_close($conn);
