<?php
include "../config/connection.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_GET['id'];
$sql = "DELETE FROM orders WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: myorder.php");
} else {
    header("Location: myorder.php");
}
$conn->close();    
?>