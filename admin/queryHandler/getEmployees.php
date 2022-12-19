<?php


$query = "SELECT accounts.permissionLvl,
account_info.email, account_info.lname,account_info.fname,account_info.account_ID,contactNo
FROM accounts
INNER JOIN account_info
ON accounts.email = account_info.email
WHERE accounts.permissionLvl >0
ORDER BY accounts.permissionLvl DESC, account_info.account_ID ASC;

";
require("../php/dbConnect.php");
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) <= 0) {
    echo showModalError("Can't Retrieve Emails");
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($employees, $row);
    }
}
mysqli_close($conn);
