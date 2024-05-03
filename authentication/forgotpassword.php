<?php
include "../config/connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $_SESSION['email'] = $email;
    $otp = rand(1000,10000);
    $sql = "UPDATE users SET otp='$otp' WHERE email='$email';";
    $result = $conn->query($sql);
    if($result && $conn->affected_rows > 0) {
        header("Location: otppass.php");
    } else {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Toastify({
                text: "Email not found, Please Enter Valid Email",
                className: "info",
                style: {
                    background: "linear-gradient(to right, #eab676e6, #eab676e6)",
                    color: "#000000"
                }
            }).showToast();
        });
    </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub||ForgotPassword</title>
    <link rel="stylesheet" href="../assets/css/verifyemail.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script defer src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js">
    </script>
    <script defer src="../assets/js/registervalidation.js"></script>
</head>
</head>
<body class="container">
    <form class="registerform" id="register" method="post" autocomplete="off">
    <img  height="80px" width="100px" src="../assets/images/bookhub-high-resolution-logo-transparent.png">
    <h2>Forgot Password</h2>
    <input class="forminput" type="email" name="email" placeholder="Enter Your Email">
    <input id="registerbtn" type="submit" name="submit" value="Submit email">
    </form>
</body>
</html>