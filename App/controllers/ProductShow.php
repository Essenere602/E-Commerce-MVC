<?php
namespace Controllers;
use Models\ProductShowModel; 
use Views\ProductShowView;

class ProductShow {
    public $slug;
    protected $itemModel; 
    protected $itemView;

    public function __construct() {
        $this->itemModel = new ProductShowModel(); 
        $this->itemView = new ProductShowView(); 
    }

    public function show() {
        
        $myItem = $this->itemModel->itemBySlug(); // Assurez-vous que le slug est bien passé
        $this->itemView->showItem($myItem);
    }
}



