<?php
namespace Controllers;

use Models\ProductModel;
use Views\ProductListView;

class ProductController {
    public function listProducts() {
        $productModel = new ProductModel();
        $products = $productModel->getAllProducts(); // Méthode à implémenter dans votre modèle

        $productListView = new ProductListView();
        $productListView->displayProducts($products);
    }
}
