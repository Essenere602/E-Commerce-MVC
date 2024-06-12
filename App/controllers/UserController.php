<?php
// Déclare le namespace pour la classe UserController
namespace Controllers; // On définie la zone qui doit être identique à celle déclarée dans le fichier composer.json

// On importe les classes UserModel et RegisterForm des namespaces Models et Views
use Models\UserModel; 
use Views\RegisterForm;
 
// Définition de la classe UserController
class UserController {
    // Déclaration des propriétés protégées pour le modèle et la vue
    protected $userModel; 
    protected $userView;
    
    // Constructeur de la classe UserController
    public function __construct() {
        // Instanciation de la classe UserModel
        $this->userModel = new UserModel(); 
        // Instanciation de la classe RegisterForm
        $this->userView = new RegisterForm(); 
    }

    // Méthode pour afficher le formulaire d'inscription
    public function RegisterForm() {
        // Appel de la méthode initForm de la vue pour afficher le formulaire d'inscription
        $this->userView->initForm();
    }

    // Méthode pour enregistrer un utilisateur
    public function UserSave() {
        // Appel de la méthode createUser du modèle pour créer un utilisateur
        $this->userModel->createUser();
    }
}
?>
