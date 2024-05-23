<?php
namespace Controllers;

use Models\DeliveryCartModel;
use Views\DeliveryView;

class DeliveryController {
    protected $model;

    public function __construct() {
        $this->model = new DeliveryCartModel();
    }

    public function showDeliveries() {
        $deliveries = $this->model->getDeliver();
        $view = new DeliveryView();
        $view->render($deliveries);
    }

    public function selectDelivery() {
        if (isset($_POST['delivery_id'])) {
            $selectedDeliveryId = $_POST['delivery_id'];
            // Stocker l'ID de livraison sélectionné dans la session
            $_SESSION['selected_delivery_id'] = $selectedDeliveryId;
            // Rediriger vers la page de paiement
            header('Location: commande/paiement');
            exit();
        } else {
            echo "No delivery option selected.";
        }
    }
}
?>