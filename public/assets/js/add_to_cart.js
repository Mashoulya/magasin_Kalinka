const addButtons = document.querySelectorAll('.btn-add-card');

addButtons.forEach(button => {
    button.addEventListener('click', function () {
        const productId = this.getAttribute('data-product-id');
        const productStock = this.getAttribute('data-product-stock');
        
        if (productStock > 0) {
            // la requête GET vers la route d'ajout du produit
            fetch(`/add/${productId}`)
                .then(response => {
                    if (response.status === 200) {
                        // L'ajout au panier avec succès
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
            // msg d'erreur si le produit n'est plus en stock
            alert('Le produit est épuisé en stock.');
        }
    });
});
