<?php
// Déclare le namespace pour la classe ProductsListByCat
namespace Controllers;

// Importation des classes ProductsByCatModel et ProductsByCatView des namespaces Models et Views
use Models\ProductsByCatModel; 
use Views\ProductsByCatView;

// Définition de la classe ProductsListByCat
class ProductsListByCat {
    // Déclaration des propriétés protégées pour le modèle et la vue
    protected $itemModel; 
    protected $itemView;

    // Méthode pour afficher les produits d'une catégorie
    public function show($slug) {
        // Instanciation du modèle ProductsByCatModel
        $this->itemModel = new ProductsByCatModel(); 
        // Instanciation de la vue ProductsByCatView
        $this->itemView = new ProductsByCatView(); 
        // Récupération des produits de la catégorie par son slug depuis le modèle
        $products = $this->itemModel->productsByCat($slug); // Assurez-vous que le slug est bien passé
        // Appel de la méthode showItems de la vue pour afficher les produits de la catégorie
        $this->itemView->showItems($products);
    }
}
?>
