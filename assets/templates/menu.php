<nav id="menu">
    <ul>
        <li><a href="accueil">Accueil</a></li>
        <li><a href="categories">Catégories</a></li>
        <li><a href="panier">Mon Panier</a></li>
        <li><a href="commande">Commander</a></li>
<?php 
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['id'])) {
        // Afficher le lien de déconnexion
        echo '<li><a href="compte">Welcome, ' . htmlspecialchars($_SESSION['user']) . '!</a></li>';
        echo '<li><a href="?action=logout">Déconnexion</a></li>';
        echo '<li><a href="compte">Mon Compte</a></li>';
        echo '<li><a href="admin">Admin</a></li>';
    } else {
        // Afficher le lien de connexion
        echo '<li><a href="login">Connexion</a><li>';
        echo '<li><a href="inscription">Inscription</a></li>';
    }
?>
</nav>