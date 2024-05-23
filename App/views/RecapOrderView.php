<?php
namespace Views;

class RecapOrderView {
    public function render($data) {
        echo '<h1>Récapitulatif de la commande</h1>';
        if (!empty($data['orderDetails'])) {
            echo '<table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>';
            foreach ($data['orderDetails'] as $item) {
                echo '<tr>
                    <td>' . htmlspecialchars($item['product_name']) . '</td>
                    <td>' . htmlspecialchars($item['quantity']) . '</td>
                    <td>' . htmlspecialchars($item['price']) . '</td>
                </tr>';
            }
            echo '</tbody>
            </table>';
        } else {
            echo '<p>Votre panier est vide.</p>';
        }
    }
}

