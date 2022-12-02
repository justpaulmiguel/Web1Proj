<?php
	session_start();
	if(!isset($_SESSION["email"]) && !isset($_SESSION["password"]) && !isset($_SESSION["permissionLvl"]))
	{
	header('Location: ../index.php');
	exit();
	}
  if($_SESSION["permissionLvl"]==0){
    header("Location: ../users/user.php"); 
	  exit();
  }
?>

<?php require("partials/head.php") ?>


<main>
  <h1>Hello World!</h1>
</main>


<?php require("partials/footer.php") ?>