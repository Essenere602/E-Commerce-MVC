<?php
namespace Views;

class DeliveryView {
    public function render($deliveryOptions = []) {
        echo '<form method="POST" action="commande/confirmation">
            <h3>Choisissez votre moyen de livraison</h3>';
        
        if (!empty($deliveryOptions)) {
            foreach ($deliveryOptions as $option) {
                echo '<div>
                    <input type="radio" id="delivery_option_' . htmlspecialchars($option['id']) . '" name="delivery_option" value="' . htmlspecialchars($option['id']) . '">
                    <label for="delivery_option_' . htmlspecialchars($option['id']) . '">' . htmlspecialchars($option['delivery_option']) . ' - ' . htmlspecialchars($option['deliver_time']) . '</label>
                </div>';
            }
        } else {
            echo '<p>Aucune option de livraison disponible.</p>';
        }

        echo '<button type="submit">Enregistrer le moyen de livraison</button>
        </form>';
    }
}
?>
