<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}
include "../config/connection.php";
$id = $_GET['id'];
$checkState = "select user_state from users where user_id='$id';";
$check = $conn->query($checkState);
$result = mysqli_fetch_assoc($check);
$state = $result["user_state"];
if($state==='invalid'){
    $sql = "update users set user_state='valid' where user_id='$id'";
    $stateChange = $conn->query($sql);
    if($stateChange){
    $_SESSION['user_state'] = "User Activated Sucessfully!!";
    header('location:admin.php');
}
}else if($state==='valid'){
    $sql = "update users set user_state='invalid' where user_id='$id'";
    $stateChange = $conn->query($sql);
    if($stateChange){
    $_SESSION['user_state'] = "User Deactivated Sucessfully!!";
    header('location:admin.php');
}}
?>