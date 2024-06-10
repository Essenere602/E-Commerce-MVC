<nav id="menu">
        <a href="accueil">Accueil</a>
        <a href="categorie">Catégories</a>
        <a href="panier">Mon Panier</a>
        <a href="commande">Commander</a>
        <?php 
        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['id'])) {
            // Afficher le lien de déconnexion
            echo '<a href="compte">Welcome, ' . htmlspecialchars($_SESSION['user']) . '!</a>';
            echo '<a href="admin">Admin</a>';
            echo '<a href="?action=logout">Déconnexion</a>';
        } else {
            // Afficher le lien de connexion
            echo '<a href="login">Connexion</a>';
            echo '<a href="inscription">Inscription</a>';
        }
        ?>
</nav>
