<?php

namespace Views; 


class AddressView {
    
    public function displayAddAddressForm() {
        // Formulaire pour ajouter une adresse
        echo "<h2>Add Address</h2>";
        echo "<form action='commande/adresse' method='POST'>";
        echo "<label for='address_1'>Address 1:</label>";
        echo "<input type='text' id='address_1' name='address_1' required><br>";
        echo "<label for='address_2'>Address 2:</label>";
        echo "<input type='text' id='address_2' name='address_2'><br>";
        echo "<label for='zip'>Zip Code:</label>";
        echo "<input type='text' id='zip' name='zip' required><br>";
        echo "<label for='city'>City:</label>";
        echo "<input type='text' id='city' name='city' required><br>";
        echo "<label for='country'>Country:</label>";
        echo "<input type='text' id='country' name='country' required><br>";
        echo "<input type='submit' name='submit' value='Save Address'>";
        echo "</form>";
    }
}
?>
