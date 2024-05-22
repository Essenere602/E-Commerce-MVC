<?php
namespace Controllers;

use Models\AddressModel;
use Views\AddressView;

class AddressController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function show($user_id) {
        if ($user_id === null) {
            echo "Veuillez vous connecter pour accéder à cette page.";
            return;
        }

        $view = new AddressView();
        $view->render();
    }

    public function saveAddress($user_id) {
        if ($user_id === null) {
            echo "Veuillez vous connecter pour accéder à cette page.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new AddressModel();
            $success = $model->insertAddress($user_id);

            if ($success) {
                header("Location: ?action=commande&step=livraison");
                exit();
            } else {
                echo "Erreur lors de l'enregistrement de l'adresse.";
            }
        } else {
            echo "Méthode non autorisée.";
        }
    }
}
