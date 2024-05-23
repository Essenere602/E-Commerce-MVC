<?php
namespace Controllers; // On définie la zon qui doit être identique à celle déclarée dans le composer.json

// On importe les vues et modèles
use Models\AccountModel; 
use Views\AccountView;

class AccountController {
    // On déclare les attributs pour nos instances
    protected $accountModel; 
    protected $accountView;
    
    // On instancie les classes modèles et vues
    public function __construct() {
        $this->accountModel = new AccountModel(); 
        $this->accountView = new AccountView(); 
    }

    // Méthode pour la vue
    public function UpdateForm () {
        $this->accountView->initForm();
    }

    // Méthode pour le modèle
    public function UserSave() {// Appel de la méthode createUser du modèle
        $this->accountModel->updateUser();
    }
}
?>
