<?php
namespace Views;

class AddressView {
    public function initForm () {
        echo '<h1>Votre adresse de livraison</h1>
        <form class="vertical" method="post">
            <label>Adresse 1</label><input type="text" name="address_1" id="address_1">
            <label>Adresse 2</label><input type="text" name="address_2" id="address_2">
            <label>Zipcode</label><input type="text" name="zip" id="zip">
            <label>Ville</label><input type="text" name="city" id="city">
            <label>Pays</label><input type="text" name="country" id="country">
            <button type="submit">Valider</button>
        </form>';
    }

}