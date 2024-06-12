<?php

// Déclare le namespace pour la classe CategoriesController
namespace Controllers;

// Importation des classes CategoriesModel et CategoriesView des namespaces Models et Views
use Models\CategoriesModel; 
use Views\CategoriesView;

// Définition de la classe CategoriesController
class CategoriesController {
    // Déclaration des propriétés protégées pour le modèle et la vue
    protected $categoryModel; 
    protected $categoriesView;

    // Constructeur de la classe CategoriesController
    public function __construct() {
        // Instanciation du modèle CategoriesModel
        $this->categoryModel = new CategoriesModel(); 
        // Instanciation de la vue CategoriesView
        $this->categoriesView = new CategoriesView(); 
    }

    // Méthode pour afficher les catégories
    public function showCategories() {
        // Récupération des catégories depuis le modèle
        $categories = $this->categoryModel->getCategories();
        // Appel de la méthode showItems de la vue pour afficher les catégories
        $this->categoriesView->showItems($categories);
    }
}
?>
