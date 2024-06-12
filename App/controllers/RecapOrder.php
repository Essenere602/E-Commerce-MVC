<?php
// Déclare le namespace pour la classe RecapOrder
namespace Controllers;

// Importation des classes RecapOrderModel et RecapView des namespaces Models et Views
use Models\RecapOrderModel;
use Views\RecapView;

// Définition de la classe RecapOrder
class RecapOrder {
    // Déclaration des propriétés protégées pour le modèle et la vue
    protected $recapModel;
    protected $recapView;

    // Constructeur de la classe RecapOrder
    public function __construct() {
        // Instanciation du modèle RecapOrderModel
        $this->recapModel = new RecapOrderModel();
        // Instanciation de la vue RecapView
        $this->recapView = new RecapView();
    }

    // Méthode pour afficher le récapitulatif de la commande
    public function RecapPlz($cart_id) {
        // Récupération des détails de la commande en utilisant l'identifiant du panier (cart_id)
        $orderDetails = $this->recapModel->displayOrder($cart_id);

        // Passage des détails de la commande à la vue pour le rendu
        $this->recapView->initForm($orderDetails);
    }
}
?>
