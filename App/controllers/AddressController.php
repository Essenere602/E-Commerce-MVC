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
        if (isset($_SESSION['user_id'])) { //vérifie si l'utilisateur est connecté

            $userId = $_SESSION['user_id']; //récupère l'ID de l'utilisateur connecté
            $address = $this->addressModel->getAddressByUserId($userId); //récupère l'adresse de l'utilisateur à partir de l'ID

            if ($address) { //vérifie si l'adresse existe.
                $this->addressView->updateAddressForm($address); //affiche le formulaire de m.a.j de l'adresse si elle existe
            } else {
                $this->addressView->addressForm(); //si non, affiche le formulaire de création de l'adresse si elle n'existe pas
            }
        } else {
            echo "Utilisateur non connecté.";
        }
    }

    // Méthode pour enregistrer l'adresse
    public function addressSave() {
        // Vérifie si l'utilisateur est connecté en vérifiant la présence de l'ID dans la session
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id']; //récupère l'ID de l'utilisateur à partir de la session
            $address = $this->addressModel->getAddressByUserId($userId); //récupère l'adresse de l'utilisateur à partir de l'ID

            if ($address) { //vérifie si l'adresse existe.
                $this->addressModel->updateAddress($userId); //met à jour l'adresse si elle existe
            } else {
                $this->addressModel->createAddress($userId); //affiche le formulaire pour créer une nouvelle adresse si elle n'existe pas
            }
        } else {
            echo "Utilisateur non connecté."; // Affiche un message si l'utilisateur n'est pas connecté
        }
    }
}
