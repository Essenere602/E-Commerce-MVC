<?php
namespace Controllers;

use Models\DeliveryModel;
use Views\DeliveryView;

class DeliveryController {
    public function showDeliveryForm() {
        $view = new DeliveryView();
        $view->render();
    }

    public function saveDelivery() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifier si l'utilisateur est connecté
            $user_id = $_SESSION['user_id'] ?? null;
            if ($user_id === null) {
                echo "Veuillez vous connecter pour accéder à cette page.";
                return;
            }

            // Récupérer les données du formulaire
            $delivery_option = $_POST['delivery_option'] ?? '';
            $deliver_time = $_POST['delivery_time'];

            // Valider et enregistrer le mode de livraison
            if (!empty($delivery_option)) {
                $model = new DeliveryModel();
                $success = $model->saveDeliveryMethod($user_id, $delivery_option, $deliver_time);
                if ($success) {
                    echo "Le mode de livraison a été enregistré avec succès.";
                } else {
                    echo "Une erreur s'est produite lors de l'enregistrement du mode de livraison.";
                }
            } else {
                echo "Veuillez sélectionner un mode de livraison.";
            }
        } else {
            echo "Méthode non autorisée.";
        }
    }
}
