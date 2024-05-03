<?php
$servername = "localhost";
$username = 'root';
$password = '';
$database = 'bookhub';

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error) {
    die('Connected failed: ' . $conn->connect_error);
}
?>