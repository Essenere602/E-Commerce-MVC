<?php
namespace Views; // Définition du namespace pour la classe CartShowView

class CartShowView { // Définition de la classe CartShowView

    // Méthode pour afficher les articles dans le panier
    public function showItems($items) {
        // Parcourir tous les articles dans le panier
        foreach($items as $item) {
            echo '<form class="product-form">'; // Formulaire pour chaque article
            // Inputs cachés pour stocker les données de l'article
            echo '<input type="hidden" name="product_id" value="' . $item['product_id'] . '" class="product_id">';
            echo '<input type="hidden" name="cart_id" value="' . $item['cart_id'] . '" class="cart_id">';
            echo '<input type="hidden" name="cart_detail_id" value="' . $item['id'] . '" class="cart_detail_id">';
            // Nom du produit
            echo '<h3>' . $item['product_name'] . '</h3>';
            // Prix du produit
            echo '<p>Price: ' . $item['price_exc_vat'] . '</p>';
            // Quantité du produit avec un champ de saisie
            echo '<p>Quantity: <input type="number" name="qte" class="qte" value="' . $item['quantity'] . '"></p>';
            // Bouton pour ajuster la quantité
            echo '<button type="button" class="change-qte">Ajuster la quantité</button>';
            // Bouton pour retirer du panier
            echo '<button type="button" class="remove-from-cart">Remove from Cart</button>';
            echo '</form>'; // Fermeture du formulaire
        }
        // Formulaire pour passer la commande avec un bouton "Commander"
        echo '<form action="commande/adresse">';
        echo '<button type="submit" class="order-now">Commander</button>';
        echo '</form>';
        // Inclusion du script JavaScript pour la mise à jour du panier
        echo '<script src="./assets/js/updateCart.js"></script>';
    }
}
?>
