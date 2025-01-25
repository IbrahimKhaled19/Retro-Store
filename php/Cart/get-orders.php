<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');


$conn = new mysqli('localhost', 'root', '', 'registration_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, user_id, total_price, transaction_type FROM orders WHERE transaction_type = 'pending'";
$result = $conn->query($sql);

$orders = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

$conn->close();

echo json_encode($orders);
?>