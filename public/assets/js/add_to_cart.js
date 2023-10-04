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
