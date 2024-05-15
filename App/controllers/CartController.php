<?php
namespace Controllers;

use Models\CartModel;

class CartController {
    public function addToCart() {
        header('Content-Type: application/json');

        // Récupérer les données JSON de la requête
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        // Vérifier si les données sont correctement récupérées
        if (isset($data['product_id']) && isset($data['quantity'])) {
            $product_id = $data['product_id'];
            $price = $data['price'];
            $quantity = $data['quantity'];

            // Appeler la méthode du modèle pour ajouter l'élément au panier
            $cartModel = new \Models\CartModel();
            $result = $cartModel->addItemToCart($price, $product_id, $quantity);

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Item added to cart']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add item to cart']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
        }
    }
}
