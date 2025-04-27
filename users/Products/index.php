<?php
include "../../db_connect.php";

// Initialize filters
$search = isset($_GET['search']) ? trim($_GET['search']) : "";
$selectedCategory = isset($_GET['category']) ? trim($_GET['category']) : "";

// Build the SQL query with filters
$sql = "SELECT * FROM products where 1=1";
$params = [];
$types = "";

if (!empty($search)) {
    $sql .= " AND (name LIKE CONCAT('%', ?, '%') OR description LIKE CONCAT('%', ?, '%'))";
    $params[] = "%$search%";
    $params[] = "%$search%";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <a href="#"><img src="../../img/whitelogo.png" alt="GeekStore Logo" class="logo"></a>
        <nav class="navbar">
            <a href="../HomePage/index.php">Home</a>
            <a href="../Products/index.php">Shop</a>
            <a href="../card/main.php">cart</a>
            <form class="logout-form" action="../HomePage/logout.php" method="post">
                <button type="submit" name="logout" class="submit">
                    <i class="fa-solid fa-right-to-bracket"></i>
                </button>
            </form>
        </nav>
    </header>

    <section id="shop">
        <h2>Find Your Favorite Anime Gear</h2>
        <div class="search-container">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search anime merch..." value="<?php echo $search ?>">
                <select name="category">
                    <option value="">All Categories</option>
                    <option value="figure">figure</option>
                    <option value="hoodie">hoodie</option>
                    <option value="sticker">sticker</option>
                </select>
                <button id="search-button" type="submit">🔍</button>
            </form>
        </div>
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
                            <input type="number" name="quantity" value="1" min="1" max="1000" required>
                            <button type="submit">Add to Cart</button>
                        </form>

                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>
</body>

</html>