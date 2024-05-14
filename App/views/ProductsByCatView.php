<?php
namespace Views;

class ProductsByCatView {
    public function showItems($items) {
        foreach($items as $item) {
            echo '<p>' . $item['product_name'] . '</p>';
        }
        // if ($items !== null && isset($items['product_name'])) {
        //     echo '<p>' . $item['product_name'] . '</p>';
        //     echo '<p>' . $item['price'] . '</p>';
        // } else {
        //     echo "Produit non trouvé.";
        // }
    }
}
