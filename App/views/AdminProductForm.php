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
}
?>
