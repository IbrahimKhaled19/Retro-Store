<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/Dashboard/styles.css">
    <title>Delete Product</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Creepster&family=Press+Start+2P&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap");

        body {
            background-color: #f8f9fa;
            font-family: 'Press Start 2P', cursive;
            background: url('../../assets/background.jpg') no-repeat center center fixed;
        }
        h1{
            color: #f8f9fa;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            max-width: 500px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(14px) !important;
        }

        .btn-danger {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Delete Product</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $productId = $_POST['productId'];

            
            $conn = new mysqli('localhost', 'root', '', 'registration_db');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "DELETE FROM products WHERE id='$productId'";

            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success">Product deleted successfully</div>';
            } else {
                echo '<div class="alert alert-danger">Error: ' . $sql . '<br>' . $conn->error . '</div>';
            }

            $conn->close();
        }
        ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="productId" class="form-label">Product ID</label>
                <input type="text" class="form-control" id="productId" name="productId" placeholder="Enter Product ID" required>
            </div>
            <button type="submit" class="btn btn-danger mb-3">Delete Product</button>
        </form>
        <a href="../../html/Dashboard/index.html" class="btn btn-secondary w-100">Back to Main Page</a>
    </div>
</body>
</html>
