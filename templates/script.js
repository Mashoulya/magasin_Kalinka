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


function toggleMenu() {
    var menuBox = document.getElementById("menu-box");
    if (menuBox.style.display === "none" || menuBox.style.display === "") {
      menuBox.style.display = "block";
    } else {
      menuBox.style.display = "none";
    }
  }