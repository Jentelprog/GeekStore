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

// Handle Delete Product
if (isset($_GET["delete"])) {
  $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
  $stmt->bind_param("i", $_GET["delete"]);
  $stmt->execute();
  $stmt->close();
  header("Location: index.php");
  exit;
}

// Fetch product for editing
$edit_product = null;
if (isset($_GET["edit"])) {
  $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
  $stmt->bind_param("i", $_GET["edit"]);
  $stmt->execute();
  $result = $stmt->get_result();
  $edit_product = $result->fetch_assoc();
  $stmt->close();
}

// Fetch all products
$sql = "SELECT * FROM products WHERE 1=1";
$params = [];
$types = "";

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

if (!empty($search)) {
  $sql .= " AND (name LIKE ? OR description LIKE ?)";
  $params[] = "%$search%";
  $params[] = "%$search%";
  $types .= "ss";
}

if (!empty($category)) {
  $sql .= " AND category = ?";
  $params[] = $category;
  $types .= "s";
}

$stmt = $conn->prepare($sql);
if ($params) {
  $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);

// Fetch all users
$sql_users = "SELECT * FROM users";
$result_users = $conn->query($sql_users);
$users = $result_users->fetch_all(MYSQLI_ASSOC);
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

  <!-- Product Management Section -->
  <section>
    <div class="search-container">
      <form method="GET" action="">
        <input type="text" name="search" placeholder="Search anime merch..." value="<?= $search ?>">
        <select name="category">
          <option value="">All Categories</option>
          <option value="figure" <?= $category == 'figure' ? 'selected' : '' ?>>Figure</option>
          <option value="hoodie" <?= $category == 'hoodie' ? 'selected' : '' ?>>Hoodie</option>
          <option value="sticker" <?= $category == 'sticker' ? 'selected' : '' ?>>Sticker</option>
        </select>
        <button id="search-button" type="submit">🔍</button>
      </form>
    </div>

    <h2><?= $edit_product ? "Edit Product" : "Add New Product" ?></h2>
    <form method="POST">
      <input type="text" name="name" placeholder="Name" required value="<?= $edit_product['name'] ?? '' ?>">
      <input type="text" name="price" placeholder="Price" required value="<?= $edit_product['price'] ?? '' ?>">
      <input type="text" name="image" placeholder="Image URL" required value="<?= $edit_product['image'] ?? '' ?>">
      <input type="text" name="description" placeholder="Description" required value="<?= $edit_product['description'] ?? '' ?>">
      <select name="category" required>
        <option value="figure" <?= isset($edit_product) && $edit_product['category'] == 'figure' ? 'selected' : '' ?>>Figure</option>
        <option value="hoodie" <?= isset($edit_product) && $edit_product['category'] == 'hoodie' ? 'selected' : '' ?>>Hoodie</option>
        <option value="sticker" <?= isset($edit_product) && $edit_product['category'] == 'sticker' ? 'selected' : '' ?>>Sticker</option>
      </select>

      <?php if ($edit_product): ?>
        <input type="hidden" name="product_id" value="<?= $edit_product['id'] ?>">
        <button type="submit" name="update_product">Update Product</button>
        <a href="index.php">Cancel</a>
      <?php else: ?>
        <button type="submit" name="add_product">Add Product</button>
      <?php endif; ?>
    </form>
  </section>

  <!-- Product List Section -->
  <section>
    <h2 class="nav_link"><a href="index.php">Products</a></h2>
    <h2 class="nav_link"><a href="users.php">users</a></h2>
    <h2 class="nav_link"><a href="orders.php">orders</a></h2>
    <h2 class="nav_link"><a href="messages.php">messages</a></h2>
    <div id="productList">
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Category</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $product): ?>
            <tr>
              <td>
                <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="product-image">
              </td>
              <td><?php echo $product['id'] ?></td>
              <td><?php echo $product['name'] ?></td>
              <td><?php echo $product['price'] ?> dt</td>
              <td><?php echo $product['description'] ?></td>
              <td><?php echo $product['category'] ?></td>
              <td>
                <a href="?delete=<?= $product['id'] ?>" class="action-button" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a> |
                <a href="?edit=<?= $product['id'] ?>" class="action-button">Edit</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

</body>

</html>