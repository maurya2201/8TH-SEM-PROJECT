<?php
session_start();
include "../config/connection.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!isset($_GET['id'])) {
    die("User ID is missing in the URL parameter.");
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "DELETE FROM users WHERE user_id = $id";
if ($conn->query($sql) === TRUE) {
    $_SESSION['alert_message'] = "Delete User Sucessfully!!";
    header("Location: admin.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
