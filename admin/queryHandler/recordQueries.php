<?php


/***
 * Performs sql request query
 * 
 * @return integer rowcount
 */
function getCount(string $query)
{
    require("../php/dbConnect.php");
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
    return mysqli_fetch_row($result)[0];
}

/***
 * Returns sql query for counting rows in the database.
 * 
 * @return string query
 */
function getCountQuery($type, $value)
{

    if ($type == 'email') {
        return sprintf("SELECT COUNT(*) FROM account_info WHERE email = '%s'", $value);
    } else if ($type = 'id') {
        return sprintf("SELECT COUNT(*) FROM account_info WHERE account_ID = '%s'", $value);
    } else {
        $conditional = $type == 'date' ? '<=' : '=';
        return sprintf("SELECT COUNT(*) FROM bookings WHERE %s %s '%s'", $type, $conditional, $value);
    }
}


/***
 * Fetches records from the database
 * 
 * @return array if theres rows, null otherwise
 */
function getRecords($query)
{
    $records = [];
    require("../php/dbConnect.php");
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) <= 0) {
        $records = null;
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($records, $row);
        }
    }
    $conn->close();
    return $records;
}

/***
 * Returns a query based from the type of filter
 * 
 * @return string sql query string.
 */
function getQuery($type, $limit, $offset, $value, $sort)
{
    $sortMode = $sort == 0 ? 'DESC' : 'ASC';

    if ($type == 'email') {

        return     sprintf(
            "SELECT 
        DATE_FORMAT(date,'%s') as date, 
        TIME_FORMAT(time, '%s') as time, 
        state, 
        lname,fname,service,
        bookings.account_ID,booking_ID,
        branch,note
         FROM bookings
        INNER JOIN account_info
        ON account_info.account_ID = bookings.account_ID
        WHERE email = '%s'
        LIMIT $limit OFFSET $offset",
            '%b %d %Y',
            '%l:%i %p',
            $value
        );
    } else if ($type == 'date') {
        return sprintf(
            "SELECT 
        DATE_FORMAT(date,'%s') as date, 
        TIME_FORMAT(time, '%s') as time, 
        state, 
        lname,fname,service,
        bookings.account_ID,booking_ID,
        branch,note
         FROM bookings
        INNER JOIN account_info
        ON account_info.account_ID = bookings.account_ID
        WHERE bookings.%s <= '%s'
        ORDER BY date %s, time %s
        LIMIT $limit OFFSET $offset",
            '%b %d %Y',
            '%l:%i %p',
            $type,
            $value,
            $sortMode,
            $sortMode
        );
    } else if ($type == 'id') {
        return sprintf(
            "SELECT DATE_FORMAT(date,'%s') as date, TIME_FORMAT(time, '%s') as time, 
        state, lname,fname,service,bookings.account_ID,booking_ID,branch,note
         FROM bookings
        INNER JOIN account_info
        ON account_info.account_ID = bookings.account_ID
        WHERE account_info.account_ID = '%s'
        ORDER BY date %s, time %s
        LIMIT $limit OFFSET $offset",
            '%b %d %Y',
            '%l:%i %p',
            $value,
            $sortMode,
            $sortMode
        );
    } else {
        return sprintf(
            "SELECT DATE_FORMAT(date,'%s') as date, TIME_FORMAT(time, '%s') as time, 
        state, lname,fname,service,bookings.account_ID,booking_ID,branch,note
         FROM bookings
        INNER JOIN account_info
        ON account_info.account_ID = bookings.account_ID
        WHERE bookings.%s = '%s'
        ORDER BY date %s, time %s
        LIMIT $limit OFFSET $offset",
            '%b %d %Y',
            '%l:%i %p',
            $type,
            $value,
            $sortMode,
            $sortMode
        );
    }
}
