<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>GeekStore Admin Panel</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1>Admin Panel - GeekStore</h1>
  <a href="../users/login/login.php" class="exit">leave</a>
  <section>
    <h2>Add New Product</h2>
    <form id="addProductForm">
      <input type="text" placeholder="Name" name="name" required>
      <input type="text" placeholder="Price" name="price" required>
      <input type="text" placeholder="Image URL" name="image" required>
      <input type="text" placeholder="Description" name="description" required>
      <select name="category" required>
        <optgroup label="Select Category">
          <option value="figure">Figure</option>
          <option value="hoodie">Hoodie</option>
          <option value="sticker">Sticker</option>
        </optgroup>
      </select>
      <button type="submit">Add Product</button>
    </form>
  </section>

  <section>
    <h2>All Products</h2>
    <div id="productList"></div>
  </section>

  <script src="admin.js"></script>
</body>

</html>