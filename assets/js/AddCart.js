// Sélectionnez tous les formulaires
const formList = document.querySelectorAll('form');

// Ajoutez un gestionnaire d'événements submit pour chaque formulaire
formList.forEach(form => {
    form.addEventListener('submit', (event) => {
        // Empêcher le comportement par défaut du formulaire (rechargement de la page)
        event.preventDefault();

        // Récupérez les données du formulaire
        const formData = new FormData(form);
        
        // Envoiez les données du formulaire via Fetch
        fetch('AddCart.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                console.log('Produit ajouté au panier avec succès');
                // Vous pouvez également effectuer d'autres actions ici, comme afficher un message de confirmation
            } else {
                console.error('Erreur lors de l\'ajout du produit au panier');
                // Gérer les erreurs
            }
        })
        .catch(error => {
            console.error('Erreur lors de la requête Fetch:', error);
        });
    });
});
