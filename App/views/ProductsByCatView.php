<?php
namespace Views;

class ProductsByCatView {
    public function showItems($items) {
        $session_id = 2;

        foreach($items as $item) {
            echo '<form class="product-form">';
            echo '<label>' . $item['product_name'] . '</label>';
            echo '<input type="hidden" name="session_id" class="session_id" value="' . $session_id . '">';
            echo '<input type="text" name="price" class="price" value="' . $item['price'] . '" readonly >';
            echo '<input type="number" name="qte" class="qte">';
            echo '<button type="button" class="add-to-cart">Ajouter</button>';
            echo '</form>';
        }
        echo '<script src="assets/js/addToCart.js"></script>';
    }
}
?>