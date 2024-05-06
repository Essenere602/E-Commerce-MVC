<?php
namespace App\Controllers;
// Inclure le fichier contenant la classe UserModel
require_once(MOD . 'UserModel.php');

use App\Models\UserModel; // Importez la classe UserModel

class UserController {
    protected $userModel; // Déclarez une propriété pour le modèle

    public function __construct() {
        $this->userModel = new UserModel(); // Instanciez le modèle dans le constructeur
    }

    // Vue
    public function RegisterForm () {
        require_once(VIEW . 'RegisterForm.php');
    }

    // Modèle
    public function UserSave() {
        $this->userModel->createUser(); // Appel de la méthode createUser du modèle
    }
}
?>
