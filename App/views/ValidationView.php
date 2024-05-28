<?php
namespace Views;

class ValidationView {

    public function initForm($order) {
        echo 
            '<form method="POST">
            <h1>Validation de la commande ?</h1>
            <button>Valider</button>
            </form>';
        
        if (isset($order['vat'])) {
            echo '<p>Bonjour je s\'appelle ' . htmlspecialchars($order['vat']) . '.</p>';
        } else {
            echo '<p>Les détails de la commande ne sont pas disponibles.</p>';
        }
    }
}