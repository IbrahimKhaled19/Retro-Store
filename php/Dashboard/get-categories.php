<?php
header('Access-Control-Allow-Origin: *'); 


$conn = new mysqli('localhost', 'root', '', 'registration_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name FROM Categories";
$result = $conn->query($sql);

$categories = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
} else {
    echo "No categories found.";
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($categories);
?>