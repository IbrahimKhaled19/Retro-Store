<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode(file_get_contents('php://input'), true);
$orderId = $data['orderId'];
$status = $data['status'];

$conn = new mysqli('localhost', 'root', '', 'registration_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE orders SET transaction_type='$status' WHERE id='$orderId'";

$response = [];
if ($conn->query($sql) === TRUE) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = $conn->error;
}

$conn->close();

echo json_encode($response);
?>