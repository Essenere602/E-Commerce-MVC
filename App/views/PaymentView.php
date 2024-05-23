<?php
namespace Views;

class PaymentView {
    public static function render($selectedDeliveryId) {
        if ($selectedDeliveryId !== null) {
            // Affichage des détails de la commande
            echo '<h1>Order Summary</h1>';
            echo '<p>Selected Delivery ID: ' . htmlspecialchars($selectedDeliveryId) . '</p>';
            // Ici, vous pouvez afficher d'autres détails de la commande, comme le montant total, les articles commandés, etc.
        } else {
            echo '<p>No delivery option selected.</p>';
        }
        echo '
            <h2>Payment Form</h2>
            <form method="post" action="process_payment.php">
                <!-- Ajoutez les champs du formulaire de paiement ici -->
                <!-- Par exemple : -->
                <label for="card_number">Card Number:</label><br>
                <input type="text" id="card_number" name="card_number" required><br>
                
                <label for="expiry_date">Expiry Date:</label><br>
                <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required><br>
                
                <label for="cvv">CVV:</label><br>
                <input type="text" id="cvv" name="cvv" required><br>
                
                <button type="submit">Pay Now</button>
            </form>';
    }
}
?>
