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
    return mysqli_num_rows($result);
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
        return     sprintf("SELECT * FROM account_info
        WHERE email = '%s'
        LIMIT $limit OFFSET $offset", $value);
    } else if ($type == 'date') {
        return sprintf("SELECT * FROM bookings
        INNER JOIN account_info
        ON account_info.account_ID = bookings.account_ID
        WHERE bookings.%s >= '%s'
        ORDER BY date %s, time %s
        LIMIT $limit OFFSET $offset", $type, $value, $sortMode, $sortMode);
    } else {
        return sprintf("SELECT * FROM bookings
        INNER JOIN account_info
        ON account_info.account_ID = bookings.account_ID
        WHERE bookings.%s = '%s'
        ORDER BY date %s, time %s
        LIMIT $limit OFFSET $offset", $type, $value, $sortMode, $sortMode);
    }
}
