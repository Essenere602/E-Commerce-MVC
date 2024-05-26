<?php
namespace Views;

class ProductsByCatView {
    public function showItems($items) {
        // Récupérer l'userId depuis la session
        $userId = $_SESSION['id'] ?? null;

        foreach($items as $item) {
            echo '<form class="product-form">';

            //nom du produit :
            echo '<label>' . $item['product_name'] . '</label>';

            //id du produit :
            echo '<input type="hidden" name="product_id" class="product_id" value="' . $item['id'] . '">';

            //id de l'utilisateur :
            echo '<input type="hidden" name="user_id" class="user_id" value="' . $userId . '">';

            //prix :
            echo '<input type="text" id="price" name="price" class="price" value="' . $item['price'] . '" readonly>';
        
            //quantité :
            echo '<input type="number" name="qte" class="qte"  placeholder="0">';

            echo '<button type="button" class="add-to-cart">Ajouter</button>';
            echo '</form>';
        }
        echo '<script src="assets/js/addToCart.js"></script>';
    }
}
?>
