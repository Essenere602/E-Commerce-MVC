<?php

namespace Models;

class PaymentModel
{
    public function processPayment($nom, $montant)
    {
        // Simuler la vérification du paiement 
    }

    private function generateOrderNumber()
    {
        return 'CMD' . date('YmdHis') . rand(1000, 9999);
    }
} 
