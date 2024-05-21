<?php
namespace Views;

class DeliveryView {
    public function initForm () {
        echo '<h1>Choix du livreur</h1>
        <form method="POST" action="process.php">
        <label for="userId">Choose a user:</label>
        <select name="userId" id="userId">
            <option value=""></option>
            <option value="UPS">UPS</option>
            <option value="DPD">DPD</option>
            <option value="La Poste">La Poste</option>
            <option value="Colissimo">Colissimo</option>
            <option value="Mondial Relay">Mondial Relay</option>
        </select>
        <input type="hidden" value="1 semaine">
        <button type="submit">Valider</button>
        </form>';
    }
}