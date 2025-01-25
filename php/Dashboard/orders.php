<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/Dashboard/styles.css">
    <title>Orders</title>
</head>
<body>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Creepster&family=Press+Start+2P&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap");

        body {
            
            background-color: #f8f9fa;
            font-family: 'Press Start 2P', cursive;
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
    </style>
    <div class="container">
        <h1>Pending Orders</h1>
        <div id="ordersContainer"></div>
        <a href="../../html/Dashboard/index.html" class="btn btn-secondary mt-3 text-center">Back to Main Page</a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('http://localhost/web/Sources/php/Dashboard/get-orders.php')
                .then(response => response.json())
                .then(data => {
                    const ordersContainer = document.getElementById('ordersContainer');
                    data.forEach(order => {
                        const orderCard = document.createElement('div');
                        orderCard.className = 'card mb-3';
                        orderCard.innerHTML = `
                            <div class="card-body">
                                <h5 class="card-title">Order ID: ${order.id}</h5>
                                <p class="card-text">Customer: ${order.user_id}</p>
                                <p class="card-text">Total: $${order.total_price}</p>
                                <p class="card-text">Status: ${order.transaction_type}</p>
                                <button class="btn btn-success" onclick="updateOrderStatus(${order.id}, 'accepted')">Accept</button>
                                <button class="btn btn-danger" onclick="updateOrderStatus(${order.id}, 'denied')">Deny</button>
                            </div>
                        `;
                        ordersContainer.appendChild(orderCard);
                    });
                })
                .catch(error => console.error('Error fetching orders:', error));
        });

        function updateOrderStatus(orderId, status) {
            fetch('http://localhost/web/Sources/php/Dashboard/update-order-status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ orderId, status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Order status updated successfully');
                    location.reload();
                } else {
                    alert('Error updating order status');
                }
            })
            .catch(error => console.error('Error updating order status:', error));
        }
    </script>
</body>
</html>