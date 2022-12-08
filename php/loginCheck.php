<?php
    # CHECKS IF AN ACCOUNT IS ALREADY LOGGED IN
	session_start();
	if(isset($_SESSION["email"]) && isset($_SESSION["password"]))
	{
        header("Location: users/dashboard.php"); 
        exit();
	}
?>