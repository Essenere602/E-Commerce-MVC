<?php
namespace Views;

class ValidationView {

    public function initForm($orderDetails) {
        echo 
            '<form method="POST">
            <h1>Validation de la commande ?</h1>
            <button>Valider</button>
            </form>';
        
        if (!empty($orderDetails)) {
            foreach ($orderDetails as $order) {
                echo '<p>Produit ID: ' . htmlspecialchars($order['product_id']) . '</p>';
                echo '<p>Prix HT: ' . htmlspecialchars($order['price_exc_vat']) . '</p>';
                echo '<p>TVA: ' . htmlspecialchars($order['vat']) . '</p>';
                echo '<p>Montant TVA: ' . htmlspecialchars($order['vat_amount']) . '</p>';
            }
        } else {
            echo '<p>Les détails de la commande ne sont pas disponibles.</p>';
        }
    }
}