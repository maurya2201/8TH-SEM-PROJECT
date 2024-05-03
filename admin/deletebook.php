<?php
include "../config/connection.php";
session_start();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!isset($_GET['id'])) {
    die("Book ID is missing in the URL parameter.");
}
$id = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "DELETE FROM books WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    $_SESSION['delete_book_message'] = "Deleted Book Sucessfully!!";
    header("Location: books.php");
    exit;
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
