<?php
    $server = "localhost";
    $unmae = "root";
    $dbpass = "";

    $db_name = "jgdc_db";

    $conn = mysqli_connect($server, $unmae, $dbpass, $db_name);

    if(!$conn) {
        die("connection error");
    }
?>