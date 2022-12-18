<?php
require "dbConnect.php";
include "loginCheck.php";

$fname = $_POST["fnameSignup"];
$lname = $_POST["lnameSignup"];
$email = $_POST["emailSignup"];
$pass = $_POST["passSignup"];
$passHash = password_hash($pass, PASSWORD_DEFAULT);
$contact = $_POST["contactSignup"];
$query = "SELECT * FROM accounts WHERE Email='$email'";
$result = mysqli_query($conn, $query);
$count =  mysqli_num_rows($result);

if ($count == 1) {
?>
    <script>
        Swal.fire({
            icon: 'error',
            text: 'EMAIL ALREADY USED!',
            confirmButtonColor: '#e05c2a'
        })
    </script>
    <?php
} else {
    $query = "INSERT INTO accounts (`email`, `password`, `permissionLvl`) 
    VALUES ('$email', '$passHash', '0');";

    if (mysqli_query($conn, $query)) {

        $query = "INSERT INTO account_info (`fname`, `lname`, `contactNo`, `email`) 
        VALUES ('$fname', '$lname', '$contact', '$email');";

        mysqli_query($conn, $query);

        session_unset();
        session_destroy();
    ?>
        <script>
            Swal.fire({
                icon: 'success',
                text: 'Account Successfully Created! Please login now with your account',
                confirmButtonColor: '#e05c2a'
            }).then(function() {
                window.location = "index.php";
            });
        </script>
    <?php
    } else {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                text: 'Email Already Used!',
                confirmButtonColor: '#e05c2a'
            })
        </script>
<?php
    }
}

mysqli_close($conn);
?>