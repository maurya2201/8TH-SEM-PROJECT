<?php
session_start(); 
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}
include "../config/connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['form_data'] = $_POST; 

    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $mobilenumber = $_POST["mobilenumber"];
    $userType = $_POST["userType"];

    if (empty($fullname) || empty($email) || empty($password) || empty($confirmpassword) || empty($mobilenumber) || empty($userType)) {
        header("Location: adduser.php");
        exit;
    }

    if ($password != $confirmpassword) {
        $_SESSION['message'] = "Password and Confirm Password do not match!";
        header("Location: adduser.php");
        exit;
    }

    $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        $_SESSION['alert_message'] = "Email is already taken!";
        header("Location: adduser.php");
        exit;
    }

    $hashedPassword = md5($password);

    $sql = "INSERT INTO users (fullname, email, password, mobilenumber, user_type_id,user_state) VALUES ('$fullname', '$email', '$hashedPassword', '$mobilenumber', '$userType','valid')";

    if($conn->query($sql) === TRUE) {
        $_SESSION['email'] = $email;
        header("Location: admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="../assets/css/adduser.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script defer src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js">
    </script>
    <script defer src="../assets/js/adduservalidation.js"></script>
</head>
</head>
<body class="container">
    <form class="adduser" id="register" method="post">
    <img  height="80px" width="100px" src="../assets/images/bookhub-high-resolution-logo-transparent.png">
    <h2>Add User</h2>
    <input class="forminput" type="text" name="fullname" placeholder="Enter Your FullName" value="<?php echo isset($_SESSION['form_data']['fullname']) ? $_SESSION['form_data']['fullname'] : ''; ?>">
    <input class="forminput" type="email" name="email" placeholder="Enter Your Email" value="<?php echo isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : ''; ?>">
    <input class="forminput" type="password" name="password" placeholder="Enter Your Password">
    <input class="forminput" type="password" name="confirmpassword" placeholder="Enter Confirm Password">
    <input class="forminput" type="tel" name="mobilenumber" placeholder="Enter Your PhoneNumber"  value="<?php echo isset($_SESSION['form_data']['mobilenumber']) ? $_SESSION['form_data']['mobilenumber'] : ''; ?>">
    <select id="options" name="userType">
    <option value="">Select Role</option>
    <option value="1">Seller</option>
    <option value="2">Buyer</option>
    </select>
    <input id="adduser" type="submit" name="submit" value="Add User">
    <a id="adduser" href="admin.php">Back to Home</a>
    </form>
    <?php
    if (isset($_SESSION['alert_message'])) {

        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Toastify({
                    text: "' . $_SESSION['alert_message'] . '",
                    className: "info",
                    style: {
                        background: "linear-gradient(to right, #eab676e6, #eab676e6)",
                        color: "#000000"
                    }
                }).showToast();
            });
        </script>';
        unset($_SESSION['alert_message']); 
        unset($_SESSION['form_data']['fullname']);
        unset($_SESSION['form_data']['email']);
        unset($_SESSION['form_data']['password']);
        unset($_SESSION['form_data']['confirmpassword']);
        unset($_SESSION['form_data']['mobilenumber']);
        unset($_SESSION['form_data']['userType']);
    }

    if (isset($_SESSION['message'])) {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Toastify({
                    text: "' . $_SESSION['message'] . '",
                    className: "info",
                    style: {
                        background: "linear-gradient(to right, #eab676e6, #eab676e6)",
                        color: "#000000"
                    }
                }).showToast();
            });
        </script>';
        unset($_SESSION['message']); 
        unset($_SESSION['form_data']['fullname']);
        unset($_SESSION['form_data']['email']);
        unset($_SESSION['form_data']['password']);
        unset($_SESSION['form_data']['confirmpassword']);
        unset($_SESSION['form_data']['mobilenumber']);
        unset($_SESSION['form_data']['userType']);
    }
    ?>
</body>
</html>