<?php
namespace Views; // Définition du namespace pour la classe CategoriesView

class CategoriesView { // Définition de la classe CategoriesView

    // Méthode pour afficher les éléments de la catégorie
    public function showItems($items) {
        // Affichage du titre de la catégorie
        echo '<h1>Catégorie</h1>';

        // Parcourir tous les éléments de la catégorie
        foreach ($items as $item) {
            echo '<a class="categorie" href="categorie/' . htmlspecialchars($item['slug']) . '" >'; // Lien vers la catégorie avec son slug
            echo htmlspecialchars($item['cat_name']); // Nom de la catégorie
            echo '</a><br>'; // Fin du lien
        }
    }
}
?>
