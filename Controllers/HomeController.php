<?php

class HomeController
{
    private $productModel;

    public function __construct($productModel)
    {
        $this->productModel = $productModel;
    }

    public function renderGiaoDien()
    {
        // Lấy danh sách sản phẩm
        $products = $this->productModel->getAllProducts();

        // Đếm tổng sản phẩm (nếu cần dashboard)
        $totalProducts = $this->productModel->countProducts();

        require "Views/pages/home.php";
    }
}