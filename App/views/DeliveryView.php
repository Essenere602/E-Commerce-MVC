<?php
namespace Views;

class DeliveryView {
    public function render($deliveries) {
        echo '<form method="post" action="commande?step=selectDelivery">';
        foreach ($deliveries as $delivery) {
            echo '<details>
                    <summary>
                        <input type="radio" name="delivery_id" value="' . htmlspecialchars($delivery['id']) . '">
                        ' . htmlspecialchars($delivery['delivery_option']) . '
                    </summary>
                    <p>Delivery Time: ' . htmlspecialchars($delivery['deliver_time']) . '</p>
                </details>';
        }
        echo '<button type="submit">Select Delivery</button>';
        echo '</form>';
    }
}
?>
