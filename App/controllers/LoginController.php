<?php
// Déclare le namespace pour la classe LoginController
namespace Controllers;

// Importation des classes LoginModel et LoginForm des namespaces Models et Views
use Models\LoginModel;
use Views\LoginForm;

// Définition de la classe LoginController
class LoginController {

    // Méthode pour afficher le formulaire de connexion
    public function LoginForm() {
        // Instanciation de la vue LoginForm
        $view = new LoginForm();
        // Appel de la méthode render pour afficher le formulaire de connexion
        $view->render();
    }

    // Méthode pour authentifier l'utilisateur et sauvegarder les informations de l'utilisateur
    public function UserSave() {
        // Vérifie si les champs email et password sont définis dans le formulaire POST
        if (isset($_POST['email']) && isset($_POST['password'])) {
            // Récupère l'email et le mot de passe du formulaire POST
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Instanciation du modèle LoginModel
            $model = new LoginModel();
            // Appel de la méthode authenticate du modèle pour vérifier les identifiants de l'utilisateur
            $result = $model->authenticate($email, $password);
            // Si l'authentification réussit
            if ($result) {
                // Sauvegarde l'email de l'utilisateur dans la session
                $_SESSION['user'] = $email;
                echo "Login successful!";
                // Redirige vers une page protégée ou le tableau de bord
                header("Location: ?action=dashboard");
                exit();
            } else {
                // Affiche un message d'erreur si l'authentification échoue
                echo "Invalid email or password.";
            }
        } else {
            // Affiche un message d'erreur si les champs email et password ne sont pas remplis
            echo "Email and Password are required.";
        }
    }

    // Méthode pour déconnecter l'utilisateur
    public function logout() {
        // Supprime toutes les variables de session
        session_unset();
        // Détruit la session
        session_destroy();
        // Redirige vers la page de connexion
        header("Location: login");
        exit();
    }
}
?>
