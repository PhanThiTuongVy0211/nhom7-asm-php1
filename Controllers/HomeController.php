<?php

class HomeController {
    private $productModel;

    public function __construct($productModel) {
        $this->productModel = $productModel;
    }

    public function renderGiaoDien() {
        $products = $this->productModel->getAllProducts();

        require "Views/pages/home.php";
    }
}