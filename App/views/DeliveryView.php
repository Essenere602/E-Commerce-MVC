<?php
namespace Views;

class DeliveryView {
    public function initForm () {
        echo '<h1>Choix du livreur</h1>
        <form method="POST">
        <select name="delivery_option" id="delivery_option">
            <option value=""></option>
            <option value="UPS">UPS</option>
            <option value="DPD">DPD</option>
            <option value="La Poste">La Poste</option>
            <option value="Colissimo">Colissimo</option>
            <option value="Mondial Relay">Mondial Relay</option>
        </select>
        <input type="hidden" name="deliver_time" id="deliver_time" value="1 semaine">
        <button type="submit">Valider</button>
        </form>';
    }
}