<?php

$query = "UPDATE 
    bookings
   SET state='past'
    WHERE 
    state = 'accepted' AND DATE(date) <= CURDATE() AND 
    DATE_ADD(TIMESTAMP(date,time), INTERVAL 1 HOUR) <= NOW()
    ";

require("../php/dbConnect.php");
mysqli_query($conn, $query);
mysqli_close($conn);
