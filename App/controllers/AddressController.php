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

        // Afficher le formulaire d'adresse
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
            $model->insertAddress($user_id);

            
        } else {
            echo "Méthode non autorisée.";
        }
    }
}
?>
