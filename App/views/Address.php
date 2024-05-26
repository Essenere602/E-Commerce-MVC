<?php
namespace Views;

class Address {
    public function addressForm() {
        echo '
        <h1>Adresse</h1>
        <form method="POST" action="?action=commande&step=adresse">
            <div>
                <label for="address">Adresse :</label>
                <input type="text" id="address" name="address" required>
            </div>

            <div>
                <label for="address_optional">Adresse 2 (s\'il y a lieu) :</label>
                <input type="text" id="address_optional" name="address_optional">
            </div>

            <div>
                <label for="zipcode">Code postale :</label>
                <input type="text" id="zipcode" name="zipcode" required>
            </div>

            <div>
                <label for="city">Ville :</label>
                <input type="text" id="city" name="city" required>
            </div>

            <div>
                <label for="country">Pays:</label>
                <input type="text" id="country" name="country" required>
            </div>

            <div>
                <button type="submit">Enregistrer</button>
            </div>
        </form>';
    }

    public function updateAddressForm($address) {
        // value : pré-rempli avec address_1 de $address
        echo '
        <h1>Modifier l\'Adresse</h1>
        <form method="POST" action="?action=commande&step=adresse">
            <div>
                <label for="address">Adresse :</label>
                <input type="text" id="address" name="address" value="' . htmlspecialchars($address['address_1']) . '" required> 
            </div>

            <div>
                <label for="address_optional">Adresse 2 (s\'il y a lieu) :</label>
                <input type="text" id="address_optional" name="address_optional" value="' . htmlspecialchars($address['address_2']) . '">
            </div>

            <div>
                <label for="zipcode">Code postale :</label>
                <input type="text" id="zipcode" name="zipcode" value="' . htmlspecialchars($address['zip']) . '" required>
            </div>

            <div>
                <label for="city">Ville :</label>
                <input type="text" id="city" name="city" value="' . htmlspecialchars($address['city']) . '" required>
            </div>

            <div>
                <label for="country">Pays:</label>
                <input type="text" id="country" name="country" value="' . htmlspecialchars($address['country']) . '" required>
            </div>

            <div>
                <button type="submit">Mettre à jour</button>
                <a href="?action=commande&step=livraison">Suivant</a>
            </div>
        </form>';
    }
}
