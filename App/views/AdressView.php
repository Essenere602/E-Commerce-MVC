<?php
namespace Views;
class AdressView {
    public function initForm () {
        echo '<h1>Votre adresse de livraison</h1>
        <form class="vertical" action="commande/adresse" method="post">
            <label for="userId">userId</label><input type="hidden" name="userId" id="userId">
            <label for="addressOne">Adresse 1</label><input type="text" name="address_1" id="address_1">
            <label for="addressTwo">Adresse 2</label><input type="text" name="address_2" id="address_2">
            <label for="zip">Zipcode</label><input type="text" name="zip" id="zip">
            <label for="city">Ville</label><input type="text" name="city" id="city">
            <label for="country">Pays</label><input type="text" name="country" id="country">
            <button>Valider</button>
        </form>';
    }

}