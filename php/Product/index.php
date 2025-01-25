<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retro Store</title>
    <link rel="stylesheet" href="../../css/Product/style.css">
    <script>
        const products = <?php echo json_encode($products); ?>;
    </script>
    <script src="../../js/Product/script.js" defer></script>
</head>

<body>
    <style>
        .product-image{
            position: relative;
        }
        .product-image::before{
            content: "";
            
            background-color: #323232;
            position: absolute;
            width: 100px;
            height: 100px;
            z-index: -1;
        }
        svg {
            color : #fff;
        }
    </style>
    <header class="header">
        <div class="container" style="display: flex; align-items: center;">
            <img src="../../assets/logo.jpeg" alt="Retro Store Logo" style="width: 50px; height: 50px; margin-right: 10px;">
            <h1 class="logo">Retro Store</h1>
            <div class="icon-cart" style="position: relative; display: flex; align-items: center; margin-left: auto;">
                <div>
                <a href="../../html/Cart/cart.html" style="text-decoration: none;"><svg style=" width: 24px; height: 24px;" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                    </svg></a>
                <span id="cart-count" style="position: absolute; top: 0px; left:20px; background-color: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px; font-weight: bold;">0</span>
                </div>
            </div>
        </div>
    </header>
    <main style="display: flex;">

        <!-- Products -->
        <section class="products">
            <h2 style="color: #fff;">Top Picks</h2>
            <div class="product-list">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <img class='product-image' src="http://localhost/web/Sources/php/Cart/get-image.php?id=<?= $product['id'] ?>"
                            alt="<?= ($product['name']) ?>"
                            class="product-image"
                            style="width: 50%;">
                        <div class="product-details">
                            <h3 class="product-title"><?= ($product['name']) ?></h3>
                            <p class="product-rating">
                                <span>⭐⭐⭐⭐⭐</span> (33)
                            </p>
                            <p class="price">EGP <?= ($product['price']) ?></p>
                            <button class="btn" onclick="addToCart(<?= $product['id'] ?>);updateCartCount();">Add to Cart</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </section>
    </main>
    <script>
        function addToCart(productId) {
            fetch('http://localhost/web/Sources/php/Product/addToCart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        productId
                    }), // JSON payload
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json(); 
                })
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message); 
                    } else {
                        alert(data.message); 
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>

</body>

</html>