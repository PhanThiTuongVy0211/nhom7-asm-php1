<?php

    class ProductController {
    private $productModel;

    public function __construct($productModel) {
        $this->productModel = $productModel;
    }

    public function list() {
        $products = $this->productModel->getAllProducts();
        require "Views/pages/products.php";
    }

    public function detail() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "Thiếu ID sản phẩm";
            return;
        }

        $product = $this->productModel->getProductById($id);

        require "Views/pages/product-detail.php";
    }
}
