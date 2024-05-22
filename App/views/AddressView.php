<?php
namespace Views;

class AddressView {
    public function render() {
        echo '<h2>Adresse de Livraison</h2>';
        echo '<form method="POST" action="?action=commande&step=adresse">';
        echo '<label for="address_1">Adresse 1:</label>';
        echo '<input type="text" id="address_1" name="address_1" required>';
        echo '<br>';
        echo '<label for="address_2">Adresse 2:</label>';
        echo '<input type="text" id="address_2" name="address_2">';
        echo '<br>';
        echo '<label for="zip">Code Postal:</label>';
        echo '<input type="text" id="zip" name="zip" required>';
        echo '<br>';
        echo '<label for="city">Ville:</label>';
        echo '<input type="text" id="city" name="city" required>';
        echo '<br>';
        echo '<label for="country">Pays:</label>';
        echo '<input type="text" id="country" name="country" required>';
        echo '<br>';
        echo '<button type="submit">Enregistrer l\'adresse</button>';
        echo '</form>';
    }
}
