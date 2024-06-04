<?php
namespace Controllers;


use Models\ConfirmationModel;
use Views\ConfirmationView;

class ConfirmationController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function showConfirmation($user_id) {
        if ($user_id === null) {
            echo "Veuillez vous connecter pour accéder à cette page.";
            return;
        }

        // Récupération de l'adresse depuis la session
        $address = $_SESSION['address'] ?? [];

        // Récupération du moyen de livraison depuis la session
        $deliveryOptionId = $_SESSION['delivery'] ?? null;
        $deliveryOption = null;

        // Si une option de livraison est sélectionnée, récupérer ses détails depuis la session
        if ($deliveryOptionId !== null) {
            $deliveryOption = [
                'id' => $deliveryOptionId,
                'delivery_option' => $_SESSION['delivery_option'] ?? '',
                'deliver_time' => $_SESSION['deliver_time'] ?? ''
            ];
        }

        // Récupération des détails du panier
        $cartModel = new ConfirmationModel();
        $cartDetails = $cartModel->getCartDetails($user_id);

        // Affichage de la page de confirmation
        $view = new ConfirmationView();
        $view->render($address, $deliveryOption, $cartDetails);
    }
}
?>
