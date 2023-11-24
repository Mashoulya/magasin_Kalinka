const btnMenu = document.querySelector(".btn-menu");
const menuBox = document.querySelector(".menu-box");
const cancel = document.querySelector(".cancel");

btnMenu.addEventListener("click", function () {
  menuBox.style.display = "block";
  cancel.style.display = "block";
});


cancel.addEventListener("click", function () {
  menuBox.style.display = "none";
  cancel.style.display = "none";
});

