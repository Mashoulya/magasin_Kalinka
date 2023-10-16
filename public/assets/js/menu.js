const btnMenu = document.querySelector(".btn-menu");
const menuBox = document.querySelector(".menu-box");
const croix = document.querySelector(".croix");


btnMenu.addEventListener("click", function () {
  menuBox.style.display = "block";
  croix.style.display = "block";
});


croix.addEventListener("click", function () {
  menuBox.style.display = "none";
  croix.style.display = "none";
});