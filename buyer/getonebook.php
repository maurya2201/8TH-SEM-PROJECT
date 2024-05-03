<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    include "../config/connection.php";
    $sql = "SELECT * FROM books WHERE id='$id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(["message" => "Not found"]);
    }
    $conn->close();
} else {
    echo json_encode(["message" => "ID parameter is missing"]);
}
?>
