<?php
namespace Views;

class CartShowView {
    public function showItems($items) {
        foreach($items as $item) {
            echo '<form class="product-form">';
            echo '<input type="hidden" name="product_id" value="' . $item['product_id'] . '" class="product_id">';
            echo '<input type="hidden" name="cart_id" value="' . $item['cart_id'] . '" class="cart_id">';
            echo '<input type="hidden" name="cart_detail_id" value="' . $item['id'] . '" class="cart_detail_id">';
            echo '<h3>' . $item['product_name'] . '</h3>';
            echo '<p>Price: ' . $item['price_exc_vat'] . '</p>';
            echo '<p>Quantity: <input type="number" name="qte" class="qte" value="' . $item['quantity'] . '"></p>';
            echo '<button type="button" class="change-qte">Ajuster la quantité</button>';
            echo '<button type="button" class="remove-from-cart">Remove from Cart</button>';
            echo '</form>';
        }
        echo '<form action="commande/adresse">';
        echo '<input type="hidden" name="cart_id" value="' . $item['cart_id'] . '" class="cart_id">';
        echo '<button type="submit" class="passer-commande">Passer la commande</button>';
        echo '</form>';
        
        echo '<script src="./assets/js/updateCart.js"></script>';
    }
}
?>