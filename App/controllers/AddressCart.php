<?php
// Déclare le namespace pour la classe AddressCart
namespace Controllers;

// Importation des classes AddressCartModel et AddressView des namespaces Models et Views
use Models\AddressCartModel;
use Views\AddressView; 

// Définition de la classe AddressCart
class AddressCart {
    // Déclaration des propriétés protégées pour le modèle et la vue
    protected $addressModel;
    protected $addressView;

    // Constructeur de la classe AddressCart
    public function __construct() {
        // Instanciation du modèle AddressCartModel
        $this->addressModel = new AddressCartModel();
        // Instanciation de la vue AddressView
        $this->addressView = new AddressView();
    }

    // Méthode pour afficher le formulaire d'adresse
    public function AddressForm() {
        // Récupération de l'adresse depuis le modèle
        $address = $this->addressModel->fetchAddress();
        // Appel de la méthode initForm de la vue pour afficher le formulaire avec l'adresse
        $this->addressView->initForm($address);
    }

    // Méthode pour sauvegarder une adresse
    public function AddressSave() {
        // Appel de la méthode saveAddress du modèle pour sauvegarder l'adresse
        $this->addressModel->saveAddress();
        // Redirection vers la page de choix de livraison après la sauvegarde
        header("Location: ./livraison");
        exit();
    }
}
?>
