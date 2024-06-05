<?php

namespace Views;

class CategoriesView {
    public function showItems($items) {

        echo'  <h1>  Catégorie</h1>';

        foreach ($items as $item) {
            echo '
         
            <a class="categorie" href="categories/' . htmlspecialchars($item['slug']) . '" >';
            echo htmlspecialchars($item['cat_name']);
            echo '</a><br>';
        }
    }
}
?>
