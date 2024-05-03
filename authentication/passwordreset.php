<?php
include "../config/connection.php";
session_start();
if (!isset($_SESSION['email'])) {
  header("Location:../login.php");
  exit;
}
$email = $_SESSION['email'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    $hashedPassword = md5($password);
    $sql = "update users set password='$hashedPassword' where email='$email';";
    $result = $conn->query($sql);
    if($result){
      header('Location:../login.php');
      session_destroy();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub||Password Reset</title>
    <link rel="stylesheet" href="../assets/css/verifyemail.css">
    <script defer src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js">
    </script>
    <script defer src="../assets/js/registervalidation.js"></script>
</head>
</head>
<body class="container">
    <form class="registerform" id="register" method="post" autocomplete="off">
    <img  height="80px" width="100px" src="../assets/images/bookhub-high-resolution-logo-transparent.png">
    <h2>Password Reset</h2>
    <input class="forminput" type="password" name="password" placeholder="Enter Your Password">
    <input id="registerbtn" type="submit" name="submit" value="Password reset">
    </form>
</body>
</html>