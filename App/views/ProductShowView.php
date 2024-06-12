<?php
namespace Views; // Définition du namespace pour la classe ProductShowView

class ProductShowView {
    // Méthode pour afficher les détails d'un produit
    public function showItem($item) {
        // Vérification si le produit existe et s'il a un nom
        if ($item !== null && isset($item['product_name'])) {
            // Affichage du nom du produit
            echo '<p>Nom du produit : ' . $item['product_name'] . '</p>';
            // Affichage du prix du produit
            echo '<p>Prix : '  . $item['price'] . '</p>';
            // Affichage de la description du produit
            echo '<p>Description : ' . $item['product_description'] . '</p>';
            // Affichage de la quantité en stock du produit
            echo '<p>Quantité : ' . $item['stock'] . '</p>';
        } else {
            // Affichage si le produit n'est pas trouvé
            echo "Produit non trouvé.";
        }
    }
}
?>
