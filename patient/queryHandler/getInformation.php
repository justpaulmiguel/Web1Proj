<?php

$query = sprintf("SELECT * FROM account_info WHERE email='%s' LIMIT 1;", $_SESSION['email']);

require("../php/dbConnect.php");
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) <= 0) {
    echo showModalError("Can't Retrieve Account Details");
} else {
    $account = mysqli_fetch_array($result);
}
mysqli_close($conn);
