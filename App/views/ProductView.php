<?php
namespace Views;

class ProductView {
    public function showProducts($catSlug, $products) {
        echo "<h1>Les produits de la catégorie $catSlug</h1>";
        echo "<ul>";
        foreach ($products as $product) {
            echo "<li>{$product->getName()}</li>";
        }
        echo "</ul>";
    }
}

