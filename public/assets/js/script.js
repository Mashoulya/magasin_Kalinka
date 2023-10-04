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

//GESTION d'AJOUT

const addButtons = document.querySelectorAll('.btn-add-card');

 addButtons.forEach(button => {
    button.addEventListener('click', function () {
        const productId = this.getAttribute('data-product-id');
        const productStock = this.getAttribute('data-product-stock');
        
        if (productStock > 0) {
            // Effectuez la requête GET vers la route appropriée
            fetch(`/add/${productId}`)
                .then(response => {
                    if (response.status === 200) {
                        // L'ajout au panier a été effectué avec succès
                        alert('Produit ajouté au panier avec succès.');
                    } else {
                        // Gérez d'autres erreurs ici si nécessaire
                        alert('Une erreur est survenue lors de l\'ajout au panier.');
                    }
                })
                .catch(error => {
                    alert('Une erreur est survenue lors de l\'ajout au panier.', error);
                });
        } else {
            // Le produit est épuisé en stock, affichez le message d'erreur
            alert('Le produit est épuisé en stock.');
        }
    });
});





