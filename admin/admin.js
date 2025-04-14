document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("addProductForm");
  const productList = document.getElementById("productList");

  // Fetch and display products
  function loadProducts() {
    fetch("../users/Products/product.php")
      .then((res) => res.json())
      .then((data) => {
        productList.innerHTML = "";
        data.forEach((product) => {
          const div = document.createElement("div");
          div.classList.add("product-card");
          div.innerHTML = `
              <img src="${product.image}" width="100">
              <h3>${product.name}</h3>
              <p>${product.price}dt</p>
              <p>${product.description}</p>
              <p>Category: ${product.category}</p>
              <button onclick="editProduct(${product.id})">Edit</button>
              <button onclick="deleteProduct(${product.id})">Delete</button>
            `;
          productList.appendChild(div);
        });
      });
  }

  // Add product
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const formData = new FormData(form);

    fetch("add_product.php", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.text())
      .then(() => {
        form.reset();
        loadProducts();
      });
  });

  // Delete product (global function)
  window.deleteProduct = function (id) {
    fetch(`delete_product.php?id=${id}`)
      .then((res) => res.text())
      .then(() => loadProducts());
  };

  // Edit product (you can build a modal later)
  window.editProduct = function (id) {
    alert("Edit functionality coming soon... (you can add a modal form)");
  };

  // Initial load
  loadProducts();
});
