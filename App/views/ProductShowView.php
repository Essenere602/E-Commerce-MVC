<?php
namespace Views; 

class ProductShowView {
    public function showItem($item) {
        if ($item !== null && isset($item['product_name'])) {
            echo '<p>' . $item['product_name'] . '</p>';
            echo '<p>' . $item['price'] . '</p>';
        } else {
            echo "Produit non trouvé.";
        }
    }
} 
