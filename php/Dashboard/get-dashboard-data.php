<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');


$conn = new mysqli('localhost', 'root', '', 'registration_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$productCountResult = $conn->query("SELECT COUNT(*) AS count FROM products");
$productCount = $productCountResult->fetch_assoc()['count'];


$orderCountResult = $conn->query("SELECT COUNT(*) AS count FROM orders");
$orderCount = $orderCountResult->fetch_assoc()['count'];

$categoryCountResult = $conn->query("SELECT COUNT(*) AS count FROM categories");
$categoryCount = $categoryCountResult->fetch_assoc()['count'];

$conn->close();

echo json_encode([
    'productCount' => $productCount,
    'orderCount' => $orderCount,
    'categoryCount' => $categoryCount
]);
?>