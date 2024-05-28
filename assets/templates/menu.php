<nav id="menu">
    <ul>
        <li><a href="accueil">Accueil</a></li>
        <li><a href="categorie">Catégories</a></li>
        <li><a href="panier">Mon Panier</a></li>

        <?php
        // Vérifie si l'utilisateur est connecté
        if (isset($_SESSION['user'])) {
            echo '
                <li><a href="compte">Mon Compte</a></li>
                <li><a href="?action=logout">Déconnexion</a></li>
                <li><a href="commande">Commander</a></li>
                <li class="dropdown">
                    <a href="admin">Admin</a>
                    <div class="dropdown-content">
                        <a href="admin/produits">Créer un produit</a>
                    </div>
                </li>';
        } else {
            echo '
                <li><a href="login">Connexion</a></li>
                <li><a href="inscription">Inscription</a></li>
                <li><a href="admin">Admin</a></li>';
        }
        ?>
    </ul>
</nav>
