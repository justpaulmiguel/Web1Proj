<?php
	session_start();
	if(!isset($_SESSION["email"]) && !isset($_SESSION["password"]) && !isset($_SESSION["isAdmin"]))
	{
	header('Location: ../index.php');
	exit();
	}
  if($_SESSION["isAdmin"]!=1){
    header("Location: ../users/user.php"); 
	  exit();
  }
?>

<?php require("partials/head.php") ?>


<main>
  <h1>Hello World!</h1>
</main>


<?php require("partials/footer.php") ?>