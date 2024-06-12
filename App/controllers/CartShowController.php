<?php
// Déclare le namespace pour la classe CartShowController
namespace Controllers;

// Importation des classes CartShowModel et CartShowView des namespaces Models et Views
use Models\CartShowModel;
use Views\CartShowView;

// Définition de la classe CartShowController
class CartShowController {
    // Déclaration des propriétés protégées pour le modèle et la vue
    protected $itemModel; 
    protected $itemView;

    // Constructeur de la classe CartShowController
    public function __construct() {
        // Instanciation du modèle CartShowModel
        $this->itemModel = new CartShowModel(); 
        // Instanciation de la vue CartShowView
        $this->itemView = new CartShowView(); 
    }

    // Méthode pour afficher les articles du panier
    public function show($cart_id) {
        // Récupération des articles du panier par l'ID de l'utilisateur depuis le modèle
        $cartItems = $this->itemModel->CartByUser($cart_id);
        // Appel de la méthode showItems de la vue pour afficher les articles du panier
        $this->itemView->showItems($cartItems);
    }
}
?>
