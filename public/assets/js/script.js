// GESTION DES CARTES

var left = document.querySelector('.pre-btn');
var right = document.querySelector('.nxt-btn');
var viewport = document.querySelector('.viewport');
var cardWidth = 240; // Исходная ширина карточек

// Функция для обновления ширины карточек в зависимости от ширины экрана
function updateCardWidth() {
  if (window.innerWidth <= 650) { // Примерное значение для сужения экрана
    cardWidth = 180; // Изменяем ширину карточек для сужения экрана
  } else {
    cardWidth = 250; // Возвращаем исходную ширину карточек
  }
}

// Обработчик для левой стрелки
left.addEventListener('click', function() {
   updateCardWidth(); // Обновляем ширину карточек перед прокруткой
   viewport.scrollBy({
      left: -cardWidth,
      behavior: 'smooth'
   });
});

// Обработчик для правой стрелки
right.addEventListener('click', function() {
   updateCardWidth(); // Обновляем ширину карточек перед прокруткой
   viewport.scrollBy({
      left: cardWidth,
      behavior: 'smooth'
   });
});

// Обновляем ширину карточек при загрузке страницы и изменении размера окна
window.addEventListener('load', updateCardWidth);
window.addEventListener('resize', updateCardWidth);

// BURGER

function toggleMenu() {
    var menuBox = document.getElementById("menu-box");
    if (menuBox.style.display === "none" || menuBox.style.display === "") {
      menuBox.style.display = "block";
    } else {
      menuBox.style.display = "none";
    }
  }


// TOOLTIP


