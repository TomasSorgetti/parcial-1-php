const header = document.getElementById("header");

window.addEventListener("scroll", () => {
  header.classList.toggle("isScrolled", window.scrollY > 0);
});
