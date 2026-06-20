<?php
class HomeController {
private $product;
public function __construct($product){
        $this->product=$product;
        }
    public function renderGiaoDien() {

        $productModel = new Product();

        $products = $productModel->getAllProducts();

        require "Views/pages/home.php";
    }

}
