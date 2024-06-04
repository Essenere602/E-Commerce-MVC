document.addEventListener('DOMContentLoaded', () => {
    const changeQuantityButtons = document.querySelectorAll('.change-qte');
    const removeFromCartButtons = document.querySelectorAll('.remove-from-cart');

    // Fonction pour envoyer une demande au serveur pour ajuster la quantité
    const adjustQuantity = async (event) => {
        const form = event.target.closest('.product-form');
        const product_id = form.querySelector('.product_id').value;
        const cart_id = form.querySelector('.cart_id').value;
        const cart_detail_id = form.querySelector('.cart_detail_id').value;
        const quantity = form.querySelector('.qte').value;

        try {
            const response = await fetch('http://localhost:8888/MVC-E-COMMERCE/E-Commerce-MVC/?action=adjustQuantity', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    product_id: product_id,
                    cart_detail_id: cart_detail_id,
                    quantity: quantity,
                    cart_id: cart_id
                }),
            });

            const text = await response.text();  // Get the response as text
            console.log('Response Text:', text);

            const data = JSON.parse(text);  // Parse the text as JSON
            console.log('Success:', data);

            // Ajouter votre logique pour gérer la réponse du serveur ici
        } catch (error) {
            console.error('Error:', error);
            // Ajouter votre logique pour gérer les erreurs ici
        }
    };

    // Fonction pour envoyer une demande au serveur pour retirer l'article du panier
    const removeFromCart = async (event) => {
        const form = event.target.closest('.product-form');
        const product_id = form.querySelector('.product_id').value;
        const cart_id = form.querySelector('.cart_id').value;
        const cart_detail_id = form.querySelector('.cart_detail_id').value;

        try {
            const response = await fetch('http://localhost:8888/MVC-E-COMMERCE/E-Commerce-MVC/?action=removeFromCart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    cart_detail_id: cart_detail_id,
                    product_id: product_id,
                    cart_id: cart_id
                }),
            });

            const text = await response.text();  // Get the response as text
            console.log('Response Text:', text);

            const data = JSON.parse(text);  // Parse the text as JSON
            console.log('Success:', data);

            // Ajouter votre logique pour gérer la réponse du serveur ici
        } catch (error) {
            console.error('Error:', error);
            // Ajouter votre logique pour gérer les erreurs ici
        }
    };

    // Ajouter des écouteurs d'événements pour les deux boutons
    changeQuantityButtons.forEach(button => {
        button.addEventListener('click', adjustQuantity);
    });

    removeFromCartButtons.forEach(button => {
        button.addEventListener('click', removeFromCart);
    });
});
