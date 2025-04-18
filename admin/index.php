<?php
// Connect to database
include "../db_connect.php";

// Handle Add / Update Product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["add_product"])) {
    $stmt = $conn->prepare("INSERT INTO products (name, price, image, description, category) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $_POST["name"], $_POST["price"], $_POST["image"], $_POST["description"], $_POST["category"]);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php");
    exit;
  }

  if (isset($_POST["update_product"])) {
    $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, image = ?, description = ?, category = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $_POST["name"], $_POST["price"], $_POST["image"], $_POST["description"], $_POST["category"], $_POST["product_id"]);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php");
    exit;
  }
}

// Handle Delete Product
if (isset($_GET["delete"])) {
  $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
  $stmt->bind_param("i", $_GET["delete"]);
  $stmt->execute();
  $stmt->close();
  header("Location: admin.php");
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
$result = $conn->query("SELECT * FROM products");
$products = $result->fetch_all(MYSQLI_ASSOC);
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
    <h2><?= $edit_product ? "Edit Product" : "Add New Product" ?></h2>
    <form method="POST">
      <input type="text" name="name" placeholder="Name" required value="<?= $edit_product['name'] ?? '' ?>">
      <input type="text" name="price" placeholder="Price" required value="<?= $edit_product['price'] ?? '' ?>">
      <input type="text" name="image" placeholder="Image URL" required value="<?= $edit_product['image'] ?? '' ?>">
      <input type="text" name="description" placeholder="Description" required value="<?= $edit_product['description'] ?? '' ?>">
      <select name="category" required>
        <optgroup label="Select Category">
          <option value="figure" <?= isset($edit_product) && $edit_product['category'] == 'figure' ? 'selected' : '' ?>>Figure</option>
          <option value="hoodie" <?= isset($edit_product) && $edit_product['category'] == 'hoodie' ? 'selected' : '' ?>>Hoodie</option>
          <option value="sticker" <?= isset($edit_product) && $edit_product['category'] == 'sticker' ? 'selected' : '' ?>>Sticker</option>
        </optgroup>
      </select>

      <?php if ($edit_product): ?>
        <input type="hidden" name="product_id" value="<?= $edit_product['id'] ?>">
        <button type="submit" name="update_product">Update Product</button>
        <a href="admin.php">Cancel</a>
      <?php else: ?>
        <button type="submit" name="add_product">Add Product</button>
      <?php endif; ?>
    </form>
  </section>

  <section>
    <h2>All Products</h2>
    <div id="productList">
      <?php foreach ($products as $product): ?>
        <div class="product-card">
          <img src="<?= htmlspecialchars($product['image']) ?>" width="100">
          <h3><?= htmlspecialchars($product['name']) ?></h3>
          <p><?= htmlspecialchars($product['price']) ?> dt</p>
          <p><?= htmlspecialchars($product['description']) ?></p>
          <p>Category: <?= htmlspecialchars($product['category']) ?></p>
          <a href="?delete=<?= $product['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
          |
          <a href="?edit=<?= $product['id'] ?>">Edit</a>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

</body>

</html>