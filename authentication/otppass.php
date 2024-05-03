<?php
session_start();
if(!isset($_SESSION['email'])) {
header("Location:../login.php");
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
$phpmailer->Subject = 'Forgot Password';
$phpmailer->Body = "Your otp is".$userOtp.".";
$phpmailer->send();
?>
<?php
include "../config/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputOtp = $_POST['otp'];
    $sql = "select otp from users where otp = '$inputOtp'";
    $result = $conn->query($sql);
    if($result && $result->num_rows > 0) {
        $otp = NULL;
        $deleteOtp = "update users set otp='$otp' where email='$userMail';";
        $deleted = $conn->query($deleteOtp);
        header("Location:passwordreset.php");
        exit();
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
    <title>BookHub||Forgot Password</title>
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
    <input class="forminput" type="tel" name="otp" placeholder="Enter Your otp">
    <input id="registerbtn" type="submit" name="submit" value="Submit otp">
    </form>
</body>
</html>