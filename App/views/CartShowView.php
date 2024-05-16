<?php
namespace Views;

class CartShowView {
    public function showItems($items) {
        foreach($items as $item) {
            echo '<form class="product-form">';
            echo '<input type="hidden" name="product_id" value="' . $item['product_id'] . '">';
            echo '<input type="hidden" name="cart_detail_id" value="' . $item['id'] . '">';
            echo '<h3>' . $item['product_name'] . '</h3>';
            echo '<p>Price: ' . $item['price_exc_vat'] . '</p>';
            echo '<p>Quantity: ' . $item['quantity'] . '</p>';
            echo '<button type="submit">Remove from Cart</button>';
            echo '</form>';
        }
    }
}
?>
