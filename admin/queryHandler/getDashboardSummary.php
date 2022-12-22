<?php

/**
 * Gets the most availed services of the clinic
 * returns an ordered array
 */
function getMostAvailed()
{
    require("../php/dbConnect.php");
    $val = [];

    $query = "SELECT COUNT(*) as count,
    service
    FROM bookings
    GROUP BY service
    ORDER BY COUNT(*) DESC
    
    ";

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) <= 0) {
        echo showModalError("Can't Retrieve the Database");
        $val =  [];
    } else {
        while ($row = mysqli_fetch_array($result)) {
            array_push($val, $row);
        }
    }
    mysqli_close($conn);
    return $val;
}

// Fetches the count of the bookings
function getTotalBookings()
{
    require("../php/dbConnect.php");
    $val;

    $query = "SELECT 
    COUNT(*)
    FROM bookings
    
    ";

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) <= 0) {
        echo showModalError("Can't Retrieve the Database");
        $val =  0;
    } else {
        $val =  mysqli_fetch_assoc($result)['COUNT(*)'];
    }
    mysqli_close($conn);
    return $val;
}

// Fetches the total patients (permissionLvl == 0)
function getTotalPatients()
{
    require("../php/dbConnect.php");
    $val;

    $query = "SELECT 
    COUNT(*)
    FROM accounts
    WHERE permissionLvl = 0
    ";

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) <= 0) {
        echo showModalError("Can't Retrieve the Database");
        $val =  0;
    } else {
        $val =  mysqli_fetch_assoc($result)['COUNT(*)'];
    }
    mysqli_close($conn);
    return $val;
}

// Fetches the total count of employeees (permissionLvl >0)
function getTotalEmployees()
{
    require("../php/dbConnect.php");
    $val;

    $query = "SELECT 
    COUNT(*)
    FROM accounts
    WHERE permissionLvl >0
    ";

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) <= 0) {
        echo showModalError("Can't Retrieve the Database");
        $val =  0;
    } else {
        $val =  mysqli_fetch_assoc($result)['COUNT(*)'];
    }
    mysqli_close($conn);
    return $val;
}




// fetch the total counts of the state for all dates before the current date. Accepts a string which is the name of the state.
function getBookingStateCount($state)
{
    require("../php/dbConnect.php");
    $val;

    $query = "SELECT 
    COUNT(*)
    FROM bookings
    WHERE DATE(date) <= CURDATE() AND state='$state';
    ";

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) <= 0) {
        echo showModalError("Can't Retrieve the Database");
        $val =  0;
    } else {
        $val =  mysqli_fetch_assoc($result)['COUNT(*)'];
    }
    mysqli_close($conn);
    return $val;
}

// fetch the total counts of the state . Accepts a string which is the name of the state.
function getBookingFutureStateCount($state)
{
    require("../php/dbConnect.php");
    $val;

    $query = "SELECT 
    COUNT(*)
    FROM bookings
    WHERE  state='$state';
    ";

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) <= 0) {
        echo showModalError("Can't Retrieve the Database");
        $val =  0;
    } else {
        $val =  mysqli_fetch_assoc($result)['COUNT(*)'];
    }
    mysqli_close($conn);
    return $val;
}
