<?php
namespace Views; 

class ProductShowView {
    public function showItem($item) {
        if ($item !== null && isset($item['product_name'])) {
            echo '<p>Nom du produit : ' . $item['product_name'] . '</p>';
            echo '<p>Prix : '  . $item['price'] . '</p>';
            echo '<p>Description : ' . $item['product_description'] . '</p>';
            echo '<p>Quantité : ' . $item['stock'] . '</p>';

        } else {
            echo "Produit non trouvé.";
        }
    }
} 
