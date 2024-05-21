<?php
// AddressController.php

namespace Controllers;

use Models\AddressModel;
use Views\AddressView;

class AddressController {
    protected $addressModel;
    protected $addressView;

    public function __construct() {
        $this->addressModel = new AddressModel();
        $this->addressView = new AddressView();
    }

    public function show() {
        // Si le formulaire est soumis
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer l'ID de l'utilisateur (simulé ici)
            $user_id = 1; // Remplacez ceci par la logique pour obtenir l'ID de l'utilisateur connecté

            // Enregistrer l'adresse avec l'ID de l'utilisateur
            $this->saveAddress($user_id);
        } else {
            // Afficher le formulaire d'ajout d'adresse
            $this->addressView->displayAddAddressForm();
        }
    }

    public function saveAddress($user_id) {
        // Enregistrer l'adresse avec l'ID de l'utilisateur
        $this->addressModel->insertAddress($user_id);
    }
}
?>
