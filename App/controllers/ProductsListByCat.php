<?php
namespace Controllers;
use Models\ProductsByCatModel; 
use Views\ProductsByCatView;

class ProductsListByCat {
    public $slug;
    protected $itemModel; 
    protected $itemView;


    public function __construct() {
    $this->itemModel = new ProductsByCatModel(); 
    $this->itemView = new ProductsByCatView(); 
    }
    
    public function show($slug) {
       
        $myItem = $this->itemModel->productsByCat($slug); // Assurez-vous que le slug est bien passé
        $this->itemView->showItems($myItem);
    }
}