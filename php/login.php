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
        ?>
        <script>
            Swal.fire({
            icon: 'success',
            text: 'Success!',
            confirmButtonColor: '#e05c2a'
            }).then(function() {
                window.location = "admin/dashboard.php";
            });
        </script>");
        <?php
    } else {
        $_SESSION["isAdmin"] = $isAdmin[0];
        ?>
        <script>
            Swal.fire({
            icon: 'success',
            text: 'Success!',
            confirmButtonColor: '#e05c2a'
            }).then(function() {
                window.location = "users/user.php";
            });
        </script>");
        <?php
    }
    
}
else{
    header("refresh: 0; url=../index.php");
    ?>
    <script>
        Swal.fire({
        icon: 'error',
        text: 'EMAIL OR PASSWORD IS INCORRECT!',
        confirmButtonColor: '#e05c2a'
        })
    </script>");
    <?php
}
mysqli_close($conn);
?>
confirmButtonText: '<a href="url">LINK</a>'