<?php
include "../db_connect.php";
session_start();

$userId = $_SESSION["user_id"];

// Fetch user's card products
$query = $pdo->prepare("
    SELECT p.* 
    FROM cards c
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = :user_id
");
$query->execute(['user_id' => $userId]);
$cards = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .product-card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 12px;
            margin: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-info {
            padding: 16px;
        }
        .product-info h3 {
            margin: 0 0 8px;
        }
        .product-info p {
            margin: 4px 0;
        }
        .price {
            font-weight: bold;
            color: #2c7;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Your Cart</h1>
    <div class="card-container">
        <?php if ($cards): ?>
            <?php foreach ($cards as $product): ?>
                <div class="product-card">
                    <?php if (!empty($product['image'])): ?>
                        <img src="../img/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <?php else: ?>
                        <img src="../img/default.jpg" alt="No image">
                    <?php endif; ?>
                    <div class="product-info">
                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <p><?= htmlspecialchars($product['description']) ?></p>
                        <p class="price"><?= htmlspecialchars($product['price']) ?> TND</p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center;">No products in your cart.</p>
        <?php endif; ?>
    </div>
</body>
</html>
