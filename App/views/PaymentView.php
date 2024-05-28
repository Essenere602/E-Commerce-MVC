<?php
namespace Views;

class PaymentView {
    public function initForm($paymentOptions) {
        echo '<h1>Choix du moyen de paiement</h1>';
        echo '<form method="POST" id="paymentForm">';
        echo '<select name="payment_name" id="paymentOption">';
        foreach ($paymentOptions as $option) {
            echo '<option value="' . $option['id'] . '">' . $option['payment_name'] . '</option>';
        }
        echo '</select>';
        echo '<button type="submit">Valider</button>';
        echo '</form>';
    }
}