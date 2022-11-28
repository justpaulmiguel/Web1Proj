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

# ACCOUNT VALIDATION
if($count==1){
    $_SESSION["email"] = $email;
    $_SESSION["password"] = $pass;
    $query = "SELECT isAdmin FROM accounts WHERE Email='$email'and Password='$pass'";
    $result = mysqli_query($conn,$query);
    $isAdmin = mysqli_fetch_array($result);
    # ADMIN ACCOUNT CHECK
    if($isAdmin[0])  {
        $_SESSION["isAdmin"] = $isAdmin[0];
        header("Location: ../admin/dashboard.php");
    } else {
        $_SESSION["isAdmin"] = $isAdmin[0];
        header("Location: ../users/user.php"); 
    }
    
}
else{
    header("refresh: 0; url=../index.php");
    echo ("<script>alert('Email or Password is Incorrect.')</script>");
}
mysqli_close($conn);
?>