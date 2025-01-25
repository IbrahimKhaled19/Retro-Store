<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/Dashboard/styles.css">
    <title>Update Product</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Creepster&family=Press+Start+2P&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap");

        body {
            background-color: #f8f9fa;
            font-family: 'Press Start 2P', cursive;
        }
        .container {
            margin-top: 50px;
            max-width: 700px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
<style>
        body,html {
            height: 100vh;
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
            background: url('../../assets/background.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba( 255, 255, 255, 0.18 );
            background: rgba(89, 131, 83, 0.09);
            backdrop-filter: blur( 14px );
        }
        h1 {
            color: #f7f7f7;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            color: #f7f7f7;
        }
    </style>
    <div class="container">
        <h1 class="text-center mb-4">Update Product</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $productId = $_POST['productId'];
            $productName = $_POST['productName'];
            $productPrice = $_POST['productPrice'];
            $productDescription = $_POST['productDescription'];
            $productCategory = $_POST['productCategory'];

            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'registration_db');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "UPDATE products SET name='$productName', price='$productPrice', description='$productDescription', category_id='$productCategory' WHERE id='$productId'";

            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success">Product updated successfully</div>';
            } else {
                echo '<div class="alert alert-danger">Error: ' . $sql . '<br>' . $conn->error . '</div>';
            }

            $conn->close();
        }
        ?>
        <form action="" method="post" novalidate>
            <div class="mb-3">
                <label for="productId" class="form-label">Product ID</label>
                <input type="text" class="form-control" id="productId" name="productId" placeholder="Enter Product ID" required pattern="\d+" title="Product ID must be a number">
            </div>
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter Product Name" required>
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Product Price</label>
                <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Enter Product Price" required min="0" step="0.01">
            </div>
            <div class="mb-3">
                <label for="productDescription" class="form-label">Product Description</label>
                <textarea class="form-control" id="productDescription" name="productDescription" rows="4" placeholder="Enter Product Description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="productCategory" class="form-label">Product Category</label>
                <select class="form-select" id="productCategory" name="productCategory" required>
                    <option value="" disabled selected>Select a category</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Update Product</button>
        </form>
        <a href="../../html/Dashboard/index.html" class="btn btn-secondary w-100">Back to Main Page</a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('http://localhost/web/Sources/php/Dashboard/get-categories.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const categorySelect = document.getElementById('productCategory');
                    data.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.id;
                        option.textContent = category.name;
                        categorySelect.appendChild(option);
                    });
                })
                .catch(error => alert('Error fetching categories: ' + error.message));
        });
    </script>
</body>
</html>
