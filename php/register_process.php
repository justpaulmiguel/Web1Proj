<?php
session_start();
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
    //INSERT INTO `accounts` (`Email`, `Password`, `isAdmin`) VALUES ('test2@gmail.com', '12345', '0');
}
mysqli_close($conn);
?>