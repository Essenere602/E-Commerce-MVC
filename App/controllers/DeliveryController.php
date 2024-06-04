<?php
namespace Controllers;

use Models\DeliveryModel;
use Views\DeliveryView;

class DeliveryController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function delivery() {
        $deliveryModel = new DeliveryModel();
        $deliveryOptions = $deliveryModel->getDeliveryOptions();

        $view = new DeliveryView();
        $view->render($deliveryOptions);
    }

    public function saveDeliveryOption() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $deliveryOptionId = $_POST['delivery_option'] ?? null;

            if ($deliveryOptionId === null) {
                echo "Veuillez sélectionner un moyen de livraison.";
                return;
            }

            // Stocker le choix de livraison dans la session
            $_SESSION['delivery_option'] = $deliveryOptionId;

            // Redirection après succès
            header("Location: ?action=commande&step=confirmation");
            exit();
        } else {
            echo "Méthode non autorisée.";
        }
    }
}
?>
