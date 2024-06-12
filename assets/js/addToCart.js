// Attend que le DOM soit entièrement chargé
document.addEventListener('DOMContentLoaded', () => {
    // Sélectionne tous les boutons d'ajout au panier
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    // Ajoute un écouteur d'événement 'click' à chaque bouton
    addToCartButtons.forEach(button => {
        button.addEventListener('click', async (event) => {
            // Trouve le formulaire parent le plus proche du bouton cliqué
            const form = event.target.closest('.product-form');
            // Récupère les valeurs des champs du formulaire
            const product_id = form.querySelector('.product_id').value;
            const price = form.querySelector('.price').value;
            const quantity = form.querySelector('.qte').value;

            try {
                // Envoie une requête POST au serveur
                const response = await fetch('http://localhost:8888/NEW-MVC/E-Commerce-MVC/?action=addToCart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json', // Spécifie que les données envoyées sont au format JSON
                    },
                    body: JSON.stringify({
                        product_id: product_id,
                        quantity: quantity,
                        price: price,
                    }), // Convertit les données du formulaire en JSON
                });

                // Récupère la réponse du serveur sous forme de texte
                const text = await response.text();
                console.log('Response Text:', text);

                // Parse le texte en JSON
                const data = JSON.parse(text);
                console.log('Success:', data);

                // Ajouter votre logique pour gérer la réponse du serveur ici
            } catch (error) {
                console.error('Error:', error);
                // Ajouter votre logique pour gérer les erreurs ici
            }
        });
    });
});
