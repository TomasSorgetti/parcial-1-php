const header = document.getElementById("header");
const menu = document.getElementById("menu");
const hamburger = document.getElementById("hamburger");

window.addEventListener("scroll", () => {
  header.classList.toggle("isScrolled", window.scrollY > 0);
});
window.addEventListener("load", () => {
  hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    menu.classList.toggle("open");
  });
});
