<?php
namespace Views;

class AddressView {
    public function initForm($address = null) {
        $addressOne = $address['address_1'] ?? '';
        $addressTwo = $address['address_2'] ?? '';
        $zip = $address['zip'] ?? '';
        $city = $address['city'] ?? '';
        $country = $address['country'] ?? '';
        echo '<h1>Votre adresse de livraison</h1>
        <form class="vertical" method="post">
            <label>Adresse 1</label><input type="text" name="address_1" id="address_1" value="'.htmlspecialchars($addressOne).'">
            <label>Adresse 2</label><input type="text" name="address_2" id="address_2" value="'.htmlspecialchars($addressTwo).'">
            <label>Zipcode</label><input type="text" name="zip" id="zip" value="'.htmlspecialchars($zip).'">
            <label>Ville</label><input type="text" name="city" id="city" value="'.htmlspecialchars($city).'">
            <label>Pays</label><input type="text" name="country" id="country" value="'.htmlspecialchars($country).'">
            <button type="submit">Valider</button>
        </form>';
    }
} 