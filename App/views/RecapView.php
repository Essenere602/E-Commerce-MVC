<?php
namespace Views;

class RecapView {
    public function initForm($orderDetails) {
        echo "<h1>Order Summary</h1>";
        echo "<ul>";
        if (isset($_SESSION['selected_delivery_option'])) {
            echo '<p>Selected Delivery ID: ' . htmlspecialchars($_SESSION['selected_delivery_option']) . '</p>';
            echo 'cart id : ' . $_SESSION['cart_id'] . '';
        } else {
            echo '<p>No delivery option selected.</p>';
        }
        foreach ($orderDetails as $item) {
            echo "<li>Product ID: " . $item['product_id'] . ", Price: " . $item['price_exc_vat'] . ", Quantity: " . $item['quantity'] . ", VAT: " . $item['vat'] . ", VAT Amount: " . $item['vat_amount'] . "</li>";
        }
        echo "</ul>";
        // Bouton Payer
        echo '<form method="post" action="commande/paiement">
                <input type="submit" name="pay" value="Payer">
              </form>';
    }
} 
?>
