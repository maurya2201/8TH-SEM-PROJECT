<?php
header('Content-type:application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:GET');
include "../config/connection.php";

$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $rows = array();
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    echo json_encode(["message" => "No books available here"]);
}

?>
