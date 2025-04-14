document.addEventListener("DOMContentLoaded", () => {
  let allProducts = []; // Store all products

  // Fetch products from product.php
  fetch("product.php")
    .then((response) => response.json())
    .then((data) => {
      allProducts = data; // Save all products
      displayProducts(allProducts); // Display all products initially
    })
    .catch((error) => console.error("Error fetching products:", error));

  // Function to display products
  function displayProducts(products) {
    let productContainer = document.getElementById("product-list");
    productContainer.innerHTML = ""; // Clear previous products

    products.forEach((product) => {
      let productCard = document.createElement("div");
      productCard.classList.add("product-card");
      productCard.innerHTML = `
                <img src="${product.image}" alt="${product.name}">
                <h3>${product.name}</h3>
                <p>${product.price}dt</p>
                <p>${product.description}</p>
                <button>Add to Cart</button>
        `;
      productContainer.appendChild(productCard);
    });
  }

  // Search functionality
  document.getElementById("searchInput").addEventListener("input", () => {
    let searchQuery = document.getElementById("searchInput").value.toLowerCase();
    let filteredProducts = allProducts.filter(product =>
      product.name.toLowerCase().includes(searchQuery) ||
      product.description.toLowerCase().includes(searchQuery)
    );
    displayProducts(filteredProducts);
});

});
