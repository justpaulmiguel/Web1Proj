<?php
session_start();
require "dbConnect.php";
if(isset($_SESSION["emailLogin"]) && isset($_SESSION["passLogin"])){
    header("Location: menu.php");
    exit();
}	
$email = $_POST["emailLogin"];
$pass = $_POST["passLogin"];
$query = "SELECT * FROM accounts WHERE Email='$email'and Password='$pass'";
$result = mysqli_query($conn,$query);
$count =  mysqli_num_rows($result);
if($count==1){
    $_SESSION["email"] = $email;
    $_SESSION["password"] = $pass;
    header("Location: ../users/user.php");
}
else{
    header("refresh: 0; url=../index.php");
    echo ("<script>alert('Email or Password is Incorrect.')</script>");
}
mysqli_close($con);
?>