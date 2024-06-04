<?php
namespace Views;

class ConfirmationView {
    public function render($address, $cart, $delivery) {
        echo '<h1>Confirmation de la commande</h1>';

        // Afficher l'adresse
        echo '<h2>Adresse de livraison</h2>';
        if ($address) {
            echo '<p>' . htmlspecialchars($address['address_1']) . '<br>';
            if ($address['address_2']) {
                echo htmlspecialchars($address['address_2']) . '<br>';
            }
            echo htmlspecialchars($address['zip']) . ' ' . htmlspecialchars($address['city']) . '<br>';
            echo htmlspecialchars($address['country']) . '</p>';
        } else {
            echo '<p>Aucune adresse sélectionnée.</p>';
        }

        // Afficher le panier
        echo '<h2>Panier</h2>';
        if (!empty($cart)) {
            echo '<ul>';
            foreach ($cart as $item) {
                echo '<li>' . htmlspecialchars($item['name']) . ' x ' . htmlspecialchars($item['quantity']) . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>Le panier est vide.</p>';
        }

        // Afficher le moyen de livraison
        echo '<h2>Moyen de livraison</h2>';
        if ($delivery) {
            echo '<p>' . htmlspecialchars($delivery) . '</p>';
        } else {
            echo '<p>Aucun moyen de livraison sélectionné.</p>';
        }

        echo '<form method="POST" action="?action=confirmOrder">';
        echo '<button type="submit">Confirmer la commande</button>';
        echo '</form>';
    }
}
?>
