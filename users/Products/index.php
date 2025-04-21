<?php
include "../../db_connect.php";

// Get distinct categories from the database
$categoryQuery = "SELECT DISTINCT category FROM products";
$categoryResult = mysqli_query($conn, $categoryQuery);

// Initialize filters
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : "";
$selectedCategory = isset($_GET['category']) ? trim($_GET['category']) : "";

// Build the SQL query with filters
$sql = "SELECT * FROM products where 1=1";
$params = [];
$types = "";

if (!empty($searchQuery)) {
    $sql .= " AND (name LIKE CONCAT('%', ?, '%') OR description LIKE CONCAT('%', ?, '%'))";
    $params[] = $searchQuery;
    $params[] = $searchQuery;
    $types .= "ss";
}

if (!empty($selectedCategory)) {
    $sql .= " AND category = ?";
    $params[] = $selectedCategory;
    $types .= "s";
}

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GeekStore</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <a href="../HomePage/index.php"><img src="../../img/whitelogo.png" alt="GeekStore Logo" class="logo"></a>
        <nav class="navbar">
            <a href="../HomePage/index.php">Home</a>
            <a href="#">Shop</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
        </nav>
    </header>

    <section id="shop">
        <div class="search-container">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search anime merch..." value="<?php echo $searchQuery ?>">
                <select name="category">
                    <option value="">All Categories</option>
                    <?php while ($row = mysqli_fetch_assoc($categoryResult)): ?>
                        <option value="<?php echo $row['category'] ?>" <?= $selectedCategory === $row['category'] ? 'selected' : '' ?>>
                            <?php echo $row['category'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <button type="submit">🔍</button>
            </form>
        </div>
        <h2>Find Your Favorite Anime Gear</h2>
        <div class="product-container" id="product-list">
            <?php if ($result->num_rows === 0): ?>
                <p>No products found.</p>
            <?php else: ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="product-card">
                        <img src="<?php echo $row['image'] ?>" alt="<?php echo $row['name'] ?>">
                        <h3><?php echo $row['name'] ?></h3>
                        <p><?php echo $row['price'] ?>dt</p>
                        <p><?php echo $row['description'] ?></p>
                        <p><strong>Category:</strong> <?php echo $row['category'] ?></p>
                        <form action="../card/add.php" method="get">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Add to Cart</button>
                        </form>

                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>
</body>

</html>