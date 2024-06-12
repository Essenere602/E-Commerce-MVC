<?php
namespace Views;

class AccountView {
    public function showProfileForm () {
        echo '<h1>Modifier son compte</h1>
        <form class="vertical" method="post">
            <label for="lastname">Nom</label><input type="text" name="lastname" id="lastname">
            <label for="firstname">Prénom</label><input type="text" name="firstname" id="firstname">
            <label for="email">Email</label><input type="text" name="email" id="email">
            <label for="phone">Téléphone</label><input type="text" name="phone" id="phone">
            <label for="password">Mot de passe</label><input type="password" name="password" id="password">
            <button>Envoyer</button>
        </form>';
    }

    public function showAddresses($addresses) {
        echo '<h1>Mes adresses</h1>
        <form method="post" action="compte/adresses">
            <label for="address_1">Adresse 1</label><input type="text" name="address_1" id="address_1">
            <label for="address_2">Adresse 2</label><input type="text" name="address_2" id="address_2">
            <label for="zip">Code postal</label><input type="text" name="zip" id="zip">
            <label for="city">Ville</label><input type="text" name="city" id="city">
            <label for="country">Pays</label><input type="text" name="country" id="country">
            <button>Ajouter l\'adresse</button>
        </form>
        <ul>';
        foreach ($addresses as $address) {
            echo '<li>' . $address['address_1'] . ', ' . $address['city'] . ', ' . $address['country'] . '</li>';
        }
        echo '</ul>';
    }

    public function showOrders($orders) {
        // Regrouper les détails des commandes par commande
        $ordersGrouped = [];
        foreach ($orders as $order) {
            $orderId = $order['order_id']; // Utiliser 'order_id' car 'id' peut se référer à user_order_detail
            if (!isset($ordersGrouped[$orderId])) {
                $ordersGrouped[$orderId] = [
                    'id' => $orderId,
                    'user_id' => $order['user_id'],
                    'order_date' => $order['order_date'],
                    'amount_exc_vat' => $order['amount_exc_vat'],
                    'details' => []
                ];
            }
            $ordersGrouped[$orderId]['details'][] = [
                'product_id' => $order['product_id'],
                'product_option_id' => $order['product_option_id'],
                'product_option_value' => $order['product_option_value'],
                'price_exc_vat' => $order['price_exc_vat'],
                'quantity' => $order['quantity'],
                'vat' => $order['vat'],
                'vat_amount' => $order['vat_amount']
            ];
        }
    
        // Affichage des commandes et de leurs détails
        echo '<h1>Mes commandes</h1>';
        foreach ($ordersGrouped as $order) {
            echo '<details>';
            echo '<summary>Commande ' . $order['id'] . ' - Date: ' . $order['order_date'] . ' - Montant HT: ' . $order['amount_exc_vat'] . '</summary>';
            echo '<ul>';
            foreach ($order['details'] as $detail) {
                echo '<li>';
                echo 'Produit ID: ' . $detail['product_id'] . ' - Option ID: ' . $detail['product_option_id'] . ' - Valeur de l\'option: ' . $detail['product_option_value'] . ' - Prix HT: ' . $detail['price_exc_vat'] . '€ - Quantité: ' . $detail['quantity'] . ' - TVA: ' . $detail['vat'] . '%';
                echo '</li>';
            }
            echo '</ul>';
            echo '</details>';
        }
    }  
}
?>
