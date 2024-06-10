<?php
namespace Controllers;

use Models\ProductsByCatModel; 
use Views\ProductsByCatView;

class ProductsListByCat {
    protected $itemModel; 
    protected $itemView;

    public function show($slug) {
        $this->itemModel = new ProductsByCatModel(); 
        $this->itemView = new ProductsByCatView(); 
        $products = $this->itemModel->productsByCat($slug); // Assurez-vous que le slug est bien passé
        $this->itemView->showItems($products);
    }
}
