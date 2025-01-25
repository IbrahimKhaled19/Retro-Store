<?php
header('Content-Type: application/json');
$conn = new mysqli('localhost', 'root', '', 'registration_db');
session_start();
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $productId = $input['productId'] ?? null;

    if ($productId) {
        
        $userId = $_SESSION['user_id']; 

        
        $checkQuery = "SELECT quantity FROM shoppingcart WHERE user_id = ? AND product_id = ?";
        $checkQuery = $conn->prepare($checkQuery);
        $checkQuery->bind_param("ii", $userId, $productId);
        $checkQuery->execute();
        $result = $checkQuery->get_result();

        if ($result->num_rows > 0) {
            
            $updateQuery = "UPDATE shoppingcart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?";
            $updateQuery = $conn->prepare($updateQuery);
            $updateQuery->bind_param("ii", $userId, $productId);
            $updateQuery->execute();

            echo json_encode(["status" => "success", "message" => "Product quantity updated in cart"]);
        } else {
            
            $query = "SELECT name, price FROM products WHERE id = ?";
            $query = $conn->prepare($query);
            $query->bind_param("i", $productId);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
                $insertQuery = "INSERT INTO shoppingcart (user_id, product_id, product_name, product_price, quantity) VALUES (?, ?, ?, ?, 1)";
                $insertQuery = $conn->prepare($insertQuery);
                $insertQuery->bind_param("iisd", $userId, $productId, $product['name'], $product['price'] );
                $insertQuery->execute();

                echo json_encode(["status" => "success", "message" => "Product added to cart"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Product not found"]);
            }
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid product ID"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
$conn->close();
