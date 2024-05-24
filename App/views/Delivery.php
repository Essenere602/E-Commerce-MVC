<?php

namespace Views;

class Delivery {

    public function formDelivery($deliveryOptions) {

        echo '<h2> Choisissez votre mode de livraison </h2>';

        foreach ($deliveryOptions as $option) {
            echo '<div>';

            echo '
            <input type="radio" id="' . htmlspecialchars($option['delivery_option']) . '" name="livraison" value="' . htmlspecialchars($option['delivery_option']) . '" />';

            echo '
            <label for="' . htmlspecialchars($option['delivery_option']) . '">' . htmlspecialchars($option['delivery_option']) . ' (' . htmlspecialchars($option['deliver_time']) . ')</label>';
            
            echo '</div>';
        }
    }
}
