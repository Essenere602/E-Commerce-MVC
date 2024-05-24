<?php
namespace Controllers;
use Models\ProductShowModel; 
use Views\ProductShowView;
 
class ProductShow {
    public $slug;
    protected $itemModel; 
    protected $itemView;

    public function show($slug) {
        $this->itemModel = new ProductShowModel(); 
        $this->itemView = new ProductShowView(); 
        $myItem = $this->itemModel->itemBySlug($slug); // Assurez-vous que le slug est bien passé
        $this->itemView->showItem($myItem);
    }
} 
