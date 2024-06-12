<?php
namespace Views;

class RecapView {
    // Méthode pour initialiser le formulaire de récapitulatif de commande
    public function initForm($orderDetails) {
        // Titre du récapitulatif de commande
        echo "<h1>Order Summary</h1>";
        // Liste non ordonnée pour afficher les détails de la commande
        echo "<ul>";
        // Vérification si une option de livraison a été sélectionnée
        if (isset($_SESSION['selected_delivery_option'])) {
            // Affichage de l'ID de livraison sélectionné
            echo '<p>Selected Delivery ID: ' . htmlspecialchars($_SESSION['selected_delivery_option']) . '</p>';
            
            // Vérification si une adresse utilisateur a été définie dans la session
            if (isset($_SESSION['user_address'])) {
                // Récupération de l'adresse utilisateur
                $address = $_SESSION['user_address'];
                // Affichage de l'adresse sélectionnée
                echo '<p>Selected Address:</p>';
                echo '<ul>';
                echo '<li>Address Line 1: ' . htmlspecialchars($address['address_1']) . '</li>';
                echo '<li>Address Line 2: ' . htmlspecialchars($address['address_2']) . '</li>';
                echo '<li>ZIP Code: ' . htmlspecialchars($address['zip']) . '</li>';
                echo '<li>City: ' . htmlspecialchars($address['city']) . '</li>';
                echo '<li>Country: ' . htmlspecialchars($address['country']) . '</li>';
                echo '</ul>';
            } else {
                // Affichage si aucune adresse utilisateur n'a été trouvée dans la session
                echo '<p>No address found.</p>';
            }
        } else {
            // Affichage si aucune option de livraison n'a été sélectionnée
            echo '<p>No delivery option selected.</p>';
        }
        
        // Parcours des détails de la commande pour les afficher
        foreach ($orderDetails as $item) {
            echo "<li>Product ID: " . htmlspecialchars($item['product_id']) . ", Price: " . htmlspecialchars($item['price_exc_vat']) . ", Quantity: " . htmlspecialchars($item['quantity']) . ", VAT: " . htmlspecialchars($item['vat']) . ", VAT Amount: " . htmlspecialchars($item['vat_amount']) . "</li>";
        }
        // Fin de la liste non ordonnée
        echo "</ul>";
        // Formulaire pour payer la commande
        echo '<form method="post" action="commande/paiement">
                <input type="submit" name="pay" value="Payer">
              </form>';
    }
}
?>
