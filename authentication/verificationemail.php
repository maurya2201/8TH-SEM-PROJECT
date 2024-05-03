<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location:../register.php");
    exit;
}
$userMail = $_SESSION['email'];
require '../vendor/autoload.php';
require '../config/connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$sql = "select otp from users where email='$userMail'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$userOtp = $row['otp'];
$phpmailer = new PHPMailer();
$phpmailer->isSMTP();
$phpmailer->Host = 'sandbox.smtp.mailtrap.io';
$phpmailer->SMTPAuth = true;
$phpmailer->Port = 2525;
$phpmailer->Username = 'f54dafdb7e6979';
$phpmailer->Password = '81cbd378197b6c';
$phpmailer->setFrom("mauryasoni71@gmail.com","Maurya soni");
$phpmailer->addAddress($userMail);
$phpmailer->isHTML(true);                                  
$phpmailer->Subject = 'Verification Email';
$phpmailer->Body    = "Your otp is" .$userOtp.".";
$phpmailer->send();
?>
<?php
include "../config/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputOtp = $_POST['otp'];
    $sql = "SELECT otp FROM users WHERE otp = '$inputOtp'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0){
        $otp = NULL;
        $deleteOtp = "update users set otp='$otp' where email='$userMail';";
        $updateState = "update users set user_state='valid' where email='$userMail';";
        $changeState = $conn->query($updateState);  
        $deleted = $conn->query($deleteOtp);
        header("Location:../login.php");
        session_destroy();
        exit;
    } else {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Toastify({
                    text: "Invalid OTP",
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
    <title>BookHub||Email Verification</title>
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
    <h2>Verify Email</h2>
    <input class="forminput" type="tel" name="otp" placeholder="Enter Your otp">
    <input id="registerbtn" type="submit" name="submit" value="Verify email">
    </form>
</body>
</html>