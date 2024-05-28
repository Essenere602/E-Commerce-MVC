<?php

namespace Controllers; 

use Models\PaymentModel;
use Views\PaymentFormView;

class PaymentController
{
    public function processPayment($nom, $montant)
{
    $paymentModel = new PaymentModel();
    $message = $paymentModel->processPayment($nom, $montant);
    
    // Afficher le message de retour
    echo $message;

    // Instancier la vue PaymentFormView
    $paymentFormView = new PaymentFormView();
    
    // Appeler la méthode render() pour afficher le formulaire de paiement
    $paymentFormView->render();
}

}
