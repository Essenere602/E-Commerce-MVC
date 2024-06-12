<?php
namespace Views; // Définition du namespace pour la classe LoginForm

class LoginForm {
    // Méthode pour rendre le formulaire de connexion
    public function render() {
        // Vérifie si l'utilisateur est connecté
        if (isset($_SESSION['user'])) {
            // Si l'utilisateur est connecté, affiche un message de bienvenue et un bouton de déconnexion
            echo '
            <p>Welcome, ' . htmlspecialchars($_SESSION['user']) . '!</p>
            <form method="POST" action="?action=logout">
                <button type="submit">Logout</button>
            </form>';
        } else {
            // Si l'utilisateur n'est pas connecté, affiche le formulaire de connexion
            echo '
            <h1>Connecte-toi</h1>
            <form class="vertical" action="login" method="post">
                <label for="email">Email</label><input type="text" name="email" id="email">
                <label for="password">Mot de passe</label><input type="password" name="password" id="password">
                <button>Se connecter</button>
            </form>';
        }
    }
}
?>
