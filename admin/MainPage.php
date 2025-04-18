<?php
// Connect to database
include "../db_connect.php";

// Handle Add Product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {
  $stmt = $conn->prepare("INSERT INTO products (name, price, image, description, category) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $_POST["name"], $_POST["price"], $_POST["image"], $_POST["description"], $_POST["category"]);
  $stmt->execute();
  $stmt->close();
  header("Location: admin.php");
  exit;
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
    <h2>Add New Product</h2>
    <form method="POST">
      <input type="text" name="name" placeholder="Name" required>
      <input type="text" name="price" placeholder="Price" required>
      <input type="text" name="image" placeholder="Image URL" required>
      <input type="text" name="description" placeholder="Description" required>
      <select name="category" required>
        <optgroup label="Select Category">
          <option value="figure">Figure</option>
          <option value="hoodie">Hoodie</option>
          <option value="sticker">Sticker</option>
        </optgroup>
      </select>
      <button type="submit" name="add_product">Add Product</button>
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
        </div>
      <?php endforeach; ?>
    </div>
  </section>

</body>

</html>