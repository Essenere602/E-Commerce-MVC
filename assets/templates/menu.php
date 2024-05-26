<nav id="menu">
    <a href="accueil">Accueil</a>
    <a href="categorie">Catégories</a>
    <a href="panier">Mon Panier</a>

    <?php
    // Vérifie si l'utilisateur est connecté
    if (isset($_SESSION['user_id'])) {
        echo '<a href="compte">Mon Compte</a>';
        echo '<a href="?action=logout">Deconnexion</a>';


        echo ' <div class="dropdown">
                <a href="admin"> Admin</a>
                <div class="dropdown-content">
                <a href="admin/produits">Créer un produit</a>
                </div>
                </div>';
    } else {
        echo '<a href="login">Connexion</a>';
        echo '<a href="inscription">Inscription</a>';
    }
    ?>
</nav>
