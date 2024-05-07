<?php
namespace Views;

class AdminProductForm {
    public function initForm($product) {
        ?>
        <h1>Détails du produit</h1>
        <h2><?php echo $product['product_name']; ?></h2>
        <p>Description : <?php echo $product['product_description']; ?></p>
        <?php
    }
}
?>
