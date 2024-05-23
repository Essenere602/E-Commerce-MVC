<?php
namespace Controllers;

use Models\AddressModel;
use Views\Address;

class AddressController {
    protected $addressModel;
    protected $addressView;

    public function __construct() {
        $this->addressModel = new AddressModel();
        $this->addressView = new Address();
    }

    // Méthode pour afficher le formulaire
    public function addressForm() {
        $this->addressView->addressForm();
    }

    // Méthode pour enregistrer l'adresse
    public function addressSave($email) {
        $userId = $this->addressModel->getUserIdByEmail($email);
        if ($userId) {
            $this->addressModel->createAddress($userId);
        } else {
            echo "Utilisateur non trouvé.";
        }
    }
}
