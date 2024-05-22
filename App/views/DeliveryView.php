<?php
namespace Views;

class DeliveryView {
    public function render() {
        echo "<h1>Choix du mode de livraison</h1>"; 
        echo '<form method="POST" action="?action=commande&step=livraison">
            <label for="delivery_option">Choisissez votre mode de livraison :</label>
            <select name="delivery_option" id="delivery_option">
                <option value="Standard Delivery">Livraison standard</option>
                <option value="Express Delivery">Livraison express</option>
                <option value="Overnight Delivery">Livraison le lendemain</option>
            </select>
            <br>
            <label for="delivery_time">Choisissez le délai de livraison :</label>
            <select name="delivery_time" id="delivery_time">
                <option value="3-5 Business Days">3-5 jours ouvrables</option>
                <option value="1-2 Business Days">1-2 jours ouvrables</option>
                <option value="Next Business Day">Le jour ouvrable suivant</option>
            </select>
            <br>
            <input type="submit" value="Enregistrer">
        </form>';
    }
}
?>
