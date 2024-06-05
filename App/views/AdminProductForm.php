<?php
namespace Views; 

class AdminProductForm {
    public function initForm () {
        echo '<h1>Créer un produit</h1>
        <form class="vertical" action="admin/produits" method="post" enctype="multipart/form-data">
            <label for="productName">Nom</label><input type="text" name="productName" id="productName">
            <label for="productDesc">Description</label><textarea name="productDesc"></textarea>
            <label for="price">Prix</label><input type="text" name="price" id="price">
            <label for="stock">Stock</label><input type="text" name="stock" id="stock">
            <label for="online">Mettre en ligne</label><input type="checkbox" name="online" value="1" id="online">
            <label for="productImage">Image du produit</label><input type="file" name="productImage" id="productImage">
            <button>Envoyer</button>
        </form>';
    }
    public function initSelectProductForm($products) {
        echo '<form method="post" action="admin/update">';
        echo '<select name="productId">';
        foreach ($products as $product) {
            echo '<option value="' . $product['id'] . '">' . $product['product_name'] . '</option>';
        }
        echo '</select>';
        echo '<input type="submit" name="selectProduct" value="Sélectionner">';
        echo '</form>';
    }

    public function initUpdateForm($product) {
        echo '<h1>Mettre à jour un produit</h1>';
        echo '<form method="post" action="admin/update" enctype="multipart/form-data">';
        echo '<input type="hidden" name="productId" value="' . $product['id'] . '">';
        echo '<input type="text" name="productName" value="' . $product['product_name'] . '">';
        echo '<textarea name="productDesc">' . $product['product_description'] . '</textarea>';
        echo '<input type="number" name="price" value="' . $product['price'] . '">';
        echo '<input type="number" name="stock" value="' . $product['stock'] . '">';
        echo '<input type="checkbox" name="online" value="1"' . ($product['online'] ? ' checked' : '') . '> En ligne';
        echo '<input type="file" name="productImage">';
        echo '<input type="submit" value="Mettre à jour">';
        echo '</form>';
    }

    public function DeleteForm($products) {
        echo '<h1>Supprimer un produit</h1>';
        echo '<form method="post" action="admin/delete">';
        foreach ($products as $product) {
            echo '<div>';
            echo '<span>' . $product['product_name'] . '</span>';
            echo '<button type="submit" name="productId" value="' . $product['id'] . '">Supprimer</button>';
            echo '</div>';
        }
        echo '</form>';
    }
}