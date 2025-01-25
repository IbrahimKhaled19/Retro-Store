<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration_db";
$user_id = $_SESSION['user_id'];
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT product_id, quantity FROM shoppingcart WHERE user_id = ?";
$Query = $conn->prepare($sql);
$Query->bind_param("i", $user_id);
$Query->execute();
$result = $Query->get_result();


$total_price = 0;
while ($row = $result->fetch_assoc()) {
    
    $total_price += getProductPrice($row['product_id']) * $row['quantity'];
}


$sql = "INSERT INTO orders (user_id, total_price, transaction_type) VALUES (?, ?, 'pending')";
$Query = $conn->prepare($sql);
$Query->bind_param("id", $user_id, $total_price);
$Query->execute();
$order_id = $Query->insert_id;


$sql = "DELETE FROM shoppingcart WHERE user_id = ?";
$Query = $conn->prepare($sql);
$Query->bind_param("i", $user_id);
$Query->execute();

$conn->close();

header('Content-Type: application/json');
echo json_encode(array('success' => true));

function getProductPrice($product_id) {
    global $conn;
    $sql = "SELECT price FROM products WHERE id = ?";
    $Query = $conn->prepare($sql);
    $Query->bind_param("i", $product_id);
    $Query->execute();
    $result = $Query->get_result();
    $row = $result->fetch_assoc();
    return $row['price'];
}
?>