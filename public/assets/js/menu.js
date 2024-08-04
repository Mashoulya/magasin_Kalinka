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


// lien actif

document.addEventListener('DOMContentLoaded', () => {
  // Récupérer l'ID de la catégorie stocké dans le local storage
  const activeCategoryId = localStorage.getItem('activeCategoryId');
  
  // Si un ID est trouvé, ajouter la classe active au lien correspondant
  if (activeCategoryId) {
      const activeLink = document.querySelector(`.menu-li[data-category-id="${activeCategoryId}"]`);
      if (activeLink) {
          activeLink.classList.add('active');
      }
  }
});

function setActiveMenu(element) {
  // Supprimer la classe active de tous les liens
  document.querySelectorAll('.menu-li').forEach(link => {
      link.classList.remove('active');
  });

  // Ajouter la classe active au lien cliqué
  element.classList.add('active');

  // Stocker l'ID de la catégorie dans le local storage
  const categoryId = element.getAttribute('data-category-id');
  localStorage.setItem('activeCategoryId', categoryId);
}