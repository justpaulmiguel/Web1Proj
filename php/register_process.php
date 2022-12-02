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
    ?>
    <script>
        Swal.fire({
        icon: 'error',
        text: 'EMAIL ALREADY USED!',
        confirmButtonColor: '#e05c2a'
        })
    </script>
    <?php
}
else{
    $query = "SELECT * FROM emp_info WHERE Email='$email'";
    $result = mysqli_query($conn,$query);
    $count2 =  mysqli_num_rows($result);

    if ($count2==1) {

        $query = "INSERT INTO accounts (`email`, `password`, `isAdmin`) VALUES ('$email', '$pass', '1');";

        if (mysqli_query($conn, $query)) {
            session_unset();
            session_destroy();
            ?>
            <script>
                Swal.fire({
                icon: 'success',
                text: 'ADMIN ACCOUNT SUCCESFULLY CREATED!',
                confirmButtonColor: '#e05c2a'
                }).then(function() {
                    window.location = "index.php";
                });
            </script>
            <?php
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        

    } else {

        $query = "INSERT INTO accounts (`Email`, `Password`, `isAdmin`) VALUES ('$email', '$pass', '0');";

        if (mysqli_query($conn, $query)) {
            session_unset();
            session_destroy();
            ?>
            <script>
                Swal.fire({
                icon: 'success',
                text: 'USER ACCOUNT SUCCESFULLY CREATED!',
                confirmButtonColor: '#e05c2a'
                }).then(function() {
                    window.location = "index.php";
                });
            </script>"
            <?php
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

}
mysqli_close($conn);
?>