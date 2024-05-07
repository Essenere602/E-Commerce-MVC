<?php
namespace Controllers;
// Inclure le fichier contenant la classe UserModel


use models\UserModel; // Importez la classe UserModel

class UserController {
    protected $userModel; // Déclarez une propriété pour le modèle
    protected $tralala; // Déclarez une propriété pour le modèle


    public function __construct() {
        $this->userModel = new UserModel(); // Instanciez le modèle dans le constructeur
        $this->tralala = new RegisterForm(); // Instanciez le modèle dans le constructeur
    }

    // Vue
    public function RegisterForm () {
      this->tralala->initForm();
    }

    // Modèle
    public function UserSave() {
        $this->userModel->createUser(); // Appel de la méthode createUser du modèle
    }
}
?>
