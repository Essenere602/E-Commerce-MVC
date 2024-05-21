document.addEventListener('DOMContentLoaded', () => {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', async (event) => {
            const form = event.target.closest('.product-form');
            const product_id = form.querySelector('.product_id').value;
            const price = form.querySelector('.price').value;
            const quantity = form.querySelector('.qte').value;

            try {
                const response = await fetch('http://localhost/E-Commerce-MVC/?action=addToCart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        product_id: product_id,
                        quantity: quantity,
                        price: price,
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
        });
    });
});
