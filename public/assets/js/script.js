// GESTION DES CARTES

let left = document.querySelector('.pre-btn');
let right = document.querySelector('.nxt-btn');
let viewport = document.querySelector('.viewport');
let cardWidth = 240;

// flèche gauche
left.addEventListener('click', function() {
   viewport.scrollBy({
      left: -cardWidth,
      behavior: 'smooth'
   });
});

// flèche droite
right.addEventListener('click', function() {
   viewport.scrollBy({
      left: cardWidth,
      behavior: 'smooth'
   });
});


//GESTION d'AJOUT DANS LE PANIER

const addButtons = document.querySelectorAll('.btn-add-card');

 addButtons.forEach(button => {
    button.addEventListener('click', function () {
        const productId = this.getAttribute('data-product-id');
        const productStock = this.getAttribute('data-product-stock');
        
        if (productStock > 0) {
            // requête GET vers la route appropriée
            fetch(`/add/${productId}`)
                .then(response => {
                    if (response.status === 200) {
                        // L'ajout au panier a été effectué avec succès
                        alert('Produit ajouté au panier avec succès.');
                    } else {
                        // erreurs
                        alert('Une erreur est survenue lors de l\'ajout au panier.');
                    }
                })
                .catch(error => {
                    alert('Une erreur est survenue lors de l\'ajout au panier.', error);
                });
        } else {
            // le message d'erreur
            alert('Le produit est épuisé en stock.');
        }
    });
});


// GALERIE

document.addEventListener("DOMContentLoaded", function () {
    const gallery = document.getElementById("gallery");
    const lightbox = document.getElementById("lightbox");
    const lightboxContent = document.querySelector(".lightbox-content");

    let currentImgIndex = 0;
  
    gallery.addEventListener("click", function (e) {
      if (e.target.tagName === "IMG") {
        const imgUrl = e.target.src;
        currentImgIndex = Array.from(gallery.querySelectorAll('.box img')).indexOf(e.target);
        displayImage(imgUrl);
      }
    });
  
    function displayImage(imgUrl) {
      lightboxContent.innerHTML = `<img src="${imgUrl}" alt="">`;
      lightbox.style.display = "block";

      document.addEventListener('keydown', handleKeyPress);
    }
  
    function closeLightbox() {
      lightbox.style.display = "none";
      document.addEventListener('keydown', handleKeyPress);
    }

    function handleKeyPress(e) {
        if (e.keyCode === 37) {
            navigate(-1);
        } else if (e.keyCode === 39) {
            navigate(1);
        }
    }
    
    function navigate(direction) {
        currentImgIndex += direction;

        const images = gallery.querySelectorAll('.box img');

        if (currentImgIndex < 0) {
            currentImgIndex = images.length - 1;
        } else if (currentImgIndex >= images.length) {
            currentImgIndex = 0;
        }

        const imgUrl = images[currentImgIndex].src;
        displayImage(imgUrl);
    }
    window.closeLightbox = closeLightbox;
  });