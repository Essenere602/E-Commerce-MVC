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
    public function addressSave() {
        // Vérifie si l'utilisateur est connecté en vérifiant la présence de l'ID dans la session
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id']; // Récupère l'ID de l'utilisateur à partir de la session
            $this->addressModel->createAddress($userId); // Utilise l'ID de l'utilisateur pour créer l'adresse
        } else {
            echo "Utilisateur non connecté."; // Affiche un message si l'utilisateur n'est pas connecté
        }
    }
    
}
