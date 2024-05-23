<?php
namespace Controllers;

use Models\PaymentModel;
use Views\RecapOrderView; // Importez la vue RecapOrderView

class PaymentController {
    protected $paymentModel;

    // Injection de dépendance pour le modèle
    public function __construct() {
        $this->paymentModel = new PaymentModel();
    }

    public function recapOrder($user_id) {
        $orderDetails = $this->paymentModel->recapOrder($user_id);
        $this->recapOrder($orderDetails);
    }

}
