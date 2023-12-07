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

