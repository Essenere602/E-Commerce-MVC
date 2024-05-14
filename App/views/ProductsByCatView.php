<?php
namespace Views;

class ProductsByCatView {
    public function showItems($items) {
        foreach($items as $item) {
            echo '<hr>';
            echo '<p>' . $item['product_name'] . '</p> ';
            echo '<p>' . $item['product_description'] . '</p> ';
            echo '<p>' . $item['category_id'] . '</p> ';
            echo '<p>' . $item['price'] . '</p> ';
            echo '<p>' . $item['stock'] . ' <form method="post">
                        <input type="hidden" name="product_id" value="' . $item['id'] . '">
                        <input type="hidden" name="product_name" value="' . $item['product_name'] . '">
                        <input type="hidden" name="product_price" value="' . $item['price'] . '">
                        <button type="submit">+</button>
                    </form></p>';
        }
    }
}


