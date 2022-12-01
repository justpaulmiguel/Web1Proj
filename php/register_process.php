<?php
require "dbConnect.php";
include "loginCheck.php";
	
$email = $_POST["emailSignup"];
$pass = $_POST["passSignup"];
$passConf = $_POST["passSignupConfirm"];
$query = "SELECT * FROM accounts WHERE Email='$email'";
$result = mysqli_query($conn,$query);
$count =  mysqli_num_rows($result);

# ACCOUNT VALIDATION
if($count==1){
    session_unset();
    session_destroy();
    header("refresh: 0; url=../index.php");
    echo ("<script>alert('Email is already used!')</script>");
}
else{
    $query = "SELECT * FROM emp_info WHERE Email='$email'";
    $result = mysqli_query($conn,$query);
    $count2 =  mysqli_num_rows($result);

    if ($count2==1) {

        $query = "INSERT INTO accounts (`Email`, `Password`, `isAdmin`) VALUES ('$email', '$pass', '1');";

        if (mysqli_query($conn, $query)) {
            session_unset();
            session_destroy();
            header("refresh: 0; url=../index.php");
            echo ("<script>alert('Admin Account Succesfully Created!')</script>");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        

    } else {

        $query = "INSERT INTO accounts (`Email`, `Password`, `isAdmin`) VALUES ('$email', '$pass', '0');";

        if (mysqli_query($conn, $query)) {
            session_unset();
            session_destroy();
            header("refresh: 0; url=../index.php");
            echo ("<script>alert('User Account Succesfully Created!')</script>"); 
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

}
mysqli_close($conn);
?>