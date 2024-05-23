<?php
namespace Controllers;

use Models\PaymentModel;
use Views\PaymentView;

class PaymentController {
    protected $model;

    public function __construct() {
        $this->model = new PaymentModel();
    }

    public function processPayment($selectedDeliveryId, $cardNumber, $expiryDate, $cvv) {
        $success = $this->model->processPayment($selectedDeliveryId, $cardNumber, $expiryDate, $cvv);
        
        if ($success) {
            // Le paiement a réussi, afficher un message de confirmation
            echo "Payment successful. Thank you for your order!";
        } else {
            // Le paiement a échoué, afficher un message d'erreur
            echo "Payment failed. Please try again later.";
        }
    }
}
?>
