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
$sql = "select p.*,c.id as cid,c.quantity as cq from products p ,cart c where p.id =c.product_id and c.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$somme = 0;

if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $address = $_POST['address'];
    $paymentMethod = $_POST['payment-method'];
    $totalPrice = $_POST['total-price'];

    // Insert order into the database
    $sql = "INSERT INTO orders (user_id, address, payment_method, total_price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issd", $userId, $address, $paymentMethod, $totalPrice);

    if ($stmt->execute()) {
        $sql = "DELETE FROM cart WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        header("Location: trans.php");
        exit();
    } else {
        echo "Error placing order: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - GeekStore</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <a href="#"><img src="../../img/whitelogo.png" alt="GeekStore Logo" class="logo"></a>
        <nav class="navbar">
            <a href="../HomePage/index.php">Home</a>
            <a href="../HomePage/index.php">Shop</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
            <a href="../card/main.php">card</a>
            <form class="logout-form" action="logout.php" method="post">
                <button type="submit" name="logout" class="submit">
                    <i class="fa-solid fa-right-to-bracket"></i></button>
            </form>
        </nav>
    </header>
    <h1>Your Cart</h1>
    <?php if ($result->num_rows > 0): ?>
        <div class="card-container">
            <?php while ($product = $result->fetch_assoc()): $somme = $somme + $product['price'] * $product['cq']; ?>
                <div class="product-card">
                    <img src="<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>">
                    <div class="product-info">
                        <h3><?php echo $product['name'] ?></h3>
                        <p><?php echo $product['description'] ?></p>
                        <p class="price"><?php echo $product['price'] ?> TND</p>
                        <p class="quantity"><?php echo $product['cq'] ?></p>
                        <p class="total-price">Total: <?php echo $product['price'] * $product['cq'] ?> TND</p>
                    </div>
                    <form action="del.php" method="get">
                        <input type="hidden" value="<?php echo $product['cid'] ?>" name="id">
                        <button type="submit">remove</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="checkout-container">
            <form action="" method="post">
                <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
                <label for="payment-method">Payment Method:</label>
                <select id="payment-method" name="payment-method" required>
                    <option value="credit-card">Credit Card</option>
                    <option value="paypal">Pay cash on delivery</option>
                    <option value="bank-transfer">Credit Card on delivery</option>
                </select>
                <label for="total-price">Total Price:</label>
                <input type="text" id="total-price" name="total-price" value="<?php echo $somme; ?> TND" readonly>
                <button type="submit" class="checkout-button">Checkout</button>
            </form>

        </div>
    <?php else: ?>
        <p class="empty-message">No products in your cart.</p>
        <p>product price : <?php echo $somme; ?></p>
    <?php endif; ?>
</body>

</html>