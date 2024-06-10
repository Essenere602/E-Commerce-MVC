<?php
namespace Controllers;

use Models\CartShowModel;
use Views\CartShowView;
class CartShowController {
    protected $itemModel; 
    protected $itemView;

    public function __construct() {
        $this->itemModel = new CartShowModel(); 
        $this->itemView = new CartShowView(); 
    }

    public function show($cart_id) {
        $cartItems = $this->itemModel->CartByUser($cart_id);
        $this->itemView->showItems($cartItems);
    }
    
}
?>
