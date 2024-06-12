<?php
// Déclare le namespace pour la classe DeliveryCart
namespace Controllers;

// Importation des classes DeliveryCartModel et DeliveryView des namespaces Models et Views
use Models\DeliveryCartModel;
use Views\DeliveryView;

// Définition de la classe DeliveryCart
class DeliveryCart {
    // Déclaration des propriétés protégées pour le modèle et la vue
    protected $deliveryModel;
    protected $deliveryView;

    // Constructeur de la classe DeliveryCart
    public function __construct() {
        // Instanciation du modèle DeliveryCartModel
        $this->deliveryModel = new DeliveryCartModel();
        // Instanciation de la vue DeliveryView
        $this->deliveryView = new DeliveryView();
    }

    // Méthode pour afficher les options de livraison
    public function DeliveryChoice() {
        // Récupération des options de livraison depuis le modèle
        $deliveryOptions = $this->deliveryModel->fetchDeliveryOpt();
        // Appel de la méthode initForm de la vue pour afficher les options de livraison
        $this->deliveryView->initForm($deliveryOptions);

        // Vérifier si la requête est de type POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Appel de la méthode pour sauvegarder l'option de livraison sélectionnée
            $this->DeliverySave();
        }
    }

    // Méthode pour sauvegarder l'option de livraison sélectionnée
    public function DeliverySave() {
        // Vérifier si une option de livraison a été sélectionnée
        if (isset($_POST['delivery_option'])) {
            // Enregistrer l'option de livraison sélectionnée dans la session
            $_SESSION['selected_delivery_option'] = $_POST['delivery_option'];
            // Rediriger vers la page de récapitulatif
            header('Location: recap');
            exit();
        } else {
            // Afficher un message d'erreur si aucune option de livraison n'a été sélectionnée
            echo "No delivery option selected.";
        }
    }
}
?>
