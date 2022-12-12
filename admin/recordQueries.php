<?php
// todo
// query the count of this query first
// then add pagination
// decouple the pagination


// make a file that collates all requests in the records
// make it a function

/***
 * Returns the count of a query
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


function getCountQuery($type, $value)
{
    if ($type == 'email') {
        return sprintf("SELECT COUNT(*) FROM account_info WHERE email = '%s'", $value);
    } else {
        $conditional = $type == 'date' ? '<=' : '=';
        return sprintf("SELECT COUNT(*) FROM bookings WHERE %s %s '%s'", $type, $conditional, $value);
    }
}

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
