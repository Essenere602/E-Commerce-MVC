<?php
public function showProduct($slug) {
    // Utilisez le slug pour récupérer les informations du produit depuis la base de données
    $product = $this->productModel->getProductBySlug($slug);

    // Affichez les informations du produit dans la vue appropriée
    require_once('views/product_details.php');
}
