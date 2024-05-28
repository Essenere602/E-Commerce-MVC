<?php
namespace Views;

class RecapView {
    public function initForm($orderDetails) {
        echo "<h1>Order Summary</h1>";
        echo "<ul>";
        if (isset($_SESSION['selected_delivery_option'])) {
            echo '<p>Selected Delivery ID: ' . htmlspecialchars($_SESSION['selected_delivery_option']) . '</p>';
            
            if (isset($_SESSION['user_address'])) {
                $address = $_SESSION['user_address'];
                echo '<p>Selected Address:</p>';
                echo '<ul>';
                echo '<li>Address Line 1: ' . htmlspecialchars($address['address_1']) . '</li>';
                echo '<li>Address Line 2: ' . htmlspecialchars($address['address_2']) . '</li>';
                echo '<li>ZIP Code: ' . htmlspecialchars($address['zip']) . '</li>';
                echo '<li>City: ' . htmlspecialchars($address['city']) . '</li>';
                echo '<li>Country: ' . htmlspecialchars($address['country']) . '</li>';
                echo '</ul>';
            } else {
                echo '<p>No address found.</p>';
            }
        } else {
            echo '<p>No delivery option selected.</p>';
        }
        foreach ($orderDetails as $item) {
            echo "<li>Product ID: " . htmlspecialchars($item['product_id']) . ", Price: " . htmlspecialchars($item['price_exc_vat']) . ", Quantity: " . htmlspecialchars($item['quantity']) . ", VAT: " . htmlspecialchars($item['vat']) . ", VAT Amount: " . htmlspecialchars($item['vat_amount']) . "</li>";
        }
        echo "</ul>";
        // Bouton Payer
        echo '<form method="post" action="commande/paiement">
                <input type="submit" name="pay" value="Payer">
              </form>';
    }
}
?>
