<?php
include "../../db_connect.php";
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: ../../login/index.html");
    exit();
}

$userId = $_SESSION["user_id"];

// Fetch user's cart products using MySQLi
$sql = "select p.* from products p ,cards c where p.id =c.product_id and c.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - GeekStore</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 24px;
        }

        .product-card {
            width: 280px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background-color: #eee;
        }

        .product-info {
            padding: 16px;
        }

        .product-info h3 {
            margin: 0 0 10px;
            font-size: 20px;
        }

        .product-info p {
            margin: 6px 0;
            font-size: 14px;
            color: #555;
        }

        .price {
            color: #27ae60;
            font-weight: bold;
            font-size: 16px;
        }

        .empty-message {
            text-align: center;
            font-size: 18px;
            color: #888;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <h1>Your Cart</h1>

    <?php if ($result->num_rows > 0): ?>
        <div class="card-container">
            <?php while ($product = $result->fetch_assoc()): ?>
                <div class="product-card">
                    <img src="<?php echo $product['image']?>" alt="<?php echo $product['name'] ?>">
                    <div class="product-info">
                        <h3><?php echo $product['name'] ?></h3>
                        <p><?php echo $product['description'] ?></p>
                        <p class="price"><?php echo $product['price'] ?> TND</p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="empty-message">No products in your cart.</p>
    <?php endif; ?>
</body>

</html>