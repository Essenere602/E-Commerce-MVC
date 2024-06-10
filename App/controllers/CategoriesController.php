<?php

namespace Controllers;

use Models\CategoriesModel; 
use Views\CategoriesView;

class CategoriesController {
    protected $categoryModel; 
    protected $categoriesView;

    public function __construct() {
        $this->categoryModel = new CategoriesModel(); 
        $this->categoriesView = new CategoriesView(); 
    }

    public function showCategories() {
        $categories = $this->categoryModel->getCategories();
        $this->categoriesView->showItems($categories);
    }
}
?>