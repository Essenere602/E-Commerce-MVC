<?php
namespace Views;

class ProductsByCatView {
    public function showItems($items) {


        foreach($items as $item) {
            echo '<form class="product-form">';
            echo '<label>' . $item['product_name'] . '</label>';
            echo '<input type="text" name="product_id" class="product_id" value="' . $item['id'] . '">';
            echo '<input type="text" name="price" class="price" value="' . $item['price'] . '" readonly >';
            echo '<input type="number" name="qte" class="qte">';
            echo '<button type="button" class="add-to-cart">Ajouter</button>';
            echo '</form>';
        }
        echo '<script src="assets/js/addToCart.js"></script>';
    }
}
?>
