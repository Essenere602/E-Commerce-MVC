<?php
namespace Views;

class DeliveryView {

    public function initForm($deliveryOptions) {
        echo '<h1>Choix du livreur</h1>';
        echo '<form method="POST" id="deliveryForm">';
        echo '<select name="delivery_option" id="deliveryOption">';
        foreach ($deliveryOptions as $option) {
            echo '<option value="' . $option['id'] . '">' . $option['delivery_option'] . '</option>';
        }
        echo '</select>';
        echo '<div id="deliveryTimeContainer"></div>';
        echo '<button type="submit">Valider</button>';
        echo '</form>';

        echo '<script>
                document.getElementById("deliveryOption").addEventListener("change", function() {
                    var selectedDeliveryId = this.value;
                    var deliveryTime = document.getElementById("deliveryTime_" + selectedDeliveryId).innerHTML;
                    document.getElementById("deliveryTimeContainer").innerHTML = "<p>Delivery Time: " + deliveryTime + "</p>";
                });
              </script>';
        foreach ($deliveryOptions as $option) {
            echo '<p id="deliveryTime_' . $option['id'] . '" class="delivery-time" style="display: none;">' . htmlspecialchars($option['deliver_time']) . '</p>';
        }
    }
}
