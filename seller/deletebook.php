<?php
include "../config/connection.php";
session_start();
if (!isset($_SESSION['sid'])) {
    header("Location:../login.php");
    exit;
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_GET['id'];
$sql = "DELETE FROM books WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['delete_book_message'] = "Deleted Book Sucessfully!!";
    header("Location: seller.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    header("Location: seller.php");
}
$conn->close();    
?>