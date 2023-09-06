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

document.addEventListener("DOMContentLoaded", function () {
  const profileIcon = document.querySelector(".user");
  const beforeLogReg = document.querySelector(".before-log-reg");
  const afterLogReg = document.querySelector(".after-log-reg");

  // Пример: предположим, у вас есть переменная userIsLoggedIn,
  // которая будет true, если пользователь авторизован
  let userIsLoggedIn = false; // Пока пользователь не авторизован

  // click n'importe où pour cacher les block
  function hideHints() {
    beforeLogReg.style.display = "none";
    afterLogReg.style.display = "none";
  }

  profileIcon.addEventListener("click", function () {
    event.stopPropagation(); // Предотвращаем всплытие события до document
    //  user est connecté
    if (userIsLoggedIn) {
      beforeLogReg.style.display = "none"; // cache le block avant la connexion
      afterLogReg.style.display = "flex"; // affiche le block après la connex
      // si user n'est pas connecté
    } else {
      beforeLogReg.style.display = "flex"; // affiche le block avant la connex
      afterLogReg.style.display = "none"; // cache le block après la connex
    }
  });

  document.addEventListener("click", function () {
    hideHints();
  });

  // Здесь вы можете добавить код, который будет изменять userIsLoggedIn
  // на true, когда пользователь авторизуется.

  // Пример:
  // userIsLoggedIn = true;
});
