<?php
namespace Views;

class ProductListView {
    public function displayProducts($products) {
        echo "<h1>Liste des produits</h1>";
        echo "<ul class='product-list'>";
        foreach ($products as $product) {
            echo "<li>";
            echo "<h2>{$product['product_name']}</h2>";
            echo "<p>Prix : {$product['price']} €</p>";
            echo "<p>{$product['product_description']}</p>";
            echo "</a>";
            echo "</li>";
        }
        echo "</ul>";
        // Ajouter la pagination ici si nécessaire
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> origin/Samuel
