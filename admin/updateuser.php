<?php
include "../config/connection.php";
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_POST['user_id'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $mobilenumber = $_POST['mobilenumber'];
        $stmt = $conn->prepare("UPDATE users SET fullname=?, email=?, mobilenumber=? WHERE user_id=?");
        $stmt->bind_param("sssi", $fullname, $email, $mobilenumber, $id);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Update User Sucessfully!!";
            header("Location: admin.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
} else {
    echo "No user found with ID: " . $id;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update-User</title>
    <link rel="stylesheet" href="../assets/css/updateuser.css">
</head>
</head>
<body class="container">
<h4></h4>
    <form class="updateuser" method="post">
    <img  height="80px" width="100px" src="../assets/images/bookhub-high-resolution-logo-transparent.png">
    <input class="forminput" type="text" name="fullname" value="<?php echo $row['fullname']; ?>">
    <input class="forminput" type="email" name="email" value="<?php echo $row['email']; ?>">

    <input class="forminput" type="tel" name="mobilenumber" value="<?php echo $row['mobilenumber']; ?>">
    <button id="updateprofile"  type="submit">Update</button>
    <a id="updateprofile" href="admin.php">Back to Records</a>
    </form>
</body>
</html>

