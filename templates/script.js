// GESTION DES CARTES

const cardsBox = [...document.querySelectorAll('.cards-box')];
const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
const preBtn = [...document.querySelectorAll('.pre-btn')];

cardsBox.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect();
    let containerWidth = containerDimensions.width;

    nxtBtn[i].addEventListener('click', () => {
        item.scrollLeft += containerWidth;
    })

    preBtn[i].addEventListener('click', () => {
        item.scrollLeft -= containerWidth;
    })
})

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