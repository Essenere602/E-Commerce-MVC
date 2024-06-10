<?php
namespace Controllers;
use Models\ProductsByCatModel; 
use Views\ProductsByCatView;

class ProductsListByCat {
    public $slug;
    protected $itemModel; 
    protected $itemView;

    public function show($slug) {
        $this->itemModel = new ProductsByCatModel(); 
        $this->itemView = new ProductsByCatView(); 
        $myItem = $this->itemModel->productsByCat(); // Assurez-vous que le slug est bien passé
        $this->itemView->showItems($myItem);
    }
}