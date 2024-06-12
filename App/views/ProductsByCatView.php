<?php
namespace Views; // Définition du namespace pour la classe ProductsByCatView

class ProductsByCatView {
    // Méthode pour afficher les produits d'une catégorie
    public function showItems($items) {
        $session_id = 2; // Identifiant de session temporaire
        // Affichage du titre
        echo '<h1> Les produits </h1>';
        // Boucle à travers les produits
        foreach($items as $item) {
            echo '<form class="product-form">'; // Début du formulaire pour chaque produit
            echo '<label>' . $item['product_name'] . '</label>'; // Affichage du nom du produit
            // Champ caché pour l'ID du produit
            echo '<input type="text" name="product_id" class="product_id" value="' . $item['id'] . '">';
            // Champ caché pour l'identifiant de session
            echo '<input type="hidden" name="session_id" class="session_id" value="' . $session_id . '">';
            // Champ de lecture seule pour afficher le prix
            echo '<input type="text" name="price" class="price" value="' . $item['price'] . '" readonly >';
            // Champ pour saisir la quantité
            echo '<input type="number" name="qte" class="qte">';
            
            // Affichage des images
            if (isset($item['images']) && !empty($item['images'])) {
                foreach ($item['images'] as $image) {
                    echo '<img src="' . $image . '" alt="' . $item['product_name'] . '">';
                }
            }
            
            // Bouton pour ajouter le produit au panier
            echo '<button type="button" class="add-to-cart">Ajouter</button>';
            echo '</form>'; // Fin du formulaire pour chaque produit
        }
        // Inclusion du script JavaScript pour gérer l'ajout au panier
        echo '<script src="assets/js/addToCart.js"></script>';
    }
}
?>
