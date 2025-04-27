<?php
// Connect to the database
include "../db_connect.php";

// Handle Add / Update Product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_product"])) {
        $stmt = $conn->prepare("INSERT INTO products (name, price, image, description, category) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $_POST["name"], $_POST["price"], $_POST["image"], $_POST["description"], $_POST["category"]);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php");
        exit;
    }

    if (isset($_POST["update_product"])) {
        $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, image = ?, description = ?, category = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $_POST["name"], $_POST["price"], $_POST["image"], $_POST["description"], $_POST["category"], $_POST["product_id"]);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php");
        exit;
    }
}

// Handle Delete users$users
if (isset($_GET["delete"])) {
    $stmt = $conn->prepare("DELETE FROM orders WHERE user_id = ?");
    $stmt->bind_param("i", $_GET["delete"]);
    $stmt->execute();
    $stmt->close();
    $stmt = $conn->prepare("DELETE FROM messages WHERE user_id = ?");
    $stmt->bind_param("i", $_GET["delete"]);
    $stmt->execute();
    $stmt->close();
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $_GET["delete"]);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit;
}



// Fetch all products
$sql = "SELECT u.*, COALESCE(SUM(o.total_price), 0) AS total_purchase
        FROM users u
        LEFT JOIN orders o ON u.id = o.user_id
        WHERE 1=1";  // We keep 1=1 to simplify adding search conditions
$params = [];
$types = "";

$search = $_GET['search'] ?? '';

if (!empty($search)) {
    $sql .= " AND (u.first_name LIKE ? OR u.last_name LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $types .= "ss";
}

$sql .= " GROUP BY u.id"; // group AFTER search

$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GeekStore Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Admin Panel - GeekStore</h1>
    <a href="../users/login/login.php" class="exit">Leave</a>
    <section>
        <div class="search-container">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search users name" value="<?= $search ?>">
                <button id="search-button" type="submit">🔍</button>
            </form>
        </div>
        <!-- Customer List Section -->
        <section>
            <h2 class="nav_link"><a href="index.php">Products</a></h2>
            <h2 class="nav_link"><a href="users.php">users</a></h2>
            <h2 class="nav_link"><a href="orders.php">orders</a></h2>
            <h2 class="nav_link"><a href="messages.php">messages</a></h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Action</th>
                            <th>total purshase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo $user['first_name']; ?></td>
                                <td><?php echo $user['last_name']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td>
                                    <a href="users.php?delete=<?php echo $user['id']; ?>" onclick="if(return confirm('Are you sure you want to delete this user?');">Delete</a>
                                </td>
                                <td><?php echo 0 + $user['total_purchase']; ?> dt</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

</body>

</html>