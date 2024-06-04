<?php
namespace Controllers;

use Models\RecapOrderModel;
use Views\RecapView;

class RecapOrder {
    protected $recapModel;
    protected $recapView;

    public function __construct() {
        $this->recapModel = new RecapOrderModel();
        $this->recapView = new RecapView();
    }

    public function RecapPlz($cart_id) {
        // Fetch the order details using the cart_id
        $orderDetails = $this->recapModel->displayOrder($cart_id);

        // Pass the order details to the view for rendering
        $this->recapView->initForm($orderDetails);
    }
}