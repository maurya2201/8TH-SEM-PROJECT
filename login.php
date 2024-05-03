<?php
session_start();
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($email === "admin@gmail.com" && $password === "admin@1234") {
        $_SESSION['admin'] = "loggedIn";
        header('location:./admin/admin.php');
    } else {
        include "./config/connection.php";
        $password = md5($_POST['password']);
        $sql = "select * from users where email='$email' and password='$password'";
        $result = $conn->query($sql);
        $check = mysqli_fetch_array($result);
        if (!$check) {
            echo '
        <script>
        document.addEventListener("DOMContentLoaded", function() {
        Toastify({
        text: "Please Enter valid credentials",
        className: "info",
        style: {
        background: "linear-gradient(to right, #eab676e6, #eab676e6)",
        color: "#000000"
        }}).showToast();
        });</script>';
        } else {
            $state = $check['user_state'];
            $otp = $check['otp'];
            if ($state === 'invalid') {
                echo '
                <script>
                document.addEventListener("DOMContentLoaded", function() {
                Toastify({
                text: "Please contact admin to activate your account!",
                className: "info",
                style: {
                background: "linear-gradient(to right, #eab676e6, #eab676e6)",
                color: "#000000"
                }}).showToast();
                });</script>';
            } elseif ($otp) {
                echo '
                <script>
                document.addEventListener("DOMContentLoaded", function() {
                Toastify({
                text: "Email not verified!",
                className: "info",
                style: {
                background: "linear-gradient(to right, #eab676e6, #eab676e6)",
                color: "#000000"
                }}).showToast();
                });</script>';           
            } else {
                $userType = $check['user_type_id'];
                $id = $check['user_id'];
                switch ($userType) {
                    case 1:
                        $_SESSION["sid"] = $id;
                        header("location:./seller/seller.php");
                        break;
                    case 2:
                        $_SESSION["bid"] = $id;
                        header("location:./buyer/buyer.php");
                        break;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub||Login</title>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script defer src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script defer src="./assets/js/loginvalidation.js"></script>
</head>

<body class="container">
    <form class="loginform" id="login" method="post" autocomplete="off">
        <img height="80px" width="100px" src="./assets/images/bookhub-high-resolution-logo-transparent.png">
        <h2>Login</h2>
        <input class="forminput" type="email" name="email" placeholder="Enter Your Email">
        <input class="forminput" type="password" name="password" placeholder="Enter Your Password">
        <pre>Don't have an account?<a href="register.php">Register</a></pre>
        <br>
        <pre><a href="./authentication/forgotpassword.php">Forgotten password?</a></pre>
        <input id="registerbtn" type="submit" name="submit" value="Login">
    </form>
</body>

</html>