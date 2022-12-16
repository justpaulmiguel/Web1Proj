<?php
session_start();
require "dbConnect.php";
if (isset($_SESSION["emailLogin"]) && isset($_SESSION["passLogin"])) {
    header("Location: menu.php");
    exit();
}
$email = $_POST["emailLogin"];
$pass = $_POST["passLogin"];
$query = "SELECT * FROM accounts WHERE email='$email'";
$result = mysqli_query($conn, $query);
$count =  mysqli_num_rows($result);

# ACCOUNT VALIDATION
if ($count == 1) {
    $query = "SELECT password FROM accounts WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    $passHash = mysqli_fetch_array($result);

    if (password_verify($pass, $passHash[0])) {

        $_SESSION["email"] = $email;
        $_SESSION["password"] = $pass;
        $query = "SELECT permissionLvl FROM accounts WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        $permissionLvl = mysqli_fetch_array($result);
        # PERMISSION LEVEL CHECK
        if ($permissionLvl[0] > 0) {
            $_SESSION["permissionLvl"] = $permissionLvl[0];
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
            $_SESSION["permissionLvl"] = $permissionLvl[0];
        ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'Success!',
                    confirmButtonColor: '#e05c2a'
                }).then(function() {
                    window.location = "patient/dashboard.php";
                });
            </script>");
        <?php
        }
    } else {
        header("refresh: 0; url=../index.php");
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                text: 'PASSWORD IS INCORRECT!',
                confirmButtonColor: '#e05c2a'
            })
        </script>");
    <?php
    }
} else {
    header("refresh: 0; url=../index.php");
    ?>
    <script>
        Swal.fire({
            icon: 'error',
            text: "ACCOUNT DOESN'T EXIST!",
            confirmButtonColor: '#e05c2a'
        })
    </script>");
<?php
}
mysqli_close($conn);
?>