<?php

$conn = new mysqli('localhost', 'root', '', 'registration_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $sql->bind_result($imageData);
    $sql->fetch();

    if ($imageData) {
        header("Content-Type: image/jpeg"); 
        echo $imageData;
    } else {
        http_response_code(404);
        echo "Image not found.";
    }

    $sql->close();
} else {
    http_response_code(400);
    echo "Invalid request.";
}

$conn->close();
?>
