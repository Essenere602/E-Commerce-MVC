<?php
namespace Views;

class ProductsByCatView {
    public function showItems($items) {
        // Récupérer l'userId depuis la session
        $userId = $_SESSION['id'] ?? null;

        foreach($items as $item) {
            echo '<form class="product-form">';
            echo '<label>' . $item['product_name'] . '</label>';
            echo '<input type="text" name="product_id" class="product_id" value="' . $item['id'] . '">';
            echo '<input type="hidden" name="user_id" class="user_id" value="' . $userId . '">';
            echo '<input type="text" name="price" class="price" value="' . $item['price'] . '" readonly >';
            echo '<input type="number" name="qte" class="qte">';
            echo '<button type="button" class="add-to-cart">Ajouter</button>';
            echo '</form>';
        }
        echo '<script src="assets/js/addToCart.js"></script>';
    }
}
?>
