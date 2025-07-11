window.addEventListener("load", () => {
  const cartButton = document.getElementById("cart-button");

  cartButton.addEventListener("click", () => {
    cart.classList.toggle("active");
  });
});
