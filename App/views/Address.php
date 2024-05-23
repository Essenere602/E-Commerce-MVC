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
}
