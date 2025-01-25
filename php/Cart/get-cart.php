<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

session_start(); // Start the session to access user_id

// Database connection
$conn = new mysqli('localhost', 'root', '', 'registration_db');

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
}

// Check if user_id is set
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];// Get the user_id from the session

// Prepare and execute the query
$sql = "SELECT id, product_id, quantity, product_name, product_price FROM shoppingcart WHERE user_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['error' => 'Failed to prepare query: ' . $conn->error]);
    exit;
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch results into an array
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$stmt->close();
$conn->close();

// Return the products as JSON
echo json_encode($products);
?>
