<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
$data = json_decode(file_get_contents("php://input"), true);
if (!$data || !isset($data['id'], $data['name'], $data['image'], $data['quantity'], $data['buyerId'], $data['totalprice'], $data['sellerId'])) {
    echo json_encode(["error" => "Invalid JSON data"]);
    exit;
}
$bookId = $data['id'];
$name = $data['name'];
$image = $data['image'];
$quantity = $data['quantity'];
$buyerId = $data['buyerId'];
$totalPrice = $data['totalprice'];
$sellerId = $data['sellerId'];
include "../config/connection.php";
$sql = "INSERT INTO orders (book_id, name, image, quantity, buyer_id, totalprice, seller_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssiidi", $bookId, $name, $image, $quantity, $buyerId, $totalPrice, $sellerId);
if ($stmt->execute()) {
    echo json_encode(["message" => "Inserted successfully"]);
} else {
    echo json_encode(["error" => "Failed to insert data: " . $conn->error]);
}
$stmt->close();
$conn->close();
?>
