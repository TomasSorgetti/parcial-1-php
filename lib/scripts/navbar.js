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

document.addEventListener("DOMContentLoaded", function () {
  const button = document.querySelector("#dropdownbutton");
  const dropdown = document.querySelector("#dropdownmenu");

  button.addEventListener("click", function () {
    dropdown.classList.toggle("hidden");
  });

  document.addEventListener("click", function (event) {
    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
      dropdown.classList.add("hidden");
    }
  });
});
