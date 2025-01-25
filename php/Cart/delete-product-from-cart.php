<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $productId = $input['productId'];

    $conn = new mysqli('localhost', 'root', '', 'registration_db');

    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
        exit;
    }

    $sql = $conn->prepare("DELETE FROM shoppingcart WHERE product_id = ?");
    $sql->bind_param('i', $productId);

    if ($sql->execute()) {
        echo json_encode(['success' => true, 'message' => 'Cart updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $sql->error]);
    }

    $sql->close();
    $conn->close();
}
?>