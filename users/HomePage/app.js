document.addEventListener("DOMContentLoaded", () => {
  fetch("shop.php")
    .then((response) => response.json())
    .then((data) => {
      let productContainer = document.getElementById("product-list");
      data.forEach((product) => {
        let productCard = document.createElement("div");
        productCard.classList.add("product-card");

        productCard.innerHTML = `
                    <img src="${product.image}" alt="${product.name}">
                    <h3>${product.name}</h3>
                    <p>${product.price}dt</p>
                    <button>Add to Cart</button>
            `;
        productContainer.appendChild(productCard);
      });
    })
    .catch((error) => console.error("Error fetching products:", error));
});
