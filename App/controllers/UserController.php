<?php
namespace Controllers; // On définie la zon qui doit être identique à celle déclarée dans le composer.json

// On importe les vues et modèles
use Models\UserModel; 
use Views\RegisterForm;
 
class UserController {
    // On déclare les attributs pour nos instances
    protected $userModel; 
    protected $tralala;
    
    // On instancie les classes modèles et vues
    public function __construct() {
        $this->userModel = new UserModel(); 
        $this->tralala = new RegisterForm(); 
    }

    // Méthode pour la vue
    public function RegisterForm () {
        $this->tralala->initForm();
    }

    // Méthode pour le modèle
    public function UserSave() {// Appel de la méthode createUser du modèle
        $this->userModel->createUser();
    }
}
?>
