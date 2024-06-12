<?php
// Déclare le namespace pour la classe ProductShow
namespace Controllers;

// Importation des classes ProductShowModel et ProductShowView des namespaces Models et Views
use Models\ProductShowModel; 
use Views\ProductShowView;
 
// Définition de la classe ProductShow
class ProductShow {
    // Déclaration des propriétés publiques
    public $slug;
    // Déclaration des propriétés protégées pour le modèle et la vue
    protected $itemModel; 
    protected $itemView;

    // Méthode pour afficher les détails d'un produit
    public function show($slug) {
        // Instanciation du modèle ProductShowModel
        $this->itemModel = new ProductShowModel(); 
        // Instanciation de la vue ProductShowView
        $this->itemView = new ProductShowView(); 
        // Récupération des détails du produit par son slug depuis le modèle
        $myItem = $this->itemModel->itemBySlug($slug); // Assurez-vous que le slug est bien passé
        // Appel de la méthode showItem de la vue pour afficher les détails du produit
        $this->itemView->showItem($myItem);
    }
}
?>
