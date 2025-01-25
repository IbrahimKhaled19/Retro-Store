<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/Dashboard/styles.css">
    <title>Add Product</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Creepster&family=Press+Start+2P&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap");

        body {
            background-color: #f8f9fa;
            font-family: 'Press Start 2P', cursive;
            background: url('../../assets/background.jpg') no-repeat center center;
            background-size: cover;
            z-index: -1;
        }

        .container {
            margin-top: 50px;
            max-width: 600px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(89, 131, 83, 0.09);
            backdrop-filter: blur(14px);
        }

        h1 {
            color: #f8f9fa;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-primary,
        .btn-secondary {
            width: 100%;
        }

        label {
            color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Add Product</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $productName = $_POST['productName'];
            $productPrice = $_POST['productPrice'];
            $productDescription = $_POST['productDescription'];
            $productCategory = $_POST['productCategory'];
        
            if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
                $imageTmpName = $_FILES['productImage']['tmp_name'];
                $imageData = file_get_contents($imageTmpName);
        
                if ($imageData === false) {
                    echo '<div class="alert alert-danger">Error reading the image file.</div>';
                    exit;
                }
        
                $conn = new mysqli('localhost', 'root', '', 'registration_db');
        
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
        
                $Query = $conn->prepare("INSERT INTO products (name, price, description, category_id, image) VALUES (?, ?, ?, ?, ?)");
                $Query->bind_param("sdsss", $productName, $productPrice, $productDescription, $productCategory, $imageData);
        
                if ($Query->execute()) {
                    echo '<div class="alert alert-success">New product added successfully</div>';
                } else {
                    echo '<div class="alert alert-danger">Database Insertion Error: ' . $Query->error . '</div>';
                }
        
                $Query->close();
                $conn->close();
            } else {
                echo '<div class="alert alert-danger">Please upload a valid image.</div>';
            }
        }
        
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required>
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Product Price</label>
                <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Enter product price" required>
            </div>
            <div class="mb-3">
                <label for="productDescription" class="form-label">Product Description</label>
                <textarea class="form-control" id="productDescription" name="productDescription" placeholder="Enter product description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="productImage" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="productImage" name="productImage" required>
            </div>
            <div class="mb-3">
                <label for="productCategory" class="form-label">Product Category</label>
                <select class="form-select" id="productCategory" name="productCategory" required>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Add Product</button>
        </form>

        <a href="../../html/Dashboard/index.html" class="btn btn-secondary">Back to Main Page</a>
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
                    console.log(data); // Debugging output
                    const categorySelect = document.getElementById('productCategory');
                    data.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.id;
                        option.textContent = category.name;
                        categorySelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching categories:', error));
        });
    </script>
</body>

</html>